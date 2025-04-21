<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_Submission extends Model
{
    use HasFactory;
    protected $table='service_submissions';
    protected $fillable = ['description', 'date', 'status', 'user_id'];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function services()
{
    return $this->hasMany(Service::class, 'submission_id');
}



    public function city()
{
    return $this->belongsTo(City::class);
}


public function category()
{
    return $this->belongsTo(Categorie::class);
}

}
