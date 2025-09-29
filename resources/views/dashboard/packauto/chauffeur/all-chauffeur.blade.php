@extends('dashboard.packauto.layout.app')
@section('body')


    @include('include.message.dashboard')

    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center mb-3">
                    <div class="col-sm mb-2 mb-sm-0">
                        <h1 class="page-header-title">Nombre de chauffeur disponible sur la plateforme <span class="badge bg-soft-dark text-dark ms-2">{{ $pchauffeurs->count() }}</span></h1>
                    </div>

                    <div class="col-auto">
                        <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#addChauffeur">
                            <i class="bi-plus me-1"></i> Chauffeur
                        </a>
                    </div>
                </div>
                <!-- End Row -->

                <!-- Nav Scroller -->
                <div class="js-nav-scroller hs-nav-scroller-horizontal">
                    <span class="hs-nav-scroller-arrow-prev" style="display: none;">
                        <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                        <i class="bi-chevron-left"></i>
                        </a>
                    </span>

                    <span class="hs-nav-scroller-arrow-next" style="display: none;">
                        <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                        <i class="bi-chevron-right"></i>
                        </a>
                    </span>

                    <!-- Nav -->
                    <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                Tout les chauffeurs
                                <span class="badge bg-soft-dark text-dark rounded-pill ms-1"></span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('packauto.pchauffeur.index') }}" tabindex="-1" aria-disabled="true">
                                Véhicules empruntés
                                <span class="badge bg-soft-dark text-dark rounded-pill ms-1"></span>
                            </a>
                        </li> -->
                    </ul>
                    <!-- End Nav -->
                </div>
                <!-- End Nav Scroller -->
            </div>
            <!-- End Page Header -->

            <!-- Card -->
            <div class="card card-table">
                @if($pchauffeurs->count() > 0)
                    <!-- Header -->
                    <div class="card-header card-header-content-md-between">
                        <div class="mb-2 mb-md-0 w-100">
                            <form>
                                <!-- Search -->
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend input-group-text">
                                    <i class="bi-search"></i>
                                    </div>
                                    <input id="datatableSearch" type="search" class="form-control" placeholder="Rechercher un chauffeur" aria-label="Rechercher un chauffeur">
                                </div>
                                <!-- End Search -->
                            </form>
                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table id="datatable" class="table table-bordered table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table" style="width: 100%" data-hs-datatables-options='{
                            "columnDefs": [{
                                "targets": [0],
                                "orderable": false
                                }],
                            "order": [],
                            "info": {
                                "totalQty": "#datatableWithPaginationInfoTotalQty"
                            },
                            "search": "#datatableSearch",
                            "entries": "#datatableEntries",
                            "pageLength": 12,
                            "isResponsive": false,
                            "isShowPaging": false,
                            "pagination": "datatablePagination"
                            }'>
                            <thead class="thead-light">
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Numéro de permis</th>
                                    <th>Date d'expiration permis</th>
                                    <th>Document</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $n=1; @endphp
                                @foreach($pchauffeurs as $pchauffeur)
                                    @php $a=$n; @endphp
                                    <tr>
                                        <td class="fw-bold">{{ $n++ }}</td>
                                        <td class="fw-bold">{{ $pchauffeur->nom }}</td>
                                        <td class="fw-bold">{{ $pchauffeur->prenom }}</td>
                                        <td class="fw-bold">{{ $pchauffeur->contact ?? 'Null'}}</td>
                                        <td class="fw-bold">{{ $pchauffeur->email ?? 'Null'}}</td>
                                        <td class="fw-bold">{{ $pchauffeur->permis_numero ?? 'Null'}}</td>
                                        <td class="fw-bold">
                                            {{ $pchauffeur->permis_validite ? \Carbon\Carbon::parse($pchauffeur->date_achat)->format('d/m/Y') : 'Null' }}
                                        </td>
                                        <td class="text-center fw-bold">
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-white btn-sm" href="{{ route('packauto.pchauffeur.show', $pchauffeur) }}">
                                                    <i class="bi-eye me-1"></i> {{ $pchauffeur->pchauffeurdocs->count() }}
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-white btn-sm" href="#">
                                                    <!-- <i class="bi-pencil-fill me-1"></i> -->Action
                                                </a>

                                                <!-- Button Group -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="productsEditDrop{{ $pchauffeur->id }}down" data-bs-toggle="dropdown" aria-expanded="true"></button>

                                                    <div class="dropdown-menu dropdown-menu-top mt-1" aria-labelledby="productsEditDrop{{ $pchauffeur->id }}down">                
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editChauffeur{{ $pchauffeur->id }}">
                                                            <i class="bi-pencil-fill me-1 dropdown-item-icon"></i>Modifier
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteChauffeur{{ $pchauffeur->id }}">
                                                            <i class="bi-trash dropdown-item-icon"></i>Supprimer
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- End Button Group -->
                                            </div>
                                        </td>
                                    </tr>

                                    @include('include.packauto.chauffeur')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- End Table -->

                    <!-- Footer -->
                    <div class="card-footer">
                        <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                            <div class="col-sm mb-2 mb-sm-0">
                                <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                                    <span class="me-2">Pagination:</span>

                                    <!-- Select -->
                                    <div class="tom-select-custom">
                                        <select id="datatableEntries" class="js-select form-select form-select-borderless w-auto" autocomplete="off" data-hs-tom-select-options='{
                                                    "searchInDropdown": false,
                                                    "hideSearch": true
                                                }'>
                                            <option value="12">12</option>
                                            <option value="14" selected>14</option>
                                            <option value="16">16</option>
                                            <option value="18">18</option>
                                        </select>
                                    </div>
                                    <!-- End Select -->

                                    <span class="text-secondary me-2">of</span>

                                    <!-- Pagination Quantity -->
                                    <span id="datatableWithPaginationInfoTotalQty"></span>
                                </div>
                            </div>
                            <!-- End Col -->

                            <div class="col-sm-auto">
                                <div class="d-flex justify-content-center justify-content-sm-end">
                                    <!-- Pagination -->
                                    <nav id="datatablePagination" aria-label="Activity pagination"></nav>
                                </div>
                            </div>
                            <!-- End Col -->
                        </div>
                    </div>
                    <!-- End Footer -->
                @else
                    <!-- Header -->
                    <div class="card-header card-header-content-md-between p-4">
                        <h3 class="fw-bold mb-0 text-center">Désolé! Aucun véhicule disponible sur la plateforme</h3>
                    </div>
                    <!-- End Header -->
                @endif
            </div>
            <!-- End Card -->
        </div>
        <!-- End Content -->
    </main>

  <div class="modal fade" id="addChauffeur" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header mb-0">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Ajouter un chauffeur</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="post" action="{{ route('packauto.pchauffeur.store') }}" enctype="multipart/form-data">
        @csrf
          <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Nom *</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="nom" class="visually-hidden form-label">Nom *</label>
                        <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" id="nom" placeholder="Entrer un nom" aria-label="Entrer un nom" required>
                        @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Prénom *</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="prenom" class="visually-hidden form-label">Prénom *</label>
                        <input type="text" name="prenom" value="{{ old('prenom') }}" class="form-control" id="prenom" placeholder="Entrer un prénom" aria-label="Entrer un prénom" required>
                        @error('prenom') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Contact *</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="contact" class="visually-hidden form-label">Contact *</label>
                        <input type="number" name="contact" value="{{ old('contact') }}" class="form-control" id="contact" placeholder="Entrer un contact" aria-label="Entrer un contact" required>
                        @error('contact') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Email *</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="email" class="visually-hidden form-label">Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Entrer un email" aria-label="Entrer un email" required>
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Numéro de permis *</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="permis_numero" class="visually-hidden form-label">Numéro de permis *</label>
                        <input type="text" name="permis_numero" value="{{ old('permis_numero') }}" class="form-control" id="permis_numero" placeholder="Entrer un numéro de permis" aria-label="Entrer un numéro de permis">
                        @error('permis_numero') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Date d'expiration du permis </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="permis_validite" class="visually-hidden form-label">Date d'expiration du permis </label>
                        <input type="date" name="permis_validite" value="{{ old('permis_validite') }}" class="form-control" id="permis_validite" placeholder="Entrer un permis de validité" aria-label="Entrer un permis de validité">
                        @error('permis_validite') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- <div class="row mb-4">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <div class="d-flex align-items-center mt-2">
                        <i class="bi-people nav-icon"></i>
                        <div class="flex-grow-1">Photo</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="photo" class="visually-hidden form-label">Photo</label>
                        <input type="file" name="photo" value="{{ old('photo') }}" class="form-control" id="photo" placeholder="Entrer une photo" aria-label="Entrer une photo">
                        @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div> -->
          </div>

          <!-- Footer -->
          <div class="modal-footer gap-3">
            <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
            <button type="submit" id="processEvent" class="btn btn-primary">Ajouter</button>
          </div>
          <!-- End Footer -->
          </form>
      </div>
    </div>
  </div>



@endsection