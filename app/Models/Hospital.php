<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $table = 'Hospitals';
    protected $primaryKey = 'hospital_id';
    public $timestamps = false;

    protected $fillable = [
            'hospital_name',
            'description',
            'organization_type',
            'status'
        ];
}





