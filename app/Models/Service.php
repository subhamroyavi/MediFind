<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'hospital_services';
    protected $primaryKey = 'service_id';
    public $timestamps = false;

    protected $fillable = [
        'hospital_id',
        'service_name'
        // service_id	hospital_id	service_name	created_at	updated_at	

    ];
}
	