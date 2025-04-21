<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug', 'description', 'address', 'website', 'email', 'phone_number',
        'image', 'city_id', 'category_id', 'submission_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function submission()
{
    return $this->belongsTo(Service_Submission::class, 'submission_id');
}



}
