@extends('dashboard.packauto.layout.app')
@section('body')


    @include('include.message.dashboard')
    @include('include.packauto.chauffeur')


    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center mb-3">
                    <div class="col-sm mb-2 mb-sm-0">
                        <h1 class="page-header-title">Listes des documents de l'employés <span class="text-danger">{{ $pchauffeur->nom }} {{ $pchauffeur->prenom }}</span> <span class="badge bg-soft-dark text-dark ms-2">{{ $pchauffeur->pchauffeurdocs->count() }}</span></h1>
                    </div>

                    <div class="col-auto">
                        @if(chauffeurdocnames()->count() > 0)
                            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#addChauffeurDocument{{ $pchauffeur->id }}">
                                <i class="bi-plus me-1"></i> Document
                            </a>
                        @endif
                        <a class="btn btn-primary" href="{{ route('packauto.pchauffeur.index') }}">
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
                            <a class="nav-link" href="{{ route('packauto.pchauffeur.index') }}" tabindex="-1" aria-disabled="true">
                                Tout les chauffeurs
                                <span class="badge bg-soft-dark text-dark rounded-pill ms-1">{{ chauffeurs()->count() }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                Documents chauffeur
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
                @if($pchauffeur->pchauffeurdocs->count() > 0)
                    <!-- Header -->
                    <div class="card-header card-header-content-md-between">
                        <div class="mb-2 mb-md-0 w-100">
                            <form>
                                <!-- Search -->
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend input-group-text">
                                    <i class="bi-search"></i>
                                    </div>
                                    <input id="datatableSearch" type="search" class="form-control" placeholder="Rechercher un document" aria-label="Rechercher un document">
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
                                    <th>Type de document</th>
                                    <th>Date d'expiration</th>
                                    <th class="text-center">Fichier</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $n=1; @endphp
                                @foreach($pchauffeur->pchauffeurdocs as $pchauffeurdoc)
                                    <tr>
                                        <td class="fw-bold">{{ $n++ }}</td>
                                        <td class="fw-bold">{{ $pchauffeurdoc->pchauffeurdocname->nom }}</td>
                                        <td class="fw-bold">
                                            {{ $pchauffeurdoc->date_expiration ? \Carbon\Carbon::parse($pchauffeurdoc->date_expiration)->format('d/m/Y') : 'Null' }}
                                        </td>
                                        <td class="text-center fw-bold">
                                            @if($pchauffeurdoc->fichier)
                                                <div class="btn-group" role="group">
                                                    <a class="btn btn-white btn-sm" target="_blank" href="{{ asset(Storage::url($pchauffeurdoc->fichier)) }}">
                                                        <i class="bi-eye me-1"></i> Voir
                                                    </a>
                                                </div>
                                            @else
                                                Aucun
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-white btn-sm" href="#">
                                                    <!-- <i class="bi-pencil-fill me-1"></i> -->Action
                                                </a>

                                                <!-- Button Group -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="productsEditDrop{{ $pchauffeurdoc->id }}down" data-bs-toggle="dropdown" aria-expanded="true"></button>

                                                    <div class="dropdown-menu dropdown-menu-top mt-1" aria-labelledby="productsEditDrop{{ $pchauffeurdoc->id }}down">                
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editChauffeurDocument{{ $pchauffeurdoc->id }}">
                                                            <i class="bi-pencil-fill me-1 dropdown-item-icon"></i>Modifier
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteChauffeurDocument{{ $pchauffeurdoc->id }}">
                                                            <i class="bi-trash dropdown-item-icon"></i>Supprimer
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- End Button Group -->
                                            </div>
                                        </td>
                                    </tr>

                                    @include('include.packauto.chauffeur-doc')
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
                        <h3 class="fw-bold mb-0 text-center">Désolé! Aucun document n'a été ajouté pour ce chauffeur</h3>
                    </div>
                    <!-- End Header -->
                @endif
            </div>
            <!-- End Card -->
        </div>
        <!-- End Content -->
    </main>




@endsection