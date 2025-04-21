<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Service;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::all();
        return $categories;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

{
    if ($request->hasFile('image')) {
        // Récupérer le nom du fichier de l'image
        $imageName = $request->file('image')->getClientOriginalName();
        
        // Stocker l'image dans public/images/categories et obtenir le chemin relatif sans 'public/'
        $imagePath = $request->file('image')->storeAs('/images/cat', $imageName, 'public');
        
        // Enregistrer seulement le chemin relatif dans la base de données
        $imageRelativePath = '/images/cat/' . $imageName; 
    } else {
        $imageRelativePath = null;
    }

    $category = new Categorie();
    $category->name = $request->name;
    $category->description = $request->description;

    // Gérer l'upload de l'image
    $category->image = $imageRelativePath; 
    $category->save();


    $category->save();

    return response()->json(['message' => 'Catégorie ajoutée avec succès', 'category' => $category], 201);
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categorie = Categorie::with('services')->findOrFail($id);
        return view('categories.show', ['categorie' => $categorie]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categorie = Categorie::find($id);
        return view('categories.edit', ['categorie' => $categorie]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Valider les données entrantes
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Trouver la catégorie par son ID
    $category = Categorie::findOrFail($id);

    // Vérifier si 'name' et 'description' sont présents avant la mise à jour
    if (!$validatedData['name'] || !$validatedData['description']) {
        return response()->json(['error' => 'Le nom et la description sont obligatoires.'], 422);
    }

    // Mettre à jour les champs de la catégorie
    $category->name = $validatedData['name'];
    $category->description = $validatedData['description'];

    // Gérer l'upload de l'image si elle est présente
    if ($request->hasFile('image')) {
        // Supprimer l'ancienne image si elle existe
        if ($category->image) {
            Storage::delete($category->image);
        }

        // Stocker la nouvelle image et récupérer son chemin
        $imagePath = $request->file('image')->store('categories', 'public');
        $category->image = $imagePath;
    }

    // Sauvegarder les changements dans la base de données
    $category->save();

    // Retourner la catégorie mise à jour
    return response()->json($category, 200);
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $categorie = Categorie::find($id);
        // $categorie->services()->detach(); // Détacher les services liés à cette catégorie
        // $categorie->delete();

        // return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');



        $categorie = Categorie::findOrFail($id);
        $categorie->delete();
    
        return response()->json(['message' => 'Deleted']);
    }
    
}
