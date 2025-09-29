<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Fiches de paie - Mois en cours</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</head>
<body>

<!-- Modal d'identification -->
<div class="modal fade" id="identificationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="GET" action="{{ route('fiche-paies') }}" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Identification requise</h5>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="nom" class="form-label">Nom</label>
          <input type="text" class="form-control" name="nom" value="{{ request('nom') }}" required>
        </div>
        <div class="mb-3">
          <label for="prenoms" class="form-label">Prénoms</label>
          <input type="text" class="form-control" name="prenoms" value="{{ request('prenoms') }}" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Valider</button>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    @if(!request()->has('nom') || !request()->has('prenoms'))
        let modal = new bootstrap.Modal(document.getElementById('identificationModal'));
        modal.show();
    @endif
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@if(!empty($paies) && $paies->count())
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Fiches de paie - Mois en cours</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f4f6f8;
      padding: 40px;
    }

    .container {
      background: white;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    header h1 {
      font-size: 24px;
      color: #2c3e50;
      border-bottom: 1px solid #ccc;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    .infos p {
      margin: 4px 0;
      font-size: 15px;
    }

    table {
      width: 100%;
      font-size: 14px;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
    }

    th {
      background-color: #3498db;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f8fd;
    }

    footer {
      margin-top: 20px;
      text-align: right;
      font-weight: bold;
      font-size: 16px;
      color: #27ae60;
    }
  </style>
</head>
<body>

<div class="container">
  <h2 class="mb-4 text-center">Fiches de paie du mois en cours</h2>

  <div class="accordion" id="accordionPaies">
    @foreach($paies as $paie)
      @php $employe = $paie->employe; @endphp
      <div class="accordion-item mb-3">
        <h2 class="accordion-header" id="heading{{ $paie->id }}">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $paie->id }}">
            {{ $employe->nom }} {{ $employe->prenoms }} — {{ \Carbon\Carbon::parse($paie->mois)->translatedFormat('F Y') }}
          </button>
        </h2>
        <div id="collapse{{ $paie->id }}" class="accordion-collapse collapse">
          <div class="accordion-body">
            <header>
              <h1>FICHE DE PAIE</h1>
              <p><strong>Période :</strong> {{ \Carbon\Carbon::parse($paie->mois)->translatedFormat('F Y') }}</p>
            </header>

            <section class="infos">
              <p><strong>Employé :</strong> {{ $employe->nom }} {{ $employe->prenoms }}</p>
              <p><strong>Poste :</strong> {{ $employe->poste }}</p>
              <p><strong>Type de contrat :</strong> {{ $employe->type_contrat }}</p>
              <p><strong>Heures mensuelles :</strong> {{ $employe->nb_heures_semaine }}</p>
            </section>

            <table>
              <thead>
                <tr><th>Libellé</th><th>Taux</th><th>À retenir</th><th>Montant</th></tr>
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
              <p>NET À PAYER : {{ number_format($paie->salaire_net, 2, ',', ' ') }} {{ $employe->devise }}</p>
            </footer>

            <div class="text-end mt-3">
              <a href="{{ route('paies.telecharger', $paie->id) }}" class="btn btn-sm btn-success" onclick="telechargerBulletin(event, this)">
                <i class="fas fa-file-pdf"></i> Télécharger le bulletin
              </a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="text-end mt-3">
    <a href="{{ url()->current() }}" class="btn btn-sm btn-info">
      <i class="fas fa-arrow-left"></i> Refaire une recherche
    </a>
  </div>
</div>

<script>
function telechargerBulletin(event, el) {
    event.preventDefault();
    const url = el.getAttribute('href');
    const lien = document.createElement('a');
    lien.href = url;
    lien.setAttribute('download', '');
    document.body.appendChild(lien);
    lien.click();
    lien.remove();
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@else
    <div class="alert alert-warning text-center mt-5">Aucune fiche de paie trouvée pour ce nom et prénoms.</div>
@endif
