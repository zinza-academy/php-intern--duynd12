<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'name', 'max_users', 'logo', 'status', 'expired_time', 'address'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
