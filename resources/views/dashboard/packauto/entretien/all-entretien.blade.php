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
                        <h1 class="page-header-title">Nombre d'entretien de panne sur véhicule <span class="badge bg-soft-dark text-dark ms-2">{{ $pentretiens->count() }}</span></h1>
                    </div>

                    <div class="col-auto col-sm-12 col-md-6 text-end">
                        <a class="btn btn-light m-1" href="{{ route('packauto.panne.entretenu') }}">
                            <i class="bi-printer me-1"></i> Retour
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
                                Liste des entretiens
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
                @if($pentretiens->count() > 0)
                    <!-- Header -->
                    <div class="card-header card-header-content-md-between">
                        <div class="mb-2 mb-md-0 w-100">
                            <form>
                                <!-- Search -->
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend input-group-text">
                                    <i class="bi-search"></i>
                                    </div>
                                    <input id="datatableSearch" type="search" class="form-control" placeholder="Rechercher un entretien" aria-label="Rechercher un entretien">
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
                                    <th>Observations</th>
                                    <th>Date d'entretien</th>
                                    <th>Coût</th>
                                    <th>Garage</th>
                                    <th>Chauffeur</th>
                                    <th>Vehicule</th>
                                    <th>Panne</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $n=1; @endphp
                                @foreach($pentretiens as $pentretien)
                                    @php $ppanne=$pentretien->ppanne; @endphp
                                    <tr>
                                        <td class="fw-bold">{{ $n++ }}</td>
                                        <td class="fw-bold">{{ $pentretien->description ?? 'Aucune' }}</td>
                                        <td class="fw-bold">{{ $pentretien->date_entretien ? formatDate($pentretien->date_entretien) : 'Aucune' }}</td>
                                        <td class="fw-bold">{{ getpricefr($pentretien->cout) }}</td>
                                        <td class="fw-bold">{{ $pentretien->garage ?? 'Aucun' }}</td>
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
                                        <td class="text-center fw-bold">
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#infoPanne{{ $ppanne->id }}">
                                                    <i class="bi-eye me-1"></i> Infos
                                                </a>
                                            </div>
                                        </td>
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
                        <h3 class="fw-bold mb-0 text-center">Désolé! Aucune panne dont l'entretien à été effectué sur la plateforme</h3>
                    </div>
                    <!-- End Header -->
                @endif
            </div>
            <!-- End Card -->
        </div>
        <!-- End Content -->
    </main>





@endsection