<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlatRequest;
use App\Http\Requests\UpdatePlatRequest;
use App\Models\Category;
use App\Models\Plat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $plats = Plat::query()
            ->with('category')
            ->when($search, fn($q, $v) => $q->where('nom', 'like', "%{$v}%"))
            ->latest()
            ->paginate(10);

        return view('plats.index', compact('plats', 'search'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('plats.create', compact('categories'));
    }

    public function store(StorePlatRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('plats', 'public');
        }

        Plat::create($data);

        return to_route('plats.index')
            ->with('success', 'Plat créé avec succès.');
    }

    public function edit(Plat $plat)
    {
        $categories = Category::orderBy('name')->get();
        return view('plats.edit', compact('plat', 'categories'));
    }

    public function update(UpdatePlatRequest $request, Plat $plat)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($plat->image && Storage::disk('public')->exists($plat->image)) {
                Storage::disk('public')->delete($plat->image);
            }
            $data['image'] = $request->file('image')->store('plats', 'public');
        }

        $plat->update($data);

        return to_route('plats.index')
            ->with('success', 'Plat mis à jour avec succès.');
    }

    public function destroy(Plat $plat)
    {
        if ($plat->image && Storage::disk('public')->exists($plat->image)) {
            Storage::disk('public')->delete($plat->image);
        }

        $plat->delete();

        return to_route('plats.index')
            ->with('success', 'Plat supprimé avec succès.');
    }
}
