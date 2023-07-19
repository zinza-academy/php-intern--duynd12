<?php

namespace App\Models;

use App\Constants\RoleConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements Authenticatable
{
    use HasFactory, AuthenticableTrait, SoftDeletes;
    protected $fillable = ['email', 'password', 'company_id', 'role'];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function isAdmin()
    {
        return $this->role == RoleConstants::ADMINISTRATOR;
    }

    public function isCompanyAccount()
    {
        if (session('data')['company_id'] == $this->company_id && !$this->isMember()) {
            return true;
        }
        return false;
    }

    public function isMember()
    {
        return session('data')['role'] === RoleConstants::MEMBER;
    }
}
