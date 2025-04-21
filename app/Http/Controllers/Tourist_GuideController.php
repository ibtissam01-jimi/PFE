<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tourist_Guide;
use App\Models\City;


class Tourist_GuideController extends Controller
{
    /**
     * Affiche la liste des guides touristiques.
     */
    public function index()
    {
        

         $guides=Tourist_Guide::all();
         return response()->json(['guides'=>$guides]);

    }

    /**
     * Affiche le formulaire de création d'un guide touristique.
     */
    public function create()
    {
        $cities = City::all();
        return view('guides.create', ['cities' => $cities]);
    }

    /**
     * Enregistre un nouveau guide touristique.
     */
//     public function store(Request $request)
// {
//     $guide = new Tourist_Guide();

//     $guide->name = $request->name;
//     $guide->username = $request->username;
//     $guide->description = $request->description;
//     $guide->cin = $request->cin;
//     $guide->address = $request->address;
//     $guide->email = $request->email;
//     $guide->phone_number = $request->phone_number;
//     $guide->city_id = $request->city_id;

//     if ($request->hasFile('photo')) {
//         $path = $request->file('photo')->store('guides', 'public');
//         $guide->photo = $path;
//     }

//     $guide->save();

//     return response()->json(['message' => 'Guide ajouté avec succès'], 201);
// }




public function store(Request $request)
{
    // Validation des données (ajoutée ici pour la validation des entrées)

    // Création du guide touristique
    $guide = new Tourist_Guide();

    $guide->name = $request->name;
    $guide->username = $request->username;
    $guide->description = $request->description;
    $guide->cin = $request->cin;
    $guide->address = $request->address;
    $guide->email = $request->email;
    $guide->phone_number = $request->phone_number;
    $guide->city_id = $request->city_id;

    // Gestion de la photo
    if ($request->hasFile('photo')) {
        // Récupérer le nom de l'image et la stocker dans le dossier 'public/images/guides'
        $imageName = $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('/images/guides', $imageName, 'public');
        
        // Enregistrer le chemin relatif dans la base de données
        $guide->photo = '/images/guides/' . $imageName;
    }

    // Enregistrer le guide dans la base de données
    $guide->save();

    // Retourner une réponse JSON avec un message de succès
    return response()->json(['message' => 'Guide ajouté avec succès'], 201);
}






    /**
     * Affiche un guide spécifique.
     */
    public function show(string $id)
    {
        $guide = Tourist_Guide::with('city')->findOrFail($id);
        return view('guides.show', ['guide' => $guide]);
    }

    /**
     * Affiche le formulaire d'édition d'un guide touristique.
     */
    public function edit(string $id)
    {
        $guide = Tourist_Guide::findOrFail($id);
        $cities = City::all();

        return view('guides.edit', ['guide' => $guide, 'cities' => $cities]);
    }

    /**
     * Met à jour un guide touristique.
     */
    public function update(Request $request, $id)
{
    // Trouve le guide par ID
    $guide = Tourist_Guide::findOrFail($id);

    // Mise à jour des champs de base
    $guide->update([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'address' => $request->input('address'),
        'city_id' => $request->input('city_id'),
        'cin' => $request->input('cin'),
        'phone_number' => $request->input('phone_number'),
    ]);

    // Gestion de la photo si elle est fournie (sans utiliser Storage)
    if ($request->hasFile('photo')) {
        if ($guide->photo) {
            // Supprimer l'ancienne photo (si elle existe) du dossier public
            $oldPhotoPath = public_path('/images/guides/' . $guide->photo);
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath); // Suppression du fichier
            }
        }
        
        // Déplacer la nouvelle photo dans le dossier public/images/guides
        $photoName = time() . '.' . $request->file('photo')->getClientOriginalExtension();
        $request->file('photo')->move(public_path('/images/guides'), $photoName);
        $guide->photo = '/images/guides/' . $photoName;
    }

    // Gestion du CV si fourni
    if ($request->hasFile('cv')) {
        if ($guide->cv) {
            // Supprimer l'ancien CV
            $oldCvPath = public_path('cv/guides/' . $guide->cv);
            if (file_exists($oldCvPath)) {
                unlink($oldCvPath); // Suppression du fichier
            }
        }

        // Déplacer le nouveau CV dans le dossier public/cv/guides
        $cvName = time() . '.' . $request->file('cv')->getClientOriginalExtension();
        $request->file('cv')->move(public_path('cv/guides'), $cvName);
        $guide->cv = 'cv/guides/' . $cvName;
    }

    // Sauvegarder les modifications
    $guide->save();

    return response()->json($guide, 200);
}


    /**
     * Supprime un guide touristique.
     */
    public function destroy(string $id)
    {
        // $guide = Tourist_Guide::findOrFail($id);
        // $guide->delete();

        // return redirect()->route('guides.index')->with('success', 'Guide supprimé avec succès.');


        $guide = Tourist_Guide::findOrFail($id);
        $guide->delete();
    
        return response()->json(['message' => 'Deleted']);
    }
}
