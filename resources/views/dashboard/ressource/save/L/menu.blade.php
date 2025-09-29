<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Portail Employé</title>

  <!-- ✅ Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- ✅ Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      background-color: #f8f9fc;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card:hover {
      transform: translateY(-5px);
      transition: all 0.3s ease;
    }

    .card-icon {
      font-size: 2.5rem;
      margin-bottom: 10px;
    }

    .action-title {
      font-weight: bold;
      font-size: 1.1rem;
    }
  </style>
</head>
<body>

<div class="container py-4">
  <h2 class="text-center mb-5 text-primary">Bienvenue sur votre espace employé</h2>

  <div class="row justify-content-center g-4">

    <!-- Fiche de paie -->
    <!-- <div class="col-sm-6 col-md-4 col-lg-3">
      <div class="card text-center border-success shadow-sm">
        <div class="card-body">
          <div class="text-success card-icon"><i class="fas fa-file-invoice-dollar"></i></div>
          <div class="action-title text-success mb-2">Fiche de paie</div>
          <a href="/fiche-paies" class="btn btn-success w-100">Voir</a>
        </div>
      </div>
    </div> -->

    <!-- Demande de congé -->
    <div class="col-sm-6 col-md-4 col-lg-3">
      <div class="card text-center border-warning shadow-sm">
        <div class="card-body">
          <div class="text-warning card-icon"><i class="fas fa-calendar-alt"></i></div>
          <div class="action-title text-warning mb-2">Demande de congé</div>
          <a href="/conge" class="btn btn-warning text-white w-100">Demander</a>
        </div>
      </div>
    </div>

    <!-- Documents -->
    <div class="col-sm-6 col-md-4 col-lg-3">
      <div class="card text-center border-info shadow-sm">
        <div class="card-body">
          <div class="text-info card-icon"><i class="fas fa-calendar-alt"></i>
</div>
          <div class="action-title text-info mb-2">Presence</div>
          <a href="/presence-formulaire" class="btn btn-info text-white w-100">Presence</a>
        </div>
      </div>
    </div>

    <!-- Autre -->
    <div class="col-sm-6 col-md-4 col-lg-3">
      <div class="card text-center border-primary shadow-sm">
        <div class="card-body">
          <div class="text-primary card-icon"><i class="fas fa-plus-circle"></i></div>
          <div class="action-title text-primary mb-2">Autre</div>
          <a href="#" class="btn btn-primary w-100">Action</a>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- JS Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
