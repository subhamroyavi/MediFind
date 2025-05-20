<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $table = 'education';
    protected $primaryKey = 'education_id';
    public $timestamps = false;

    protected $fillable = [
        'doctor_id',
        'course_name',
        'university',
        'date',
        'country',
    ];
  
	// education_id	doctor_id	course_name	university	date	country
}
