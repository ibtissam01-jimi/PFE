<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourist_Guide extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'username',
        'description',
        'cin',
        'address',
        'email',
        'phone_number',
        'photo',
        'cv',
        'city_id',
    ];

    
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
