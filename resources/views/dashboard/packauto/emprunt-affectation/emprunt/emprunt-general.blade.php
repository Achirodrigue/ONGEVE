@extends('dashboard.packauto.layout.app')
@section('body')


    @include('include.message.dashboard')
    @include('include.packauto.affectation1')

    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center mb-3">
                    <div class="col-sm mb-2 mb-sm-0">
                        <h1 class="page-header-title">Nombre d'emprunt de véhicules en cours <span class="badge bg-soft-dark text-dark ms-2">{{ $paffectations->count() }}</span></h1>
                    </div>

                    <div class="col-auto col-sm-12 col-md-6 text-end">
                        <a class="btn btn-light m-1" href="#" data-bs-toggle="modal" data-bs-target="#addAffectation">
                            <i class="bi-plus me-1"></i> Ajouter un emprunt
                        </a>
                        <a class="btn btn-light m-1" href="{{ route('packauto.emprunt.encours') }}">
                            <i class="bi-arrow-return-left me-1"></i> Retour
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
                            <a class="nav-link" href="{{ route('packauto.emprunt.en.attente') }}" tabindex="-1" aria-disabled="true">
                                Les emprunts en attente de validation
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('packauto.emprunt.encours') }}" tabindex="-1" aria-disabled="true">
                                Les emprunts en cours
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                Tout les emprunts
                                <span class="badge bg-soft-dark text-dark rounded-pill ms-1">{{ $paffectations->count() }}</span>
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
                @if($paffectations->count() > 0)
                    <!-- Header -->
                    <div class="card-header card-header-content-md-between">
                        <div class="mb-2 mb-md-0 w-100">
                            <form>
                                <!-- Search -->
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend input-group-text">
                                    <i class="bi-search"></i>
                                    </div>
                                    <input id="datatableSearch" type="search" class="form-control" placeholder="Rechercher un emprunt" aria-label="Rechercher un emprunt">
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
                                    <th>Date de debut</th>
                                    <th>Date de fin</th>
                                    <th>Mission</th>
                                    <th>Chauffeur</th>
                                    <th>Vehicule</th>
                                    <th>Action</th>
                                    <!-- <th>N°</th> -->
                                    <!-- $table->boolean('etat')->default(1);
                                    $table->boolean('type')->default(0);
                                    $table->boolean('statut')->default(0); -->
                                </tr>
                            </thead>
                            <tbody>
                                @php $n=1; @endphp
                                @foreach($paffectations as $paffectation)
                                    <!-- @php $a=$n; @endphp -->
                                    <tr>
                                        <td class="fw-bold">{{ $n++ }}</td>
                                        <td class="fw-bold">
                                            {{ $paffectation->date_debut ? \Carbon\Carbon::parse($paffectation->date_debut)->format('d/m/Y') : 'Aucune' }}
                                        </td>
                                        <td class="fw-bold">
                                            {{ $paffectation->date_fin ? \Carbon\Carbon::parse($paffectation->date_fin)->format('d/m/Y') : 'Aucune' }}
                                        </td>
                                        <td class="fw-bold">{{ $paffectation->mission }}</td>
                                        <td class="text-center fw-bold">
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#infoChauffeur{{ $paffectation->id }}">
                                                    <i class="bi-eye me-1"></i> Infos
                                                </a>
                                            </div>
                                        </td>
                                        <td class="text-center fw-bold">
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#infoVehicule{{ $paffectation->id }}">
                                                    <i class="bi-eye me-1"></i> Infos
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
                                                    <button type="button" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="productsEditDrop{{ $paffectation->id }}down" data-bs-toggle="dropdown" aria-expanded="true"></button>

                                                    <div class="dropdown-menu dropdown-menu-top mt-1" aria-labelledby="productsEditDrop{{ $paffectation->id }}down">                
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editAffectation{{ $paffectation->id }}">
                                                            <i class="bi-pencil-fill me-1 dropdown-item-icon"></i>Modifier
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteAffectation{{ $paffectation->id }}">
                                                            <i class="bi-printer dropdown-item-icon"></i>Finaliser l'emprunt
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteAffectation{{ $paffectation->id }}">
                                                            <i class="bi-trash dropdown-item-icon"></i>Supprimer
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- End Button Group -->
                                            </div>
                                        </td>
                                        <!-- <td class="fw-bold">{{ $a }}</td> -->
                                    </tr>

                                    @include('include.packauto.affectation2')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- End Table -->

                    <!-- Footer -->
                        @include('dashboard.IncludePage.commun.pagination.pagination')
                    <!-- End Footer -->
                @else
                    <!-- Header -->
                    <div class="card-header card-header-content-md-between p-4">
                        <h3 class="fw-bold mb-0 text-center">Désolé! Aucun véhicule n'a été emprunté et retourné sur la plateforme</h3>
                    </div>
                    <!-- End Header -->
                @endif
            </div>
            <!-- End Card -->
        </div>
        <!-- End Content -->
    </main>





@endsection