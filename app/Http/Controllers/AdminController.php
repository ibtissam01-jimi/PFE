<?php


namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getAdminData()
    {
        // Récupérer les données de l'administrateur (ici on suppose qu'il n'y en a qu'un)
        $admin = Admin::first();

        if (!$admin) {
            return response()->json(['message' => 'Administrateur non trouvé'], 404);
        }

        // Retourner les données dans un format JSON
        return response()->json([
            'admin' => $admin
        ]);
    }

    public function updateAdminData(Request $request)
    {
        // Récupérer les données de l'administrateur (ici on suppose qu'il n'y en a qu'un)
        $admin = Admin::first();

        if (!$admin) {
            return response()->json(['message' => 'Administrateur non trouvé'], 404);
        }

        // Valider les données reçues
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'city' => 'nullable|string',
            'country' => 'nullable|string',
            'role' => 'nullable|string',
            // Vous pouvez ajouter d'autres champs selon votre besoin
        ]);

        // Mettre à jour les données de l'administrateur
        $admin->update($validated);

        // Retourner la réponse avec les données mises à jour
        return response()->json([
            'message' => 'Données de l\'administrateur mises à jour',
            'admin' => $admin
        ]);
    }
}


