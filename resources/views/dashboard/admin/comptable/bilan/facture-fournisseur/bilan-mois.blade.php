@extends('dashboard.admin.layout.app')
@section('body')


  @include('include.message.dashboard')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Bilans par mois des factures fournisseur sur la plateforme <span class="badge bg-soft-dark text-dark ms-2">{{ $fournisseurfacturecomptables->count() }}</span></h1>
          </div>
          <!-- End Col -->
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
              <a class="nav-link" href="{{ route('admin.bilan.semaine.facture.fournisseur') }}" tabindex="-1" aria-disabled="true">Bilans mensuels</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Bilans par mois</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.bilan.trimestre.facture.fournisseur') }}" tabindex="-1" aria-disabled="true">Bilans trimestriels</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.bilan.annee.facture.fournisseur') }}" tabindex="-1" aria-disabled="true">Bilans annuels</a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
      </div>
      <!-- End Page Header -->

      <!-- Card -->
      @if($fournisseurfacturecomptables->count() > 0)
        @php $n = 1; @endphp
        @foreach ($fournisseurfacturecomptables as $semaine => $factures)
          <div class="card card-table mb-5">
              <!-- Header -->
              <div class="card-header card-header-content-md-between">
                <h4 class="card-header-title">{{ $semaine }}</h4>
              </div>
              <!-- End Header -->

              @if($factures->count() > 0)
                <div class="card-header card-header-content-md-between">
                  <div class="mb-2 mb-md-0 w-100">
                    <form>
                      <!-- Search -->
                      <div class="input-group input-group-merge input-group-flush">
                        <div class="input-group-prepend input-group-text">
                          <i class="bi-search"></i>
                        </div>
                        <input id="datatable{{$n}}Search" type="search" class="form-control" placeholder="Rechercher une facture" aria-label="Search users">
                      </div>
                      <!-- End Search -->
                    </form>
                  </div>
                </div>

                <!-- Table -->
                <div class="table-responsive datatable-custom">
                  <table id="datatable" class="table table-bordered table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table" style="width: 100%" data-hs-datatables-options='{
                      "columnDefs": [{
                          "targets": [0],
                          "orderable": false
                        }],
                      "order": [],
                      "info": {
                        "totalQty": "#datatable{{$n}}WithPaginationInfoTotalQty"
                      },
                      "search": "#datatable{{$n}}Search",
                      "entries": "#datatable{{$n}}Entries",
                      "pageLength": 12,
                      "isResponsive": false,
                      "isShowPaging": false,
                      "pagination": "datatable{{$n}}Pagination"
                    }'>
                    <thead class="thead-light">
                      <tr>
                        <th>Etat</th>
                        <th>N° facture</th>
                        <th>Fournisseur</th>
                        <th>Date</th>
                        <th>Délai règlement</th>
                        <th>Désignation</th>
                        <th>Echéance</th>
                        <th>Total à payer</th>
                        <th>Déjà payer</th>
                        <th>Facture et Bon</th>
                        <th>Transaction</th>
                      </tr>
                    </thead>

                    <tbody>
                      @forelse($factures as $fournisseurfacturecomptable)
                        <tr>
                          <td class="text-center">
                            <div class="btn-group" role="group">
                              <a class="btn btn-sm
                                  @if($fournisseurfacturecomptable->statut == null || $fournisseurfacturecomptable->statut == 2) btn-danger @else btn-success @endif
                                ">
                                @if($fournisseurfacturecomptable->statut == null) Impayé @elseif($fournisseurfacturecomptable->statut == 2) Partielle @else Finalisé @endif
                              </a>
                            </div>
                          </td>
                          <td class="fw-bold">{{ $fournisseurfacturecomptable->numero_facture }}</td>
                          <td class="fw-bold">{{ $fournisseurfacturecomptable->fournisseur->nom }}</td>
                          <td class="fw-bold">{{ $fournisseurfacturecomptable->created_at->format('d/m/Y H:i') }}</td>
                          <td class="fw-bold">{{ $fournisseurfacturecomptable->delai_reglement }}</td>
                          <td class="fw-bold">{{ $fournisseurfacturecomptable->designation }}</td>
                          <td class="fw-bold">{{ $fournisseurfacturecomptable->echeance }}</td>
                          <td class="fw-bold">{{ getprice($fournisseurfacturecomptable->total_payer) }}F</td>
                          <td class="fw-bold">{{ getprice($fournisseurfacturecomptable->versement) }}F</td>
                          <td class="text-center">
                            <div class="btn-group" role="group">
                              @if(!$fournisseurfacturecomptable->facture && !$fournisseurfacturecomptable->bon)
                                <h4 class="fw-bold">Aucun fichier</h4>
                              @else
                                @if($fournisseurfacturecomptable->facture)
                                  <a class="btn btn-white btn-sm" target="_blank" href="{{ asset(Storage::url($fournisseurfacturecomptable->facture)) }}">
                                    <i class="bi-eye me-1"></i> Facture
                                  </a>
                                @endif
                                @if($fournisseurfacturecomptable->bon)
                                  <a class="btn btn-white btn-sm" target="_blank" href="{{ asset(Storage::url($fournisseurfacturecomptable->bon)) }}">
                                    <i class="bi-eye me-1"></i> Bon
                                  </a>
                                @endif
                              @endif
                            </div>
                          </td>
                          <td>
                            <div class="btn-group" role="group">
                              <a class="btn btn-white btn-sm" @if($fournisseurfacturecomptable->fournisseurfcts->count() > 0) href="{{ route('admin.fournisseur.facture.transaction', $fournisseurfacturecomptable) }}" @else href="#" @endif>
                                <i class="bi-eye me-1"></i> {{ $fournisseurfacturecomptable->fournisseurfcts->count() }}
                              </a>
                            </div>
                          </td>
                        </tr>
                      @empty
                          <tr><td colspan="3">Aucune facture</td></tr>
                      @endforelse
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
                          <select id="datatable{{$n}}Entries" class="js-select form-select form-select-borderless w-auto" autocomplete="off" data-hs-tom-select-options='{
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
                        <span id="datatable{{$n}}WithPaginationInfoTotalQty"></span>
                      </div>
                    </div>
                    <!-- End Col -->

                    <div class="col-sm-auto">
                      <div class="d-flex justify-content-center justify-content-sm-end">
                        <!-- Pagination -->
                        <nav id="datatable{{$n}}Pagination" aria-label="Activity pagination"></nav>
                      </div>
                    </div>
                    <!-- End Col -->
                  </div>
                  <!-- End Row -->
                </div>
                <!-- End Footer -->

              @else
                  <!-- Header -->
                  <div class="card-header card-header-content-md-between p-4">
                    <h5 class="fw-bold mb-0 text-center">Désolé! Aucune facture disponible pour cette semaine sur la plateforme</h5>
                  </div>
                  <!-- End Header -->
              @endif   
          </div>
          @php $n++; @endphp
        @endforeach
      @else
          <!-- Header -->
          <div class="card-header card-header-content-md-between p-4">
            <h3 class="fw-bold mb-0 text-center">Désolé! Aucune facture disponible sur la plateforme</h3>
          </div>
          <!-- End Header -->
      @endif
      <!-- End Card -->
    </div>
    <!-- End Content -->
     
  </main>



@endsection