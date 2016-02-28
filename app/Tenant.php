<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $connection = 'todo';

    protected $table = 'tenants';

    protected $primaryKey = 'tenant_id';

    protected $fillable = ['tenant_uid', 'company_name', 'short_company_name', 'database_prefix', 'address'];

    /**
     * Relationship to the TenantDatabase Model
     * If a tenant has multiple databases, then set it to hasMany
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tenantDatabase()
    {
        return $this->hasOne(TenantDatabase::class, 'tenant_id', 'tenant_id');
    }

    /**
     * Relationship to the TenantUser Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tenantUsers()
    {
        return $this->hasMany(TenantUser::class, 'tenant_id', 'tenant_id');
    }

    /**
     * Relationship to the User Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function users()
    {
        return $this->hasManyThrough(User::class, TenantUser::class, 'user_id', 'user_id');
    }
}
