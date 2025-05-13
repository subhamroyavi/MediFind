<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $primaryKey = 'doctor_id';
    protected $table = 'doctors';

    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'experience_years',
        'home_town',
        'organization_type',
        'status',
        'image'
    ];

    // public function services()
    // {
    //     return $this->belongsToMany(MedicalService::class, 'doctor_services', 'doctor_id', 'service_id')
    //         ->withPivot('status')
    //         ->withTimestamps();
    // }

    // public function hospitals()
    // {
    //     return $this->belongsToMany(Hospital::class, 'hospitals_doctor', 'doctor_id', 'hospital_id')
    //         ->withPivot('status')
    //         ->withTimestamps();
    // }

    // public function location()
    // {
    //     return $this->morphOne(Location::class, 'entity');
    // }

    // public function reviews()
    // {
    //     return $this->morphMany(Review::class, 'entity');
    // }
}
