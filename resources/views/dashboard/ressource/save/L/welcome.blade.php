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
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>RH</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Employe:</h6>
                        <a class="collapse-item" href="/employes">Liste Employe</a>
                        <a class="collapse-item" href="/entretien">Entretien</a>
                        <a class="collapse-item" href="/conges">Conge</a>
                        <a class="collapse-item" href="/paiement">Paiement</a>
                        <a class="collapse-item" href="/presence">Presence</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>RHcom</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">RH:</h6>
                        <a class="collapse-item" href="/conge">Demande Conge</a>
                        <a class="collapse-item" href="/paie">Fiche de Paie</a>
                        <a class="collapse-item" href="/document">Document</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="/login">Login</a>
                        <a class="collapse-item" href="/register">Register</a>
                        <a class="collapse-item" href="/forgot-password">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item collapse-item">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                        </button>
                    </form>
                    </div>
                </div>
            </li>



            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        @if(count($conge_notifications) > 0)
            <span class="badge badge-danger badge-counter">{{ count($conge_notifications) }}</span>
        @endif
    </a>

    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
            Demandes de congé en attente
        </h6>

        @forelse($conge_notifications as $conge)
            <a class="dropdown-item d-flex align-items-center" href="{{ route('conges') }}">
                <div class="mr-3">
                    <div class="icon-circle bg-warning">
                        <i class="fas fa-envelope-open-text text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">{{ $conge->created_at->format('d/m/Y') }}</div>
                    <span class="font-weight-bold">
                        {{ $conge->nom }} {{ $conge->prenom }} : {{ $conge->motif }}
                    </span>
                    <div>Début : {{ $conge->date_debut->format('d/m/Y') }}</div>
                </div>
            </a>
        @empty
            <a class="dropdown-item text-center small text-gray-500" href="#">Aucune nouvelle demande</a>
        @endforelse

        <a class="dropdown-item text-center small text-primary" href="{{ route('conges') }}">
            Voir toutes les demandes
        </a>
    </div>
</li>

<!-- Nav Item - Document Requests -->
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="docsDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-file-alt fa-fw"></i>
        @if(count($doc_notifications) > 0)
            <span class="badge badge-danger badge-counter">{{ count($doc_notifications) }}</span>
        @endif
    </a>

    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="docsDropdown">
        <h6 class="dropdown-header">
            Demandes de documents
        </h6>

        @forelse($doc_notifications as $doc)
            <a class="dropdown-item d-flex align-items-center" href="{{ route('document') }}">
                <div class="mr-3">
                    <div class="icon-circle bg-info">
                        <i class="fas fa-file-alt text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">{{ $doc->created_at->format('d/m/Y') }}</div>
                    <span class="font-weight-bold">
                        {{ $doc->nom_demandeur }} {{ $doc->prenoms_demandeur }} :
                        {{ $doc->type_document }}
                    </span>
                    @if($doc->titre_document)
                        <div>{{ $doc->titre_document }}</div>
                    @endif
                </div>
            </a>
        @empty
            <a class="dropdown-item text-center small text-gray-500" href="#">Aucune demande</a>
        @endforelse

        <a class="dropdown-item text-center small text-primary" href="{{ route('document') }}">
            Voir toutes les demandes
        </a>
    </div>
</li>

                        <!-- Nav Item - Messages -->
                       <!-- Nav Item - Messages -->
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-envelope fa-fw"></i>
        <!-- Counter - Messages -->
        <span class="badge badge-danger badge-counter">{{ count($entretiens ?? []) }}</span>
    </a>

    <!-- Dropdown - Messages -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header">
            Entretiens récents
        </h6>

        @forelse($entretiens as $entretien)
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="{{ Auth::user()->photo_profil ?? 'img/default.png' }}" alt="...">
                    <div class="status-indicator bg-success"></div>
                </div>
                <div class="font-weight-bold">
                    <div class="text-truncate">
                        {{ ucfirst($entretien->type) }} – {{ \Carbon\Carbon::parse($entretien->date_entretien)->format('d/m/Y') }}
                    </div>
                    <div class="small text-gray-500">{{ $entretien->lieu ?? 'Lieu non précisé' }}</div>
                </div>
            </a>
        @empty
            <a class="dropdown-item text-center small text-gray-500">Aucun entretien</a>
        @endforelse

        <a class="dropdown-item text-center small text-gray-500" href="{{ route('entretien') }}">
            Voir tous les entretiens
        </a>
    </div>
