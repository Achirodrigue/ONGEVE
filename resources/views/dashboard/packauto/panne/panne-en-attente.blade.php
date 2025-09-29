@extends('dashboard.packauto.layout.app')
@section('body')


    @include('include.message.dashboard')
    @include('include.packauto.panne1')


    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center mb-3">
                    <div class="col-sm mb-2 mb-sm-0">
                        <h1 class="page-header-title">Nombre de panne en cours <span class="badge bg-soft-dark text-dark ms-2">{{ $ppannes->count() }}</span></h1>
                    </div>

                    <div class="col-auto col-sm-12 col-md-6 text-end">
                        <a class="btn btn-light m-1" href="#" data-bs-toggle="modal" data-bs-target="#addPanne">
                            <i class="bi-plus me-1"></i> Ajouter une panne
                        </a>
                        <a class="btn btn-light m-1" href="{{ route('packauto.panne.entretenu') }}">
                            <i class="bi-printer me-1"></i> Historique des entretiens
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
                                Les pannes en attente d'entretien
                                <span class="badge bg-soft-dark text-dark rounded-pill ms-1">{{ $ppannes->count() }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('packauto.panne.entretenu') }}" tabindex="-1" aria-disabled="true">
                                Les pannes entretenues
                                <!-- <span class="badge bg-soft-dark text-dark rounded-pill ms-1">{{ $ppannes->count() }}</span> -->
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
                @if($ppannes->count() > 0)
                    <!-- Header -->
                    <div class="card-header card-header-content-md-between">
                        <div class="mb-2 mb-md-0 w-100">
                            <form>
                                <!-- Search -->
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend input-group-text">
                                    <i class="bi-search"></i>
                                    </div>
                                    <input id="datatableSearch" type="search" class="form-control" placeholder="Rechercher une panne" aria-label="Rechercher une panne">
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
                                    <th>Constat</th>
                                    <th>Date de constat</th>
                                    <!-- <th>Coût</th> -->
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
                                @foreach($ppannes as $ppanne)
                                    <!-- @php $a=$n; @endphp -->
                                    <tr>
                                        <td class="fw-bold">{{ $n++ }}</td>
                                        <td class="fw-bold">{{ $ppanne->description }}</td>
                                        <td class="fw-bold">
                                            {{ $ppanne->date_panne ? formatDate($ppanne->date_panne) : 'Aucune' }}
                                        </td>
                                        <!-- <td class="fw-bold">{{ getpricefr($ppanne->cout) }}</td> -->
                                        <td class="text-center fw-bold">
                                            @if($ppanne->pchauffeur)
                                                <div class="btn-group" role="group">
                                                    <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#infoChauffeur{{ $ppanne->id }}">
                                                        <i class="bi-eye me-1"></i> Infos
                                                    </a>
                                                </div>
                                            @else
                                                <span class="badge bg-soft-dark text-dark">Responsable pack auto</span> 
                                            @endif
                                        </td>
                                        <td class="text-center fw-bold">
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#infoVehicule{{ $ppanne->id }}">
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
                                                    <button type="button" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="productsEditDrop{{ $ppanne->id }}down" data-bs-toggle="dropdown" aria-expanded="true"></button>

                                                    <div class="dropdown-menu dropdown-menu-top mt-1" aria-labelledby="productsEditDrop{{ $ppanne->id }}down">                
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editPanne{{ $ppanne->id }}">
                                                            <i class="bi-pencil-fill me-1 dropdown-item-icon"></i>Modifier
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#attesterEntretienPanne{{ $ppanne->id }}">
                                                            <i class="bi-printer dropdown-item-icon"></i>Attester l'entretien
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deletePanne{{ $ppanne->id }}">
                                                            <i class="bi-trash dropdown-item-icon"></i>Supprimer
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- End Button Group -->
                                            </div>
                                        </td>
                                        <!-- <td class="fw-bold">{{ $a }}</td> -->
                                    </tr>

                                    @include('include.packauto.panne2')
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
                        <h3 class="fw-bold mb-0 text-center">Désolé! Aucune panne signalé n'est en cours sur la plateforme</h3>
                    </div>
                    <!-- End Header -->
                @endif
            </div>
            <!-- End Card -->
        </div>
        <!-- End Content -->
    </main>





@endsection