<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['utilisateur_id', 'service_id'];

    /**
     * Relation avec le modèle Utilisateur.
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec le modèle Service.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
