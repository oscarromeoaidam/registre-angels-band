<?php

namespace App\Http\Controllers;

use App\Models\Instrumentist;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ExportController extends Controller
{
    /**
     * Requete commune, partagee par les exports CSV, Excel et PDF :
     * reprend les memes filtres et la meme recherche que la liste affichee a l'ecran.
     */
    private function filteredInstrumentists(Request $request)
    {
        $q = $request->string('q')->toString();
        $roleFilter = $request->input('role');
        $sexFilter = $request->input('sex');
        $instrumentFilter = $request->input('instrument');

        return Instrumentist::query()
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
    }

    public function exportInstrumentists(Request $request)
    {
        $instrumentists = $this->filteredInstrumentists($request);

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="membres_orchestre_' . date('Y-m-d') . '.csv"',
        ];

        return new StreamedResponse(function () use ($instrumentists) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'ID', 'Nom', 'Prénom', 'Surnom', 'Sexe', 'Date de naissance',
                'Téléphone', 'Résidence', 'Rôle', 'Instruments', 'Âge'
            ]);

            foreach ($instrumentists as $member) {
                fputcsv($handle, [
                    $member->id,
                    $member->last_name,
                    $member->first_name,
                    $member->nickname,
                    $member->sex == 'M' ? 'Homme' : 'Femme',
                    $member->birth_date->format('d/m/Y'),
                    $member->phone,
                    $member->residence,
                    $member->role->name ?? 'N/A',
                    $member->instruments->pluck('name')->join(', '),
                    $member->age
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }

    public function exportInstrumentistsExcel(Request $request)
    {
        $instrumentists = $this->filteredInstrumentists($request);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Membres');

        $headings = ['ID', 'Nom', 'Prénom', 'Surnom', 'Sexe', 'Date de naissance', 'Téléphone', 'Résidence', 'Rôle', 'Instruments', 'Âge'];
        $sheet->fromArray($headings, null, 'A1');

        // Style de l'en-tete
        $headerRange = 'A1:K1';
        $sheet->getStyle($headerRange)->getFont()->setBold(true)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FFFFFFFF'));
        $sheet->getStyle($headerRange)->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('4F46E5');
        $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $row = 2;
        foreach ($instrumentists as $member) {
            $sheet->fromArray([
                $member->id,
                $member->last_name,
                $member->first_name,
                $member->nickname,
                $member->sex == 'M' ? 'Homme' : 'Femme',
                $member->birth_date->format('d/m/Y'),
                $member->phone,
                $member->residence,
                $member->role->name ?? 'N/A',
                $member->instruments->pluck('name')->join(', '),
                $member->age,
            ], null, 'A' . $row);
            $row++;
        }

        // Bordures legeres sur tout le tableau
        $lastRow = $row - 1;
        if ($lastRow >= 1) {
            $sheet->getStyle('A1:K' . $lastRow)->getBorders()->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FFD1D5DB'));
        }

        // Largeur de colonnes auto
        foreach (range('A', 'K') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        $sheet->freezePane('A2');

        $writer = new Xlsx($spreadsheet);
        $filename = 'membres_orchestre_' . date('Y-m-d') . '.xlsx';

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    public function exportInstrumentistsPdf(Request $request)
    {
        $instrumentists = $this->filteredInstrumentists($request);

        $pdf = Pdf::loadView('instrumentists.export-pdf', [
            'instrumentists' => $instrumentists,
            'generatedAt' => now(),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('rapport_membres_' . date('Y-m-d') . '.pdf');
    }
}
