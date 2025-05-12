<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'medical_services';
    public $timestamps = false;
    // protected $guarded = [];
    protected $fillable = [
        'service_name'
    ];
}
