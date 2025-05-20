<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $table = 'professional_experience';
    protected $primaryKey = 'location_id';
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
//  "doctor_id" => 70
    // "position" => "Cardiology"
    // "hospital_name" => "Tufan Gang Hospital"
    // "start_date" => "2015"
    // "end_date" => "2020"
    // "status" => "1"

	// id	doctor_id	position	hospital_name	start_date	end_date	status	created_at	updated_at	

  