@extends('dashboard.ressource.ange.layout.app')
@section('body')

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
                    <h1 class="h3 mb-0 text-gray-800">Liste des Employer</h1>
                    <button onclick="openModal()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Ajouter un Employé
                    </button>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
     <h1>Paiement des employés - Mois : {{ $mois }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
    <thead>
        <tr>
            <th>Nom complet</th>
            <th>Salaire de base</th>
            <th>Statut Paiement</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employes as $employe)
            @php
                $paie = $paies->get($employe->id);
            @endphp
            <tr>
                <td>{{ $employe->nom }} {{ $employe->prenoms }}</td>
                <td>{{ number_format($employe->salaire_de_base, 2, ',', ' ') }} {{ $employe->devise }}</td>
                <td>
                    @if($paie && $paie->statut === 'Payé')
                        <span class="badge bg-success">Payé</span>
                    @else
                        <span class="badge bg-warning text-dark">En attente</span>
                    @endif
                </td>
                <td>
                    @if(!$paie || $paie->statut !== 'Payé')
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalPaie{{ $employe->id }}">
                            Payer
                        </button>
                    @else
                        <button class="btn btn-secondary btn-sm" disabled>Payé</button>
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalPaie{{ $employe->id }}">
                            ⚙ Détails
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
   </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
@foreach($employes as $employe)
    <!-- Modal pour cet employé -->
    <div class="modal fade" id="modalPaie{{ $employe->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $employe->id }}" aria-hidden="true">
      <div class="modal-dialog">
        <form method="POST" action="{{ route('paiement.payer', $employe) }}">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{ $employe->id }}">
                    Paiement de {{ $employe->nom }} {{ $employe->prenoms }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
              </div>
              <div class="modal-body">
                <div class="mb-2">
                  <label>Primes</label>
                  <input type="number" step="0.01" name="primes" class="form-control" value="0">
                </div>
                <div class="mb-2">
                  <label>Heures supp.</label>
                  <input type="number" name="heures_supplementaires" class="form-control" value="0">
                </div>
                <div class="mb-2">
                  <label>Montant heures supp.</label>
                  <input type="number" step="0.01" name="montant_heures_supplementaires" class="form-control" value="0">
                </div>
                <div class="mb-2">
                  <label>Indemnités</label>
                  <input type="number" step="0.01" name="indemnites" class="form-control" value="0">
                </div>
                <div class="mb-2">
                  <label>CNPS</label>
                  <input type="number" step="0.01" name="cnps" class="form-control" value="0">
                </div>
                <div class="mb-2">
                  <label>Impôt</label>
                  <input type="number" step="0.01" name="impot" class="form-control" value="0">
                </div>
                <div class="mb-2">
                  <label>Avance sur salaire</label>
                  <input type="number" step="0.01" name="avance_salaire" class="form-control" value="0">
                </div>
                <div class="mb-2">
                  <label>Autres retenues</label>
                  <input type="number" step="0.01" name="autres_retenues" class="form-control" value="0">
                </div>
                <div class="mb-2">
                  <label>Mode de paiement</label>
                  <select name="mode_paiement" class="form-control">
                      <option value="Espèce">Espèce</option>
                      <option value="Virement bancaire">Virement bancaire</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-success">Valider et payer</button>
              </div>
            </div>
        </form>
      </div>
    </div>
@endforeach

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
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
 
    

@endsection