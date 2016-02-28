<?php

namespace App\Http\Controllers;

use App\GuidProvider;
use App\Http\Requests\RegisterTenantRequest;
use App\Http\Requests\SignInRequest;
use App\Tenant;
use App\TenantDatabase;
use App\TenantUser;
use App\User;
use gamerwalt\LaraMultiDbTenant\Traits\MigrateTenantDatabase;
use Illuminate\Http\Request;
use LaraMultiDbTenant;
use DB;
use App\Http\Requests;
use Auth;
use App\Http\Controllers\Controller;

class SessionsController extends Controller
{
    use MigrateTenantDatabase;

    public function register()
    {
        return view('register');
    }

    /**
     * Registers the user/company/tenant
     *
     * @param \App\Http\Requests\RegisterTenantRequest $request
     *
     * @return array
     */
    public function postRegister(RegisterTenantRequest $request)
    {
        //here we register the user
        //then save the Tenant Details
        //then save the TenantUser Information as well as the TenantDatabase
        //All these can be achieved by events or queued events
        $input = $request->all();
        $email = $input['email'];
        $password = $input['password'];
        $name = $input['name'];
        $companyName = $input['company_name'];

        DB::beginTransaction();

        $user = $this->registerUser($email, $password, $name);
        $tenant = $this->registerTenant($companyName);
        $tenantUser = $this->createTenantUserDetails($user, $tenant);
        $tenantDatabase = $this->createTenantDatabase($tenant);

        DB::commit();
        //now we can migrate the database of the tenant using the tenant database settings

        $this->migrateTenantDatabase($tenantDatabase->hostname, $tenantDatabase->database_name,
                                     $tenantDatabase->user_name, $tenantDatabase->password);

        return redirect()->route('home');
    }

    public function signIn()
    {
        return view('signin');
    }

    public function postSignIn(SignInRequest $request)
    {
        $input = $request->all();

        $email = $input['email'];
        $password = $input['password'];

        if(Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->intended('dashboard');
        }
        session()->flash('message', 'Invalid Credentials Supplied!');
        session()->flash('message_type', 'danger');

        return redirect()->back();
    }

    public function signOut()
    {
        Auth::logout();
        session()->flush();

        return redirect()->home();
    }

    private function registerUser($email, $password, $name)
    {
        $user = new User();
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->name = $name;
        $user->user_uid = new GuidProvider();
        $user->save();

        return $user;
    }

    private function registerTenant($companyName)
    {
        $tenant = new Tenant();
        $tenant->tenant_uid = new GuidProvider();
        $tenant->company_name = $companyName;
        $tenant->short_company_name = $companyName;
        $tenant->database_prefix = LaraMultiDbTenant::getDatabasePrefix();
        $tenant->save();

        return $tenant;
    }

    private function createTenantUserDetails($user, $tenant)
    {
        $tenantUser = new TenantUser();
        $tenantUser->tenant_id = $tenant->tenant_id;
        $tenantUser->user_id = $user->user_id;
        $tenantUser->save();

        return $tenantUser;
    }

    private function createTenantDatabase($tenant)
    {
        $tenantDatabase = new TenantDatabase();
        $tenantDatabase->tenant_id = $tenant->tenant_id;
        $tenantDatabase->driver = 'mysql';
        $tenantDatabase->port = 3306;
        $tenantDatabase->hostname = 'bentadb';
        $tenantDatabase->database_name = $tenant->database_prefix . '_' . substr($tenant->company_name, 0, 5);
        $tenantDatabase->user_name = $tenant->database_prefix . '_' . substr($tenant->company_name, 0, 5) . '_user';
        $tenantDatabase->password = $this->genRandomPassword();
        $tenantDatabase->save();

        return $tenantDatabase;
    }

    /**
     * Get possible values to create a password string
     *
     * @return string
     */
    private function getKeyValues()
    {
        return 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890@#$-+!<>;:';
    }

    /**
     * Generates a random password
     *
     * @param int $min
     * @param int $max
     *
     * @return type string
     */
    private function genRandomPassword($min = 8, $max = 15)
    {
        $randomPassword = $this->getKeyValues();

        $randomNumber = mt_rand($min, $max);

        $string = '';

        for ($i = 0; $i < $randomNumber; $i++)
        {
            $pos = rand(0, strlen($randomPassword)-1);
            $string .= $randomPassword{$pos};
        }

        return $string;
    }
}
