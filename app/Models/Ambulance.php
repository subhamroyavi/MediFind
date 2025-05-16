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
        'email',
        'phone',
        'license_number',
        'vehicle_number',
        'vehicle_model',
        'organization_type',
        'service_type',
        'insurance_number',
        'status',
        'image',
    ];

   public function location()
    {
        return $this->hasOne(Location::class, 'entity_id');
    }
    							
}
