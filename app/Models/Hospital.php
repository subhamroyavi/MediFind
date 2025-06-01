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
        'status',
        'image'
    ];


    // public function contacts() {
    //     return $this->hasMany(Contact::class);
    // }

    // public function facilities() {
    //     return $this->hasMany(Facility::class);
    // }

    // public function services() {
    //     return $this->hasMany(Service::class);
    // }

    // public function openingDays() {
    //     return $this->hasMany(OpeningDay::class);
    // }

    // public function location() {
    //     return $this->hasOne(Location::class);
    // }
}
