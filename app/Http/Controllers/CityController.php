<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Service;
use App\Models\Tourist_Guide;

class CityController extends Controller
{
    /**
     * Affiche la liste des villes.
     */
    public function index()
    {

            // return response()->json(City::select('name', 'image')->get());
            
         $cities=City::all();
         return $cities;


    }

    /**
     * Affiche le formulaire de création d'une ville.
     */
    public function create()
    {
        return view('cities.create');
    }

    /**
     * Enregistre une nouvelle ville dans la base de données.
     */
    public function store(Request $request)
{
    // Validation des données
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Traitement de l'image si elle existe
   
    if ($request->hasFile('image')) {
        // Récupérer le nom du fichier de l'image
        $imageName = $request->file('image')->getClientOriginalName();
        
        // Stocker l'image dans public/images/cities et obtenir le chemin relatif sans 'public/'
        $imagePath = $request->file('image')->storeAs('/images/cities', $imageName, 'public');
    } else {
        $imagePath = null;
    }

    // Création de la ville (par exemple, si tu as un modèle City)
    $city = new City();
    $city->name = $request->name;
    $city->description = $request->description;
    $city->location = $request->location;
    
    // Enregistrer seulement le chemin relatif dans la base de données
    $city->image = '/images/cities/' . $imageName; // Storing relative path (without 'public/')
    $city->save();

    return response()->json([
        'message' => 'City added successfully',
        'city' => $city
    ], 201);
}


    /**
     * Affiche une ville spécifique avec ses services et guides touristiques.
     */
    public function show(string $id)
    {
        $city = City::with(['services', 'touristGuides'])->findOrFail($id);
        return view('cities.show', ['city' => $city]);
    }

    /**
     * Affiche le formulaire d'édition d'une ville.
     */
    public function edit(string $id)
    {
        $city = City::findOrFail($id);
        return view('cities.edit', ['city' => $city]);
    }

    /**
     * Met à jour une ville existante dans la base de données.
     */
    public function update(Request $request, string $id)
    {
        $city = City::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $city->name = $request->name;
        $city->description = $request->description;
        $city->location = $request->location;

        // Gérer la mise à jour de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cities', 'public');
            $city->image = $imagePath;
        }

        $city->save();
        return redirect()->route('cities.index')->with('success', 'Ville mise à jour avec succès.');
    }

    /**
     * Supprime une ville et ses relations associées.
     */
    public function destroy(string $id)
    {
        // $city = City::findOrFail($id);

        // // Détacher les relations avant suppression
        // $city->services()->delete();
        // $city->touristGuides()->delete();

        // $city->delete();
        // return redirect()->route('cities.index')->with('success', 'Ville supprimée avec succès.');

        $city = City::findOrFail($id);
        $city->delete();
    
        return response()->json(['message' => 'Deleted']);
    }
}
