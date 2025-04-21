<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tourist_Guide;
use App\Models\City;

class Tourist_GuideController extends Controller
{
    public function index()
    {
        $guides = Tourist_Guide::all();
        return response()->json(['guides' => $guides]);
    }

    public function create()
    {
        $cities = City::all();
        return view('guides.create', ['cities' => $cities]);
    }

    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cin' => 'required|string|max:20|unique:tourist_guides,cin',
            'address' => 'nullable|string|max:255',
            'email' => 'required|email|unique:tourist_guides,email',
            'phone_number' => 'required|string|max:15',
            'cv' => 'nullable|mimes:pdf|max:2048',
            'photo' => 'nullable|image|max:2048',
            'city_id' => 'required|exists:cities,id',
        ]);

        $guide = new Tourist_Guide($validated);

        // Gestion de la photo
        if ($request->hasFile('photo')) {
            $imageName = $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images/guides', $imageName, 'public');
            $guide->photo = 'images/guides/' . $imageName;
        }

        // Gestion du CV
        if ($request->hasFile('cv')) {
            $cvName = time() . '.' . $request->file('cv')->getClientOriginalExtension();
            $request->file('cv')->move(public_path('cv/guides'), $cvName);
            $guide->cv = 'cv/guides/' . $cvName;
        }

        $guide->save();

        return response()->json(['message' => 'Guide ajouté avec succès.', 'guide' => $guide], 201);
    }

    public function show(string $id)
    {
        $guide = Tourist_Guide::with('city')->findOrFail($id);
        return view('guides.show', ['guide' => $guide]);
    }

    public function edit(string $id)
    {
        $guide = Tourist_Guide::findOrFail($id);
        $cities = City::all();

        return view('guides.edit', ['guide' => $guide, 'cities' => $cities]);
    }

    public function update(Request $request, $id)
    {
        $guide = Tourist_Guide::findOrFail($id);

        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cin' => 'required|string|max:20|unique:tourist_guides,cin,' . $id,
            'email' => 'required|email|unique:tourist_guides,email,' . $id,
            'address' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:15',
            'city_id' => 'required|exists:cities,id',
            'photo' => 'nullable|image|max:2048',
            'cv' => 'nullable|mimes:pdf|max:2048',
        ]);

        $guide->fill($validated);

        // Photo
        if ($request->hasFile('photo')) {
            if ($guide->photo && file_exists(public_path($guide->photo))) {
                unlink(public_path($guide->photo));
            }
            $photoName = time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move(public_path('images/guides'), $photoName);
            $guide->photo = 'images/guides/' . $photoName;
        }

        // CV
        if ($request->hasFile('cv')) {
            if ($guide->cv && file_exists(public_path($guide->cv))) {
                unlink(public_path($guide->cv));
            }
            $cvName = time() . '.' . $request->file('cv')->getClientOriginalExtension();
            $request->file('cv')->move(public_path('cv/guides'), $cvName);
            $guide->cv = 'cv/guides/' . $cvName;
        }

        $guide->save();

        return response()->json(['message' => 'Guide mis à jour avec succès.', 'guide' => $guide]);
    }

    public function destroy(string $id)
    {
        $guide = Tourist_Guide::findOrFail($id);

        // Supprimer fichiers liés
        if ($guide->photo && file_exists(public_path($guide->photo))) {
            unlink(public_path($guide->photo));
        }

        if ($guide->cv && file_exists(public_path($guide->cv))) {
            unlink(public_path($guide->cv));
        }

        $guide->delete();

        return response()->json(['message' => 'Guide supprimé avec succès.']);
    }
}
