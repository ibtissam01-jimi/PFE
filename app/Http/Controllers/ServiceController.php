<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\City;
use App\Models\Categorie;
use App\Models\Admin;

use Illuminate\Support\Facades\Log;


class ServiceController extends Controller
{
    /**
     * Affiche la liste des services.
     */
    public function index()
    {
        $services = Service::with(['city', 'category', 'admin'])->get();
        return $services;
    }



    
    public function getAllPlaces()
    {
        $services = Service::with([ 'category', 'admin'])
            ->where('category_id', 4)
            ->get();

        return response()->json($services);
    }

    /**
     * Affiche le formulaire de création d'un service.
     */
    public function create()
    {
        $cities = City::all();
        $categories = Categorie::all();
        $admins = Admin::all();

        return view('services.create', [
            'cities' => $cities,
            'categories' => $categories,
            'admins' => $admins
        ]);
    }

    /**
     * Enregistre un nouveau service.
     */
//     public function store(Request $request)
// {
//     // Validation des données

//     $categoryId = $request->category_id ?? 1;
    
//     // Création d'un nouveau service
//     $service = new Service();
//     $service->name = $request->name;
//     $service->slug = $request->slug;
//     $service->description = $request->description;
//     $service->address = $request->address;
//     $service->website = $request->website;
//     $service->email = $request->email;
//     $service->phone_number = $request->phone_number;
//     $service->city_id = $request->city_id;


//     $service->category_id = $categoryId; 


//     // Gestion de l'image
//     if ($request->hasFile('image')) {
//         $path = $request->file('image')->store('services', 'public');
//         $service->image = $path;
//     }

//     // Enregistrement du service
//     $service->save();

//     // Retourner une réponse JSON avec un message de succès
//     return response()->json(['message' => 'Service ajouté avec succès'], 201);
// }






public function store(Request $request)
{


    // Récupérer l'ID de la catégorie ou définir la valeur par défaut
    $categoryId = $request->category_id ?? 1;

    // Création d'un nouveau service
    $service = new Service();
    $service->name = $request->name;
    $service->slug = $request->slug;
    $service->description = $request->description;
    $service->address = $request->address;
    $service->website = $request->website;
    $service->email = $request->email;
    $service->phone_number = $request->phone_number;
    $service->city_id = $request->city_id;
    $service->category_id = $categoryId; 

    // Gestion de l'image
    if ($request->hasFile('image')) {
        // Récupérer le nom de l'image et la stocker dans le dossier 'public/images/services'
        $imageName = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('/images/services', $imageName, 'public');
        
        // Enregistrer le chemin relatif dans la base de données
        $service->image = '/images/services/' . $imageName;
    }

    // Enregistrement du service
    $service->save();

    // Retourner une réponse JSON avec un message de succès
    return response()->json(['message' => 'Service ajouté avec succès'], 201);
}


    /**
     * Affiche un service spécifique.
     */
    public function show(string $id)
    {
        $service = Service::with(['city', 'category', 'admin'])->findOrFail($id);
        return view('services.show', ['service' => $service]);
    }

    /**
     * Affiche le formulaire d'édition d'un service.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        $cities = City::all();
        $categories = Categorie::all();
        $admins = Admin::all();

        return view('services.edit', [
            'service' => $service,
            'cities' => $cities,
            'categories' => $categories,
            'admins' => $admins
        ]);
    }

    /**
     * Met à jour un service.
     */
    public function update(Request $request, $id)
{
    $service = Service::findOrFail($id);

    // Préparez les données de mise à jour
    $updatedData = $request->only([
        'name',
        'description',
        'address',
        'email',
        'phone_number',
        'website',
        'city_id',
        'category_id'
    ]);

    // Image upload (si une nouvelle image est envoyée)
    if ($request->hasFile('image')) {
        // Supprimer l'ancienne image si elle existe
        if ($service->image && file_exists(public_path('images/services/' . $service->image))) {
            unlink(public_path('images/services/' . $service->image));
        }

        // Télécharger la nouvelle image
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images/services'), $filename);

        // Ajouter le chemin de la nouvelle image aux données mises à jour
        $updatedData['image'] = 'services/' . $filename;
    }

    // Log pour débogage
    Log::debug('Service updated data:', $updatedData);

    // Mettre à jour les données du service
    $service->update($updatedData);

    // Retourner une réponse avec le message de succès et les données du service
    return response()->json(['message' => 'Service mis à jour avec succès', 'service' => $service]);
}

    /**
     * Supprime un service.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        // return redirect()->route('services.index')->with('success', 'Service supprimé avec succès.');
        return response()->json(['message' => 'Deleted']);
    }
}
