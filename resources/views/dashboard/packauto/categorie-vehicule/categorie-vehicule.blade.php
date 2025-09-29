@extends('dashboard.packauto.layout.app')
@section('body')


    @include('include.message.dashboard')
    @include('include.packauto.vehicule1')

    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center mb-3">
                    <div class="col-sm-12 col-md-6 mb-2 mb-sm-0">
                        <h1 class="page-header-title">Nombre de véhicules de la catégorie <span class="text-danger">{{ $pcategorievehicule->nom }}</span> <span class="badge bg-soft-dark text-dark ms-2">{{ $pcategorievehicule->pvehicules->count() }}</span></h1>
                    </div>

                    @include('dashboard.IncludePage.packauto.vehicule.header1')

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
                                Tout les véhicules
                                <span class="badge bg-soft-dark text-dark rounded-pill ms-1">{{ vehicules()->count() }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('packauto.vehicule.disponible') }}" tabindex="-1" aria-disabled="true">
                                Véhicules disponibles
                                <span class="badge bg-soft-dark text-dark rounded-pill ms-1">{{ vehiculeDisponibles()->count() }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('packauto.vehicule.emprunte') }}" tabindex="-1" aria-disabled="true">
                                Véhicules empruntés
                                <span class="badge bg-soft-dark text-dark rounded-pill ms-1">{{ vehiculeEmpruntes()->count() }}</span>
                            </a>
                        </li>
                    </ul>
                    <!-- End Nav -->
                </div>
                <!-- End Nav Scroller -->
            </div>
            <!-- End Page Header -->

            <!-- Card -->
            <div class="card card-table">
                @if($pcategorievehicule->pvehicules->count() > 0)
                    <!-- Header -->
                    <div class="card-header card-header-content-md-between">
                        <div class="mb-2 mb-md-0 w-100">
                            <form>
                                <!-- Search -->
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend input-group-text">
                                    <i class="bi-search"></i>
                                    </div>
                                    <input id="datatableSearch" type="search" class="form-control" placeholder="Search users" aria-label="Search users">
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
                                    <th>Marque</th>
                                    <th>Modèle</th>
                                    <th>Immatriculation</th>
                                    <th>Année de circulation</th>
                                    <th>Kilometrage</th>
                                    <th>Date d'achat</th>
                                    <th>Photo</th>
                                    <th>Catégorie</th>
                                    <th>Action</th>
                                    <th>N°</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $n=1; @endphp
                                @foreach($pcategorievehicule->pvehicules as $pvehicule)
                                    @php $a=$n; @endphp
                                    <tr>
                                        <td class="fw-bold">{{ $n++ }}</td>
                                        <td class="fw-bold">{{ $pvehicule->marque }}</td>
                                        <td class="fw-bold">{{ $pvehicule->modele }}</td>
                                        <td class="fw-bold">{{ $pvehicule->immatriculation }}</td>
                                        <td class="fw-bold">{{ $pvehicule->annee ?? 'Null'}}</td>
                                        <td class="fw-bold">{{ $pvehicule->kilometrage ?? 'Null'}}</td>
                                        <td class="fw-bold">
                                            {{ $pvehicule->date_achat ? \Carbon\Carbon::parse($pvehicule->date_achat)->format('d/m/Y H:i') : 'Null' }}
                                        </td>
                                        <td class="text-center fw-bold">
                                            @if($pvehicule->photo)
                                                <div class="btn-group" role="group">
                                                    <a class="btn btn-white btn-sm" target="_blank" href="{{ asset(Storage::url($pvehicule->photo)) }}">
                                                        <i class="bi-eye me-1"></i> Voir
                                                    </a>
                                                </div>
                                            @else
                                                Aucune
                                            @endif
                                        </td>
                                        <td class="fw-bold">{{ $pvehicule->pcategorievehicule->nom }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-white btn-sm" href="#">
                                                    <!-- <i class="bi-pencil-fill me-1"></i> -->Action
                                                </a>

                                                <!-- Button Group -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="productsEditDrop{{ $pvehicule->id }}down" data-bs-toggle="dropdown" aria-expanded="true"></button>

                                                    <div class="dropdown-menu dropdown-menu-top mt-1" aria-labelledby="productsEditDrop{{ $pvehicule->id }}down">                
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editVehicule{{ $pvehicule->id }}">
                                                            <i class="bi-pencil-fill me-1 dropdown-item-icon"></i>Modifier
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteVehicule{{ $pvehicule->id }}">
                                                            <i class="bi-trash dropdown-item-icon"></i>Supprimer
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- End Button Group -->
                                            </div>
                                        </td>
                                        <td class="fw-bold">{{ $a }}</td>
                                    </tr>

                                    @include('include.packauto.vehicule2')
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
                        <h3 class="fw-bold mb-0 text-center">Désolé! Aucun véhicule n'a été ajouté sur la plateforme</h3>
                    </div>
                    <!-- End Header -->
                @endif
            </div>
            <!-- End Card -->
        </div>
        <!-- End Content -->
    </main>





@endsection