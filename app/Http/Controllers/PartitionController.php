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

        // Upload du fichier vers Cloudinary (stockage permanent, contrairement
        // au disque local qui est efface a chaque redeploiement sur Render)
        $cloudinaryPath = $request->file('fichier')->store('partitions', 'cloudinary');
        $url = Storage::disk('cloudinary')->url($cloudinaryPath);

        // Création de la partition
        Partition::create([
            'nom' => $request->nom,
            'compositeur' => $request->compositeur,
            'fichier' => $url,
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

        // Le champ "fichier" contient une URL Cloudinary complete.
        if (!$partition->fichier) {
            abort(404, 'Fichier non trouvé');
        }

        // On recupere le contenu du PDF depuis Cloudinary et on le renvoie
        // avec les bons en-tetes pour forcer le telechargement avec un nom
        // de fichier personnalise (plutot qu'une simple redirection, qui
        // ouvrirait le PDF dans l'onglet au lieu de le telecharger).
        $response = \Illuminate\Support\Facades\Http::get($partition->fichier);

        if (!$response->successful()) {
            abort(404, 'Fichier non trouvé');
        }

        $filename = str_replace(' ', '_', $partition->nom) . '.pdf';

        return response($response->body(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
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
            // Supprime l'ancien fichier sur Cloudinary
            if ($partition->fichier) {
                $oldPublicId = $this->extractCloudinaryPublicId($partition->fichier);
                if ($oldPublicId) {
                    Storage::disk('cloudinary')->delete($oldPublicId);
                }
            }

            // Upload le nouveau
            $cloudinaryPath = $request->file('fichier')->store('partitions', 'cloudinary');
            $partition->fichier = Storage::disk('cloudinary')->url($cloudinaryPath);
        }

        // Met à jour les autres champs
        $partition->update([
            'nom' => $request->nom,
            'compositeur' => $request->compositeur,
            'fichier' => $partition->fichier,
        ]);

        return redirect()->route('partitions.index')
            ->with('success', 'Partition mise à jour avec succès !');
    }

    /**
     * Supprimer une partition
     */
    public function destroy(Partition $partition)
    {
        // Supprime le fichier PDF sur Cloudinary
        if ($partition->fichier) {
            $publicId = $this->extractCloudinaryPublicId($partition->fichier);
            if ($publicId) {
                Storage::disk('cloudinary')->delete($publicId);
            }
        }

        // Supprime l'enregistrement en base
        $partition->delete();

        return redirect()->route('partitions.index')
            ->with('success', 'Partition supprimée avec succès !');
    }

    /**
     * Extrait le public_id Cloudinary (ex: "partitions/abc123") a partir
     * d'une URL Cloudinary complete, afin de pouvoir supprimer le fichier.
     */
    private function extractCloudinaryPublicId(string $url): ?string
    {
        // Exemple d'URL Cloudinary :
        // https://res.cloudinary.com/<cloud_name>/image/upload/v1234567890/partitions/abc123.pdf
        if (!preg_match('#/upload/(?:v\d+/)?(.+?)\.[a-zA-Z0-9]+$#', $url, $matches)) {
            return null;
        }

        return $matches[1] ?? null;
    }
}
