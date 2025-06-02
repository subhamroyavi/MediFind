<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'hospital_contacts';
    protected $primaryKey = 'contact_id';
    public $timestamps = false;

    protected $fillable = [
        'hospital_id',
        'contact_type',
        'value',
        'is_primary',
        'website_link',
       
    ];
// contact_id	hospital_id	contact_type	value	website_link	is_primary	created_at	updated_at
}

