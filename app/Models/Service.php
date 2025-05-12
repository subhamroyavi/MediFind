<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'medical_services';
    public $timestamps = false;
    protected $primaryKey = 'service_id';
    // protected $guarded = [];
    protected $fillable = [
        'service_name'
    ];
}
