<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommandeRequest;
use App\Models\Commande;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::latest()->paginate(10);
        return view('commandes.index', compact('commandes'));
    }

    public function create()
    {
        return view('commandes.create');
    }

    public function store(StoreCommandeRequest $request)
    {
        Commande::create($request->validated());

        return to_route('commandes.index')
            ->with('success', 'Commande créée avec succès.');
    }

    public function show(Commande $commande)
    {
        return view('commandes.show', compact('commande'));
    }

    public function destroy(Commande $commande)
    {
        $commande->delete();

        return to_route('commandes.index')
            ->with('success', 'Commande supprimée avec succès.');
    }
}
