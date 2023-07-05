<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticableTrait;
    use SoftDeletes;
    protected $fillable = ['email', 'password', 'company_id', 'role'];

    public function profiles()
    {
        return $this->hasOne(Profile::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }
    public function companies()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
