<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'register', // ou '/api/register' si ta route est prefixed
        'api/*',
        'new_submission', // Ajoutez ici vos routes spécifiques
    // Exclure toutes les routes de l'API
        'guides/*',  // Exclure les routes relatives aux guides si besoin

    ];
}