</li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nom }} {{ Auth::user()->prenoms }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ Auth::user()->photo_profil ? asset('storage/' . Auth::user()->photo_profil) : asset('img/default-profile.png') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>

                                    <a type="submit" class="dropdown-item collapse-item" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                                    </a>
                               
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

 <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">RH Com</h1>

  <div>
    <button onclick="openModal()" class="btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-plus fa-sm text-white-50"></i> Ajouter un Employé
    </button>
    <button onclick="openModalqr()" class="btn btn-sm btn-info shadow-sm ms-2">
      <i class="fas fa-plus fa-sm text-white-50"></i> Qr code menu
    </button>
  </div>
</div>

<div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content text-center p-4">
      <h5 class="modal-title mb-3" id="qrModalLabel">QR Code d'enregistrement</h5>
      <div id="qrcode"></div>
      <a id="downloadBtn" class="btn btn-success mt-3" download="vehicule-qr.png">Télécharger le QR Code</a>
    </div>
  </div>
</div>
<script>
function openModalqr() {
    const url = "{{ url('/menu') }}"; // lien vers le formulaire Laravel
    const qrcodeContainer = document.getElementById('qrcode');
    qrcodeContainer.innerHTML = ''; // réinitialiser à chaque ouverture

    const qr = new QRCode(qrcodeContainer, {
        text: url,
        width: 200,
        height: 200
    });

    // Attendre un peu que le QR soit généré puis créer le lien de téléchargement
    setTimeout(() => {
        const qrCanvas = qrcodeContainer.querySelector('canvas');
        if (qrCanvas) {
            const dataURL = qrCanvas.toDataURL("image/png");
            document.getElementById("downloadBtn").href = dataURL;
        }
    }, 300);

    // Ouvrir le modal
    new bootstrap.Modal(document.getElementById('qrModal')).show();
}
</script>
<!-- Modal -->
<div id="modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajouter un employé</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Cercles de progression -->
        <div class="d-flex justify-content-center mb-3">
          <div id="step1-circle" class="step-circle active"></div>
          <div id="step2-circle" class="step-circle ml-2"></div>
          <div id="step3-circle" class="step-circle ml-2"></div>
        </div>

        <!-- Formulaire -->
        <form id="multiStepForm" method="POST" action="{{ route('employes.store') }}" enctype="multipart/form-data">
          @csrf

          <!-- Etape 1 -->
          <div id="step1" class="step">
            <h5>Informations personnelles</h5>
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="nom" placeholder="Nom" class="form-control required-field" required>
              </div>
              <div class="form-group col-md-6">
                <input type="text" name="prenoms" placeholder="Prénoms" class="form-control required-field" required>
              </div>
              <div class="form-group col-md-6">
                <input type="date" name="date_naissance" class="form-control required-field" required>
              </div>
              <div class="form-group col-md-6">
                <input type="text" name="lieu_naissance" placeholder="Lieu de naissance" class="form-control required-field" required>
              </div>
              <div class="form-group col-md-6">
                <select name="genre" class="form-control required-field" required>
                  <option value="">Genre</option>
                  <option value="Homme">Homme</option>
                  <option value="Femme">Femme</option>
                  <option value="Autre">Autre</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <input type="email" name="email" placeholder="Email" class="form-control required-field" required>
              </div>
              <div class="form-group col-md-6">
                <input type="text" name="telephone" placeholder="Téléphone" class="form-control required-field" required>
              </div>
              <div class="form-group col-md-6">
                <input type="text" name="adresse" placeholder="Adresse" class="form-control required-field" required>
              </div>
              <div class="form-group col-md-12">
                <input type="file" name="photo_profil" class="form-control-file">
              </div>
            </div>
          </div>

          <!-- Etape 2 -->
          <div id="step2" class="step d-none">
            <h5>Informations professionnelles</h5>
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="matricule" placeholder="Matricule" class="form-control required-field" required>
              </div>
              <div class="form-group col-md-6">
                <input type="text" name="poste" placeholder="Poste" class="form-control required-field" required>
              </div>
              <div class="form-group col-md-6">
                <input type="text" name="grade" placeholder="Grade" class="form-control required-field" required>
              </div>
              <div class="form-group col-md-6">
                <input type="number" name="departement_id" placeholder="ID Département" class="form-control">
              </div>
            <div class="form-group col-md-6">
                <input type="number" name="user_id" placeholder="ID user" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <input type="number" name="superieur_id" placeholder="ID Supérieur" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <select name="statut" class="form-control required-field" required>
                  <option value="">Statut</option>
                  <option value="Actif">Actif</option>
                  <option value="Suspendu">Suspendu</option>
                  <option value="Démissionnaire">Démissionnaire</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <input type="date" name="date_embauche" class="form-control required-field" required>
              </div>
              <div class="form-group col-md-6">
                <select name="type_contrat" class="form-control required-field" required>
                  <option value="">Type de contrat</option>
                  <option value="CDI">CDI</option>
                  <option value="CDD">CDD</option>
                  <option value="Stage">Stage</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <input type="number" name="salaire_de_base" placeholder="Salaire de base" class="form-control required-field" required>
              </div>
                <div class="form-group col-md-6">
                <select name="devise" class="form-control required-field" required>
                    <option value="">Sélectionnez une devise</option>
                    <option value="XOF">XOF - Franc CFA</option>
                    <option value="USD">USD - Dollar Américain</option>
                    <option value="EUR">EUR - Euro</option>
                    <option value="GBP">GBP - Livre Sterling</option>
                    <option value="NGN">NGN - Naira Nigérian</option>
                    <option value="CAD">CAD - Dollar Canadien</option>
                    <option value="JPY">JPY - Yen Japonais</option>
                    <!-- ajoute d'autres devises si nécessaire -->
                </select>
                </div>

              <div class="form-group col-md-6">
                <input type="number" name="nb_heures_semaine" placeholder="Heures/semaine" class="form-control required-field" required>
              </div>
            </div>
          </div>

          <!-- Etape 3 -->
          <div id="step3" class="step d-none">
            <h5>Infos administratives et bancaires</h5>
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="file" name="cv_path" class="form-control-file">
              </div>
              <div class="form-group col-md-6">
                <input type="file" name="lettre_motivation_path" class="form-control-file">
              </div>
              <div class="form-group col-md-6">
                <input type="file" name="contrat_path" class="form-control-file">
              </div>
              <div class="form-group col-md-6">
                <input type="file" name="photo_piece_identite_path" class="form-control-file">
              </div>
              <div class="form-group col-md-6">
                <input type="text" name="num_cnps" placeholder="Numéro CNPS" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <input type="text" name="num_impots" placeholder="Numéro Impôts" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <input type="text" name="banque" placeholder="Banque" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <input type="text" name="num_compte_bancaire" placeholder="N° Compte bancaire" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <select name="situation_matrimoniale" class="form-control required-field" required>
                  <option value="">Situation matrimoniale</option>
                  <option value="Célibataire">Célibataire</option>
                  <option value="Marié(e)">Marié(e)</option>
                  <option value="Divorcé(e)">Divorcé(e)</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <input type="number" name="nb_enfants" placeholder="Nombre d'enfants" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <input type="text" name="niveau_etude" placeholder="Niveau d'étude" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <input type="text" name="dernier_etablissement" placeholder="Dernier établissement" class="form-control">
              </div>
            </div>
                      <!-- Soumission globale -->
          <div class="form-group mt-4">
            <button type="submit" class="btn btn-success btn-block">Soumettre l'employé</button>
          </div>
          </div>



          <!-- Navigation -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="prevStep()">Précédent</button>
            <button type="button" class="btn btn-primary" onclick="nextStep()">Suivant</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Styles -->
<style>
  .step-circle {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #ddd;
    transition: background-color 0.3s ease;
  }
  .step-circle.valid {
    background-color: #28a745;
  }
  .step-circle.active {
    background-color: #007bff;
  }
  .step-circle.error {
    background-color: #dc3545;
  }
</style>

<!-- Script -->
<script>
  let currentStep = 1;

  function openModal() {
    $('#modal').modal('show');
    updateStep();
  }

  function closeModal() {
    $('#modal').modal('hide');
    currentStep = 1;
    updateStep();
  }

  function nextStep() {
    const stepId = `step${currentStep}`;
    const inputs = document.querySelectorAll(`#${stepId} .required-field`);
    let allValid = true;

    inputs.forEach(input => {
      if (!input.value.trim()) {
        allValid = false;
        input.classList.add('is-invalid');
      } else {
        input.classList.remove('is-invalid');
      }
    });

    const circle = document.getElementById(`${stepId}-circle`);
    if (allValid) {
      circle.classList.remove('active', 'error');
      circle.classList.add('valid');
      if (currentStep < 3) {
        currentStep++;
        updateStep();
      }
    } else {
      circle.classList.remove('valid');
      circle.classList.add('error');
    }
  }

  function prevStep() {
    if (currentStep > 1) {
      document.getElementById(`step${currentStep}`).classList.add('d-none');
      document.getElementById(`step${currentStep}-circle`).classList.remove('active');
      currentStep--;
      updateStep();
    }
  }

  function updateStep() {
    for (let i = 1; i <= 3; i++) {
      document.getElementById(`step${i}`).classList.add('d-none');
      document.getElementById(`step${i}-circle`).classList.remove('active');
    }
    document.getElementById(`step${currentStep}`).classList.remove('d-none');
    document.getElementById(`step${currentStep}-circle`).classList.add('active');
  }
</script>

 

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Earnings (Monthly)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Annual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Requests</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Direct
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Social
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Referral
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

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
                    <form method="POST" action="{{ route('logout') }}">
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>