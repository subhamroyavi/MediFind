<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpeningDay extends Model
{
    use HasFactory;
    protected $table = 'hospital_opening_days';
    protected $primaryKey = 'hospital_id';
    public $timestamps = false;

    protected $fillable = [
        'hospital_id',
        'opening_day',
        'opening_time',
        'closing_time',
        'status',
    //    hospital_id	opening_day	opening_time	closing_time	status	created_at	updated_at	

    ];
}
	