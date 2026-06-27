<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
    @page {
        margin: 90px 40px 60px 40px;
    }

    body {
        font-family: 'DejaVu Sans', sans-serif;
        color: #1f2937;
        font-size: 11px;
    }

    header {
        position: fixed;
        top: -70px;
        left: 0;
        right: 0;
        height: 70px;
        border-bottom: 2px solid #4f46e5;
        padding-bottom: 10px;
    }

    header .brand {
        font-size: 20px;
        font-weight: bold;
        color: #4f46e5;
    }

    header .subtitle {
        font-size: 11px;
        color: #6b7280;
        margin-top: 2px;
    }

    header .meta {
        position: absolute;
        top: 0;
        right: 0;
        text-align: right;
        font-size: 10px;
        color: #6b7280;
    }

    footer {
        position: fixed;
        bottom: -45px;
        left: 0;
        right: 0;
        height: 40px;
        text-align: center;
        font-size: 9px;
        color: #9ca3af;
        border-top: 1px solid #e5e7eb;
        padding-top: 8px;
    }

    h1.report-title {
        font-size: 16px;
        color: #111827;
        margin: 0 0 4px 0;
    }

    p.report-summary {
        font-size: 10px;
        color: #6b7280;
        margin: 0 0 16px 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead th {
        background-color: #4f46e5;
        color: #ffffff;
        font-size: 9.5px;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        padding: 8px 6px;
        text-align: left;
    }

    tbody td {
        padding: 7px 6px;
        border-bottom: 1px solid #e5e7eb;
        font-size: 10px;
    }

    tbody tr:nth-child(even) {
        background-color: #f9fafb;
    }

    .badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 9px;
        font-weight: bold;
        background-color: #eef2ff;
        color: #4338ca;
    }

    .text-center {
        text-align: center;
    }
</style>
</head>
<body>

<header>
    <div class="brand">Fanfare Angel's Band</div>
    <div class="subtitle">Registre des talents musicaux</div>
    <div class="meta">
        Rapport généré le {{ $generatedAt->format('d/m/Y à H:i') }}<br>
        {{ $instrumentists->count() }} membre(s)
    </div>
</header>

<footer>
    Fanfare Angel's Band — Registre Orchestral — Document confidentiel à usage interne
</footer>

<h1 class="report-title">Liste des membres de l'orchestre</h1>
<p class="report-summary">Rapport officiel généré automatiquement depuis le registre orchestral.</p>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Surnom</th>
            <th class="text-center">Sexe</th>
            <th class="text-center">Âge</th>
            <th>Téléphone</th>
            <th>Résidence</th>
            <th>Rôle</th>
            <th>Instruments</th>
        </tr>
    </thead>
    <tbody>
        @foreach($instrumentists as $member)
        <tr>
            <td>{{ $member->last_name }}</td>
            <td>{{ $member->first_name }}</td>
            <td>{{ $member->nickname ?? '—' }}</td>
            <td class="text-center">{{ $member->sex == 'M' ? 'H' : 'F' }}</td>
            <td class="text-center">{{ $member->age }}</td>
            <td>{{ $member->phone }}</td>
            <td>{{ $member->residence }}</td>
            <td><span class="badge">{{ $member->role->name ?? 'N/A' }}</span></td>
            <td>{{ $member->instruments->pluck('name')->join(', ') ?: '—' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
