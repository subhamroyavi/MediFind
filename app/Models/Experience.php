<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $table = 'professional_experience';
    protected $primaryKey = 'experience_id';
    public $timestamps = false;

    protected $fillable = [
        'doctor_id',
        'position',
        'hospital_name', 
        'start_date',
        'end_date',
        'status',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}

  