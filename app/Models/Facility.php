<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    protected $table = 'hospital_facilities';
    protected $primaryKey = 'facility_id';
    public $timestamps = false;

    protected $fillable = [
        'hospital_id',
        'facility_name',
        'description',
       
    ];
}

