
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
<link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">


                <!-- Begin Page Content -->
                <div class="container-fluid">


<div class="card-body p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

<h1>Retour du véhicule : {{ $vehicule->marque }} {{ $vehicule->modele }}</h1>
<p>Nom de l’emprunteur : {{ $emprunt->nom }} {{ $emprunt->prenom }}</p>
<p>Email : {{ $emprunt->email }}</p>



<form action="{{ route('vehicules.retourner', $vehicule->id) }}" method="POST">
    @csrf

    <div class="card shadow p-4">
        <h4 class="mb-3">Retour du véhicule : {{ $vehicule->marque }} {{ $vehicule->modele }}</h4>

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" value="{{ $emprunt->nom }}" disabled>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" value="{{ $emprunt->prenom }}" disabled>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" value="{{ $emprunt->email }}" disabled>
        </div>

        <h5>Données de retour</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Heure d'arrivée</label>
                <input type="time" name="arrivalTime" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Kilométrage à l'arrivée</label>
                <input type="number" name="arrivalKm" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Kilomètres parcourus</label>
            <input type="number" name="distanceTraveled" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Niveau de carburant à l'arrivée</label>
            <select name="fuelLevelArrival" class="form-select" required>
                <option value="">Choisir...</option>
                <option value="plein">Plein</option>
                <option value="3/4">3/4</option>
                <option value="1/2">1/2</option>
                <option value="1/4">1/4</option>
                <option value="reserve">Réserve</option>
            </select>
        </div>

        <div class="mb-3">
            <label>État du véhicule à l'arrivée</label>
            <div class="d-flex gap-2">
                <label><input type="radio" name="vehicleStateArrival" value="bon" required> Bon</label>
                <label><input type="radio" name="vehicleStateArrival" value="moyen"> Moyen</label>
                <label><input type="radio" name="vehicleStateArrival" value="mauvais"> Mauvais</label>
            </div>
        </div>

        <div class="text-end mt-3">
            <button type="submit" class="btn btn-success">Confirmer le retour</button>
        </div>
    </div>
</form>
<a href="/vehicules" class="btn btn-warning">
    Retourner
</a>
         </div>


            </div>
            <!-- End of Main Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST" action="">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

   <!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

</body>

</html>