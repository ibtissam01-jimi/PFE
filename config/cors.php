<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie', '*'], // Cette ligne inclut toutes les requêtes API et Sanctum

    'allowed_methods' => ['*'],  // Autorise toutes les méthodes HTTP (GET, POST, PUT, DELETE...)

    'allowed_origins' => ['http://localhost:5173'],  // Le frontend qui peut accéder à l'API (ici localhost avec port 5173)

    'allowed_origins_patterns' => [],  // Aucun motif particulier ici

    'allowed_headers' => ['*'],  // Autorise tous les en-têtes (headers)

    'exposed_headers' => [],  // Aucune en-tête spécifique à exposer

    'max_age' => 0,  // Temps de mise en cache pour les pré-vols (0 signifie aucune mise en cache)

    'supports_credentials' => true,  // Autorise l'envoi de cookies ou d'informations d'identification

];
