<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use App\Models\Instrumentist;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class InstrumentistController extends Controller
{
    private const ROLES = [
        'Président',
        'DT principal',
        'DT Adjoint',
        'DT Alto',
        'DT Soprano',
        'DT tenor',
        'DT basse',
        'Organisateur',
        'Secretaire',
        'trésoriere',
        'chargé spirituel',
        'Instrumentiste',
        'Conseiller'
    ];

    public function index(Request $request)
    {
        $q = $request->string('q')->toString();
        $roleFilter = $request->input('role');
        $sexFilter = $request->input('sex');
        $instrumentFilter = $request->input('instrument');
        $perPage = $request->input('per_page', 15);

        // Ordre souhaité des rôles
        $roleOrder = [
            'Président',
            'DT principal',
            'DT Adjoint',
            'Organisateur',
            'Secretaire',
            'trésoriere',
            'Conseiller',
            'chargé spirituel',
            'DT Soprano',
            'DT Alto',
            'DT tenor',
            'DT basse',
            'Instrumentiste',
        ];

        $caseSql = "CASE roles.name ";
        foreach ($roleOrder as $position => $roleName) {
            $escaped = str_replace("'", "''", $roleName);
            $caseSql .= "WHEN '{$escaped}' THEN {$position} ";
        }
        $caseSql .= "ELSE " . count($roleOrder) . " END";
        $orderSql = $caseSql;

        $instrumentists = Instrumentist::query()
            ->with(['instruments', 'role'])
            ->leftJoin('roles', 'roles.id', '=', 'instrumentists.role_id')
            ->select('instrumentists.*')
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('instrumentists.first_name', 'ilike', "%$q%")
                        ->orWhere('instrumentists.last_name', 'ilike', "%$q%")
                        ->orWhere('instrumentists.nickname', 'ilike', "%$q%")
                        ->orWhere('instrumentists.phone', 'ilike', "%$q%")
                        ->orWhere('roles.name', 'ilike', "%$q%");
                })
                ->orWhereHas('instruments', function ($iq) use ($q) {
                    $iq->where('name', 'ilike', "%$q%")
                       ->orWhere('category', 'ilike', "%$q%");
                });
            })
            ->when($roleFilter, function ($query) use ($roleFilter) {
                $query->where('role_id', $roleFilter);
            })
            ->when($sexFilter, function ($query) use ($sexFilter) {
                $query->where('sex', $sexFilter);
            })
            ->when($instrumentFilter, function ($query) use ($instrumentFilter) {
                $query->whereHas('instruments', function ($q) use ($instrumentFilter) {
                    $q->where('instrument_id', $instrumentFilter);
                });
            })
            ->orderByRaw($orderSql)
            ->orderBy('instrumentists.last_name')
            ->orderBy('instrumentists.first_name')
            ->paginate($perPage)
            ->withQueryString();

        // Calcul des KPI
        $leadershipRoles = [
            'Président', 'DT principal', 'DT Adjoint', 'Organisateur', 
            'Secretaire', 'trésoriere', 'chargé spirituel', 'Conseiller'
        ];
        
        $leadershipCount = Instrumentist::whereHas('role', function($q) use ($leadershipRoles) {
            $q->whereIn('name', $leadershipRoles);
        })->count();

        $newMembersThisMonth = Instrumentist::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $femaleCount = Instrumentist::where('sex', 'F')->count();
        $maleCount = Instrumentist::where('sex', 'M')->count();
        $totalMembers = Instrumentist::count();

        // Statistiques par catégorie d'instrument
        $sopranoCount = $this->countByInstrumentCategory('Soprano');
        $altoCount = $this->countByInstrumentCategory('Alto');
        $tenorCount = $this->countByInstrumentCategory('Ténor');
        $bassCount = $this->countByInstrumentCategory('Basse');

        return view('instrumentists.index', [
            'instrumentists' => $instrumentists,
            'q' => $q,
            'totalMembers' => $totalMembers,
            'leadershipCount' => $leadershipCount,
            'newMembersThisMonth' => $newMembersThisMonth,
            'femaleCount' => $femaleCount,
            'maleCount' => $maleCount,
            'sopranoCount' => $sopranoCount,
            'altoCount' => $altoCount,
            'tenorCount' => $tenorCount,
            'bassCount' => $bassCount,
            'roles' => Role::orderBy('name')->get(),
            'instruments' => Instrument::orderBy('category')->orderBy('name')->get(),
        ]);
    }

    private function countByInstrumentCategory($category)
    {
        return Instrumentist::whereHas('instruments', function ($query) use ($category) {
            $query->where('category', $category);
        })->count();
    }

    public function create()
    {
        return view('instrumentists.create', [
            'instruments' => Instrument::orderBy('category')->orderBy('name')->get(),
            'roles' => Role::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'nickname' => ['nullable', 'string', 'max:100'],
            'sex' => ['required', 'in:M,F'],
            'birth_date' => ['required', 'date'],
            'residence' => ['required', 'string', 'max:150'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:100'],
            'role_id' => ['required','integer','exists:roles,id'],
            'instrument_ids' => ['required', 'array', 'min:1', 'max:10'],
            'instrument_ids.*' => ['integer', 'exists:instruments,id'],
            'primary_instrument_id' => ['required', 'integer', 'exists:instruments,id'],
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $cloudinaryPath = $request->file('photo')->store('instrumentists', 'cloudinary');
            $photoPath = Storage::disk('cloudinary')->url($cloudinaryPath);
        }

        $instrumentist = Instrumentist::create([
            ...collect($data)->except(['photo', 'instrument_ids', 'primary_instrument_id'])->all(),
            'photo_path' => $photoPath,
        ]);

        $ids = $data['instrument_ids'];
        $primary = (int) $data['primary_instrument_id'];

        if (!in_array($primary, $ids, true)) {
            $ids[] = $primary;
        }

        $pivot = [];
        foreach ($ids as $id) {
            $pivot[$id] = ['is_primary' => ((int) $id === $primary)];
        }

        $instrumentist->instruments()->sync($pivot);

        return redirect()->route('instrumentists.index')->with('success', 'Instrumentiste ajouté.');
    }

    public function show(Instrumentist $instrumentist)
    {
        $instrumentist->load('instruments');
        return view('instrumentists.show', compact('instrumentist'));
    }

    public function edit(Instrumentist $instrumentist)
    {
        $instrumentist->load('instruments','role');

        return view('instrumentists.edit', [
            'instrumentist' => $instrumentist,
            'instruments' => Instrument::orderBy('category')->orderBy('name')->get(),
            'roles' => Role::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Instrumentist $instrumentist)
    {
        $data = $request->validate([
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'nickname' => ['nullable', 'string', 'max:100'],
            'sex' => ['required', 'in:M,F'],
            'birth_date' => ['required', 'date'],
            'residence' => ['required', 'string', 'max:150'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:100'],
            'role_id' => ['required','integer','exists:roles,id'],
            'instrument_ids' => ['required', 'array', 'min:1', 'max:10'],
            'instrument_ids.*' => ['integer', 'exists:instruments,id'],
            'primary_instrument_id' => ['required', 'integer', 'exists:instruments,id'],
        ]);

        if ($request->hasFile('photo')) {
            if ($instrumentist->photo_path) {
                $oldPublicId = $this->extractCloudinaryPublicId($instrumentist->photo_path);
                if ($oldPublicId) {
                    Storage::disk('cloudinary')->delete($oldPublicId);
                }
            }
            $cloudinaryPath = $request->file('photo')->store('instrumentists', 'cloudinary');
            $instrumentist->photo_path = Storage::disk('cloudinary')->url($cloudinaryPath);
        }

        $instrumentist->fill(
            collect($data)->except(['photo','instrument_ids','primary_instrument_id'])->all()
        )->save();

        $ids = $data['instrument_ids'];
        $primary = (int) $data['primary_instrument_id'];

        if (!in_array($primary, $ids, true)) {
            $ids[] = $primary;
        }

        $pivot = [];
        foreach ($ids as $id) {
            $pivot[$id] = ['is_primary' => ((int) $id === $primary)];
        }

        $instrumentist->instruments()->sync($pivot);

        return redirect()->route('instrumentists.show', $instrumentist)->with('success', 'Mise à jour effectuée.');
    }

    public function destroy(Instrumentist $instrumentist)
    {
        if ($instrumentist->photo_path) {
            $publicId = $this->extractCloudinaryPublicId($instrumentist->photo_path);
            if ($publicId) {
                Storage::disk('cloudinary')->delete($publicId);
            }
        }

        $instrumentist->delete();

        return redirect()->route('instrumentists.index')->with('success', 'Instrumentiste supprimé.');
    }

    /**
     * Extrait le public_id Cloudinary (ex: "instrumentists/abc123") a partir
     * d'une URL Cloudinary complete, afin de pouvoir supprimer le fichier.
     */
    private function extractCloudinaryPublicId(string $url): ?string
    {
        // Exemple d'URL Cloudinary :
        // https://res.cloudinary.com/<cloud_name>/image/upload/v1234567890/instrumentists/abc123.jpg
        if (!preg_match('#/upload/(?:v\d+/)?(.+?)\.[a-zA-Z0-9]+$#', $url, $matches)) {
            return null;
        }

        return $matches[1] ?? null;
    }
}
