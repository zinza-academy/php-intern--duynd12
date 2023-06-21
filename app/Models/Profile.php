<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['dob', 'name','avatar','user_id'];
    
    // protected $casts = [
    //     'dob' => 'd/m/Y',
    // ];    

}
