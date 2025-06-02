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
// contacts facilities services openingDays location

    public function contacts() {
        return $this->hasMany(Contact::class, 'hospital_id', 'hospital_id');
    }

    public function facilities() {
        return $this->hasMany(Facility::class, 'hospital_id', 'hospital_id');
    }

    public function services() {
        return $this->hasMany(Service::class, 'hospital_id', 'hospital_id');
    }

    public function openingDays() {
        return $this->hasMany(OpeningDay::class, 'hospital_id', 'hospital_id');
    }

    public function location() {
        return $this->hasOne(Location::class, 'entity_id', 'hospital_id');
    }
}
