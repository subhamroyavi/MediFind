<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';
    // protected $guarded = [];
    protected $fillable = [
        'first_name',
        'last_name',
        'email', 
        'phone', 
        'password',
        'status'
        // other fields that should be mass-assignable
    ];
}
