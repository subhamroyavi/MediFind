<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
     use HasFactory;
    protected $primaryKey = 'ambulance_id';
    protected $table = 'ambulances';
    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'image',
        'phone',
        'email',
        'phone',
        'vehicle_number',
        'service_type',
        'organization_type',
        'status'
    ];
    							
}
