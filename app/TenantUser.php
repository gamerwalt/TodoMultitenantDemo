<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenantUser extends Model
{
    protected $connection = 'todo';

    protected $table = 'tenant_users';

    protected $primaryKey = 'tenant_user_id';

    protected $fillable = ['tenant_id','user_id'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'tenant_id');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }
}
