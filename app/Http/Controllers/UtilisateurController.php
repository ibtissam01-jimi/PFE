<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    /**
     * Affiche la liste des utilisateurs.
     */
    public function index()
    {
        $utilisateurs = User::all();
        return  $utilisateurs;
    }

    /**
     * Affiche le formulaire de création d'un utilisateur.
     */
    public function create()
    {
        return view('utilisateurs.create');
    }

    /**
     * Enregistre un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->nationality = $request->nationality;
        $user->birth_date = $request->birth_date;
        $user->save();

        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }
    

    /**
     * Affiche les détails d'un utilisateur.
     */
    public function show(string $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        return view('utilisateurs.show', ['utilisateur' => $utilisateur]);
    }

    /**
     * Affiche le formulaire de modification d'un utilisateur.
     */
    public function edit(string $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        return view('utilisateurs.edit', ['utilisateur' => $utilisateur]);
    }

    /**
     * Met à jour un utilisateur.
     */
    public function update(Request $request, $id)
    {
        // Validation des données entrantes
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'birthDate' => 'required|date',
        ]);

        // Trouver l'utilisateur par son ID
        $user = User::find($id);

        // Vérifier si l'utilisateur existe
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }

        // Mettre à jour l'utilisateur
        $user->update([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'nationality' => $validatedData['nationality'],
            'birth_date' => $validatedData['birthDate'],
        ]);

        // Retourner la réponse avec les données mises à jour
        return response()->json($user, 200);
    }

    /**
     * Supprime un utilisateur.
     */
    public function destroy($id)
    {
        $evaluator = User::findOrFail($id);
        $evaluator->delete();
    
        return response()->json(['message' => 'Deleted']);
    }
}
