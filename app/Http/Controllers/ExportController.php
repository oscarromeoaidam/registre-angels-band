<?php

namespace App\Http\Controllers;

use App\Models\Instrumentist;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function exportInstrumentists(Request $request)
    {
        $q = $request->string('q')->toString();
        $roleFilter = $request->input('role');
        $sexFilter = $request->input('sex');
        $instrumentFilter = $request->input('instrument');

        $instrumentists = Instrumentist::query()
            ->with(['role', 'instruments'])
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
            ->orderBy('instrumentists.last_name')
            ->orderBy('instrumentists.first_name')
            ->get();
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="membres_orchestre_' . date('Y-m-d') . '.csv"',
        ];
        
        return new StreamedResponse(function () use ($instrumentists) {
            $handle = fopen('php://output', 'w');
            
            // En-têtes CSV
            fputcsv($handle, [
                'ID', 'Nom', 'Prénom', 'Surnom', 'Sexe', 'Date de naissance',
                'Téléphone', 'Email', 'Résidence', 'Lieu de naissance', 'Rôle',
                'Instruments', 'Date d\'adhésion', 'Âge'
            ]);
            
            // Données
            foreach ($instrumentists as $member) {
                fputcsv($handle, [
                    $member->id,
                    $member->last_name,
                    $member->first_name,
                    $member->nickname,
                    $member->sex == 'M' ? 'Homme' : 'Femme',
                    $member->birth_date->format('d/m/Y'),
                    $member->phone,
                    $member->email ?? '',
                    $member->residence,
                    $member->birth_place ?? '',
                    $member->role->name ?? 'N/A',
                    $member->instruments->pluck('name')->join(', '),
                    $member->date_joined?->format('d/m/Y'),
                    $member->age
                ]);
            }
            
            fclose($handle);
        }, 200, $headers);
    }
}
