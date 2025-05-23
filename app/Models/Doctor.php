<?php

namespace App\Models;


use App\Models\Location;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'small_description',
        'specialization',
        'organization_type',
        'status',
        'image'
    ];

    public function locations()
    {
        return $this->hasOne(Location::class, 'entity_id');
    }

    public function educations() {
    return $this->hasMany(Education::class, 'doctor_id')->orderBy('date', 'DESC');
}

    public function experiences()
    {
        return $this->hasMany(Experience::class, 'doctor_id')->orderBy('end_date', 'DESC');
    }
}
