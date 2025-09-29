@extends('dashboard.ressource.ange.layout.app')
@section('body')


    <!-- Page Wrapper -->
    <div id="wrapper">


                <!-- Begin Page Content -->
            <div class="container-fluid">
    <!-- Titre -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Emprunter le véhicule : {{ $vehicule->marque }} {{ $vehicule->modele }}</h1>
    </div>

    <!-- Formulaire -->
    <div class="card shadow p-4">
        <form action="{{ route('vehicules.emprunter', $vehicule->id) }}" method="POST" id="multiStepForm">
            @csrf

            <!-- Étape 1 -->
            <div id="step1">
                <h4 class="mb-3">Informations de l'emprunteur</h4>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="motif" class="form-label">Motif de l'emprunt</label>
                    <textarea name="motif" class="form-control"></textarea>
                </div>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Suivant</button>
            </div>

            <!-- Étape 2 -->
            <div id="step2" style="display: none;">
                <h4 class="mb-3">État du véhicule</h4>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ÉLÉMENTS</th>
                            <th>CORRECT</th>
                            <th>DÉFECTUEUX</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $elements = [
                                'Huile de frein' => 'brakeOil',
                                'Radiateur' => 'radiator',
                                'Huile de direction' => 'steeringOil',
                                'Huile de moteur' => 'engineOil',
                                'Essuie-glaces' => 'wipers',
                                'Rétroviseurs' => 'mirrors',
                                'Niveau des roues' => 'wheels',
                                'Signalisation' => 'signaling',
                                'Propreté du véhicule' => 'cleanliness',
                            ];
                        @endphp
                        @foreach ($elements as $label => $name)
                            <tr>
                                <td>{{ $label }}</td>
                                <td><input type="radio" name="{{ $name }}" value="correct"></td>
                                <td><input type="radio" name="{{ $name }}" value="defective"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="form-group">
                    <label>Aucune défectuosité détectée :</label>
                    <div class="d-flex gap-3">
                        <div><input type="radio" id="noDefectYes" name="noDefect" value="yes"> <label for="noDefectYes">Oui</label></div>
                        <div><input type="radio" id="noDefectNo" name="noDefect" value="no"> <label for="noDefectNo">Non</label></div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="observations" class="form-label">Observations</label>
                    <textarea name="observations" class="form-control" rows="3"></textarea>
                </div>

                <h5 class="mt-4">Détails départ / arrivée</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Départ</th>
                            <th>Arrivée</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Heure</td>
                            <td><input type="time" name="departureTime" class="form-control"></td>
                            <td><input type="time" name="arrivalTime" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Kilométrage</td>
                            <td><input type="number" name="departureKm" class="form-control"></td>
                            <td><input type="number" name="arrivalKm" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Kilomètres parcourus</td>
                            <td colspan="2"><input type="number" name="distanceTraveled" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Niveau de carburant</td>
                            <td>
                                <select name="fuelLevelDeparture" class="form-select">
                                    <option value="plein">Plein</option>
                                    <option value="3/4">3/4</option>
                                    <option value="1/2">1/2</option>
                                    <option value="1/4">1/4</option>
                                    <option value="reserve">Réserve</option>
                                </select>
                            </td>
                            <td>
                                <select name="fuelLevelArrival" class="form-select">
                                    <option value="plein">Plein</option>
                                    <option value="3/4">3/4</option>
                                    <option value="1/2">1/2</option>
                                    <option value="1/4">1/4</option>
                                    <option value="reserve">Réserve</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>État du véhicule</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <label><input type="radio" name="vehicleStateDeparture" value="bon"> Bon</label>
                                    <label><input type="radio" name="vehicleStateDeparture" value="moyen"> Moyen</label>
                                    <label><input type="radio" name="vehicleStateDeparture" value="mauvais"> Mauvais</label>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <label><input type="radio" name="vehicleStateArrival" value="bon"> Bon</label>
                                    <label><input type="radio" name="vehicleStateArrival" value="moyen"> Moyen</label>
                                    <label><input type="radio" name="vehicleStateArrival" value="mauvais"> Mauvais</label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-4 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" onclick="prevStep()">Retour</button>
                    <button type="submit" class="btn btn-success">Confirmer l’emprunt</button>
                </div>
            </div>
        </form>
    </div>

    <div class="text-end mt-4">
        <a href="{{ route('vehicules.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>


<script>
    function nextStep() {
        document.getElementById("step1").style.display = "none";
        document.getElementById("step2").style.display = "block";
    }

    function prevStep() {
        document.getElementById("step1").style.display = "block";
        document.getElementById("step2").style.display = "none";
    }
</script>


 

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
    

@endsection