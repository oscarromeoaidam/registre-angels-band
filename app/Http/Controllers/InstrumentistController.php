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
];

public function index(Request $request)
{
    $q = $request->string('q')->toString();

    // Ordre souhaité des rôles (Instrumentiste à la fin)
    $roleOrder = [
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
    ];

    $orderSql = "FIELD(roles.name, '" . implode("','", $roleOrder) . "')";

    $instrumentists = Instrumentist::query()
        ->with(['instruments', 'role'])
        ->leftJoin('roles', 'roles.id', '=', 'instrumentists.role_id')
        ->select('instrumentists.*')
        ->when($q, function ($query) use ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('instrumentists.first_name', 'like', "%$q%")
                    ->orWhere('instrumentists.last_name', 'like', "%$q%")
                    ->orWhere('instrumentists.nickname', 'like', "%$q%")
                    ->orWhere('instrumentists.phone', 'like', "%$q%")
                    ->orWhere('roles.name', 'like', "%$q%");
            })
            ->orWhereHas('instruments', function ($iq) use ($q) {
                $iq->where('name', 'like', "%$q%")
                   ->orWhere('category', 'like', "%$q%");
            });
        })
        ->orderByRaw($orderSql)
        ->orderBy('instrumentists.last_name')
        ->orderBy('instrumentists.first_name')
        ->paginate(12)
        ->withQueryString();

    // Calcul des KPI
    $leadershipRoles = ['Président', 'DT principal', 'DT Adjoint', 'Organisateur', 'Secretaire', 'trésoriere', 'chargé spirituel'];
    $leadershipCount = Instrumentist::whereHas('role', function($q) use ($leadershipRoles) {
        $q->whereIn('name', $leadershipRoles);
    })->count();

    $newMembersThisMonth = Instrumentist::whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();

    return view('instrumentists.index', array_merge([
        'instrumentists' => $instrumentists,
        'q' => $q,
        'totalMembers' => Instrumentist::count(),
        'leadershipCount' => $leadershipCount,
        'uniqueInstruments' => Instrument::distinct('name')->count(),
        'newMembersThisMonth' => $newMembersThisMonth,
    ]));
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
'role_id' => ['required','integer','exists:roles,id'],

            // ✅ multiple instruments
            'instrument_ids' => ['required', 'array', 'min:1', 'max:10'],
            'instrument_ids.*' => ['integer', 'exists:instruments,id'],

            // ✅ principal
            'primary_instrument_id' => ['required', 'integer', 'exists:instruments,id'],
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('instrumentists', 'public');
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
        'roles' => \App\Models\Role::orderBy('name')->get(),
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
'role_id' => ['required','integer','exists:roles,id'],

            // ✅ multiple instruments
            'instrument_ids' => ['required', 'array', 'min:1', 'max:10'],
            'instrument_ids.*' => ['integer', 'exists:instruments,id'],

            // ✅ principal
            'primary_instrument_id' => ['required', 'integer', 'exists:instruments,id'],
        ]);

        // ✅ upload photo (photo_path souligné venait souvent de $photoPath manquant)
        if ($request->hasFile('photo')) {
            if ($instrumentist->photo_path) {
                Storage::disk('public')->delete($instrumentist->photo_path);
            }
            $instrumentist->photo_path = $request->file('photo')->store('instrumentists', 'public');
        }

        // ✅ update fields (sans photo + instruments)
        $instrumentist->fill(
  collect($data)->except(['photo','instrument_ids','primary_instrument_id'])->all()
)->save();


        // ✅ sync instruments
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
            Storage::disk('public')->delete($instrumentist->photo_path);
        }

        $instrumentist->delete();

        return redirect()->route('instrumentists.index')->with('success', 'Instrumentiste supprimé.');
    }
}
