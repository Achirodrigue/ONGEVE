<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Fiche de paie</title>
  <style>
    body {
      font-family: 'DejaVu Sans', sans-serif;
      background: #fff;
      margin: 0;
      padding: 30px;
      font-size: 13px;
      color: #333;
    }

    .container {
      background: white;
      max-width: 800px;
      margin: auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 12px;
    }

    header {
      text-align: center;
      border-bottom: 2px solid #ccc;
      margin-bottom: 20px;
    }

    header h1 {
      margin: 0;
      color: #2c3e50;
    }

    .infos p {
      margin: 5px 0;
      color: #444;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 12px;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #2980b9;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    footer {
      margin-top: 20px;
      text-align: right;
      font-size: 14px;
      font-weight: bold;
      color: #27ae60;
    }
  </style>
</head>
<body>

  <div class="container">
    <header>
      <h1>FICHE DE PAIE</h1>
      <p>Période : <strong>{{ \Carbon\Carbon::parse($paie->mois)->translatedFormat('F Y') }}</strong></p>
    </header>

    <section class="infos">
      <p><strong>Employé :</strong> {{ $employe->nom }} {{ $employe->prenoms }}</p>
      <p><strong>Poste :</strong> {{ $employe->poste }}</p>
      <p><strong>Type de contrat :</strong> {{ $employe->type_contrat }}</p>
      <p><strong>Heures mensuelles :</strong> {{ $employe->nb_heures_semaine }}</p>
    </section>

    <table>
      <thead>
        <tr>
          <th>Libellé</th>
          <th>Taux</th>
          <th>À retenir</th>
          <th>Montant</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>Salaire de base</td><td>-</td><td>-</td><td>{{ number_format($paie->salaire_base, 2, ',', ' ') }} {{ $employe->devise }}</td></tr>
        <tr><td>Primes</td><td>-</td><td>-</td><td>{{ number_format($paie->primes, 2, ',', ' ') }} {{ $employe->devise }}</td></tr>
        <tr><td>Heures supplémentaires</td><td>-</td><td>-</td><td>{{ number_format($paie->montant_heures_supplementaires, 2, ',', ' ') }} {{ $employe->devise }}</td></tr>
        <tr><td>Indemnités</td><td>-</td><td>-</td><td>{{ number_format($paie->indemnites, 2, ',', ' ') }} {{ $employe->devise }}</td></tr>
        <tr><td>CNPS</td><td>-</td><td>{{ number_format($paie->cnps, 2, ',', ' ') }} {{ $employe->devise }}</td><td>-</td></tr>
        <tr><td>Impôt</td><td>-</td><td>{{ number_format($paie->impot, 2, ',', ' ') }} {{ $employe->devise }}</td><td>-</td></tr>
        <tr><td>Avance sur salaire</td><td>-</td><td>{{ number_format($paie->avance_salaire, 2, ',', ' ') }} {{ $employe->devise }}</td><td>-</td></tr>
        <tr><td>Autres retenues</td><td>-</td><td>{{ number_format($paie->autres_retenues, 2, ',', ' ') }} {{ $employe->devise }}</td><td>-</td></tr>
      </tbody>
    </table>

    <footer>
      NET À PAYER : {{ number_format($paie->salaire_net, 2, ',', ' ') }} {{ $employe->devise }}
    </footer>
  </div>

</body>
</html>
