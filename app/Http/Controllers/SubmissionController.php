<?php

namespace App\Http\Controllers;

use App\Models\Service_Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    // Afficher toutes les soumissions
    public function index()
    {
        $submissions = Service_Submission::all();
        return response()->json($submissions);
    }

    // Ajouter une nouvelle soumission
    public function store(Request $request)
    {
        $user_id = Auth::id();

        // Création de la soumission
        $submission = new Service_Submission();

        // Assigner les valeurs aux propriétés du modèle
        $submission->name = $request->name;
        $submission->description = $request->description;
        $submission->address = $request->address;
        $submission->website = $request->website;
        $submission->email = $request->email;
        $submission->phone_number = $request->phone_number;
        $submission->category_id = $request->category_id;
        $submission->city_id = $request->city_id;
        $submission->user_id = $user_id;
        $submission->status = 'pending';  // statut par défaut

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Récupérer le nom original de l'image
            $imageName = $request->file('image')->getClientOriginalName();

            // Déplacer l'image vers le dossier public/images/services
            $imagePath = public_path('/images/services');
            $request->file('image')->move($imagePath, $imageName);

            // Enregistrer le chemin relatif de l'image dans la base de données
            $submission->image = '/images/services/' . $imageName;
        }

        // Enregistrement en base de données
        $submission->save();

        return response()->json(['message' => 'Soumission reçue avec succès'], 201);
    }

    // Afficher une soumission pour l'édition
    public function edit($id)
    {
        $submission = Service_Submission::findOrFail($id);
        return response()->json($submission);
    }

    // Mettre à jour une soumission existante
    public function update(Request $request, $id)
    {
        $submission = Service_Submission::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'website' => 'required|url|max:255',
        ]);

        $submission->update($data);
        return response()->json($submission);
    }

    // Supprimer une soumission
    public function destroy($id)
    {
        $submission = Service_Submission::findOrFail($id);
        $submission->delete();
        return response()->json(['message' => 'Soumission supprimée avec succès.']);
    }
}
