<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'name_company', 'max_users', 'logo', 'active', 'expired_time', 'address'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'company_members', 'company_id', 'user_id');
    }
}
