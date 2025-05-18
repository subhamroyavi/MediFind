<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = 'locations';
    protected $primaryKey = 'location_id';
    public $timestamps = false;

    protected $fillable = [
        'entity_type',
        'entity_id',
        'address_line1',
        'address_line2',
        'city',
        'district',
        'pincode',
        'state',
        'country',
        'google_maps_link',

    ];
}
