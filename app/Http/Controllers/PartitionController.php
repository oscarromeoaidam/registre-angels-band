<?php

namespace App\Http\Controllers;

use App\Models\Partition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PartitionController extends Controller
{
    /**
     * Afficher toutes les partitions (public)
     */
    public function index()
    {
        $partitions = Partition::latest()->get();
        return view('partitions.index', compact('partitions'));
    }

    /**
     * Afficher le formulaire de création (admin seulement)
     */
    public function create()
    {
        // Vérification admin déjà faite par le middleware
        return view('partitions.create');
    }

    /**
     * Enregistrer une nouvelle partition
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'nom' => 'required|string|max:255',
            'compositeur' => 'required|string|max:255',
            'fichier' => 'required|file|mimes:pdf|max:10240', // 10MB max
        ]);

        // Upload du fichier
        $path = $request->file('fichier')->store('partitions', 'public');

        // Création de la partition
        Partition::create([
            'nom' => $request->nom,
            'compositeur' => $request->compositeur,
            'fichier' => $path,
        ]);

        return redirect()->route('partitions.index')
            ->with('success', 'Partition ajoutée avec succès!');
    }

    /**
     * Télécharger une partition
     */
    public function download($id)
    {
        $partition = Partition::findOrFail($id);
        $path = storage_path('app/public/' . $partition->fichier);

        if (!file_exists($path)) {
            abort(404, 'Fichier non trouvé');
        }

        return response()->download($path, 
            str_replace(' ', '_', $partition->nom) . '.pdf'
        );
    }
    public function edit(Partition $partition)
    {
        return view('partitions.edit', compact('partition'));
    }

    /**
     * Mettre à jour une partition
     */
    public function update(Request $request, Partition $partition)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'compositeur' => 'required|string|max:255',
            'fichier' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        // Si nouveau fichier PDF
        if ($request->hasFile('fichier')) {
            // Supprime l'ancien fichier
            Storage::delete('public/' . $partition->fichier);
            
            // Upload le nouveau
            $path = $request->file('fichier')->store('partitions', 'public');
            $partition->fichier = $path;
        }

        // Met à jour les autres champs
        $partition->update([
            'nom' => $request->nom,
            'compositeur' => $request->compositeur,
        ]);

        return redirect()->route('partitions.index')
            ->with('success', 'Partition mise à jour avec succès !');
    }

    /**
     * Supprimer une partition
     */
    public function destroy(Partition $partition)
    {
        // Supprime le fichier PDF
        Storage::delete('public/' . $partition->fichier);
        
        // Supprime l'enregistrement en base
        $partition->delete();

        return redirect()->route('partitions.index')
            ->with('success', 'Partition supprimée avec succès !');
    }
}

