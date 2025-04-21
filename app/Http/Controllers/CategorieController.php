<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Categorie;
use App\Models\Service;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return $categories;
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('/images/cat', $imageName, 'public');
            $imageRelativePath = '/images/cat/' . $imageName; 
        } else {
            $imageRelativePath = null;
        }

        $category = new Categorie();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $imageRelativePath; 
        $category->save();

        return response()->json(['message' => 'Catégorie ajoutée avec succès', 'category' => $category], 201);
    }

    public function show(string $id)
    {
        $categorie = Categorie::with('services')->findOrFail($id);
        return view('categories.show', ['categorie' => $categorie]);
    }

    public function edit(string $id)
    {
        $categorie = Categorie::find($id);
        return view('categories.edit', ['categorie' => $categorie]);
    }

    // 🔧 Méthode update fusionnée
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $categorie = Categorie::findOrFail($id);

        $categorie->name = $validatedData['name'];
        $categorie->description = $validatedData['description'];

        if ($request->hasFile('image')) {
            if ($categorie->image) {
                Storage::disk('public')->delete($categorie->image);
            }

            $imagePath = $request->file('image')->store('categories', 'public');
            $categorie->image = $imagePath;
        }

        $categorie->save();

        return response()->json(['message' => 'Category updated successfully', 'categorie' => $categorie], 200);
    }

    public function destroy(string $id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();
    
        return response()->json(['message' => 'Deleted']);
    }
}
