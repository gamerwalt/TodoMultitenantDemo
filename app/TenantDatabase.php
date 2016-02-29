<?php

namespace App;


use gamerwalt\LaraMultiDbTenant\Contracts\ITenantDatabase;
use Illuminate\Database\Eloquent\Model;

class TenantDatabase extends Model implements ITenantDatabase
{
    protected $connection = 'todo';

    protected $table = 'tenant_databases';

    protected $primaryKey = 'tenant_database_id';

    protected $fillable = ['tenant_id', 'driver', 'port', 'hostname', 'database_name', 'user_name', 'password'];

    public function tenant()
    {
        return $this->hasOne(Tenant::class, 'tenant_id', 'tenant_id');
    }

    /**
     * Return the field that identifies the hostname of the Tenant
     *
     * @return string
     */
    public function getHostNameIdentifier()
    {
        return $this->hostname;
    }

    /**
     * Return the field that identifies the database name of the Tenant
     *
     * @return string
     */
    public function getDatabaseNameIdentifier()
    {
        return $this->database_name;
    }

    /**
     * Return the field that identifies the username of the Tenant database
     *
     * @return string
     */
    public function getUserNameIdentifier()
    {
        return $this->user_name;
    }

    /**
     * Return the field that identifies the password of the Tenant database
     *
     * @return string
     */
    public function getPasswordIdentifier()
    {
        return $this->password;
    }

    /**
     * Return the field that identifies the driver of the Tenant database
     *
     * @return string
     */
    public function getDriverIdentifier()
    {
        return $this->driver;
    }

    /**
     * Return the field that identifies the port of the Tenant database
     *
     * @return string
     */
    public function getPortIdentifier()
    {
        return $this->port;
    }

    /**
     * Return the Model of the Tenant
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getTenant()
    {
        return $this->tenant;
    }

    /**
     * Return the field that identifies the company name of the Tenant model
     *
     * @return string
     */
    public function getCompanyNameIdentifier()
    {
        return 'company_name';
    }
}
