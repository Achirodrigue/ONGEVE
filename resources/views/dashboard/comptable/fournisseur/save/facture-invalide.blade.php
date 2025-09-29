@extends('dashboard.comptable.layout.app')
@section('body')


  @include('include.message.dashboard')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Les différentes factures fournisseurs en cours de traitement <span class="badge bg-soft-dark text-dark ms-2">{{ $fournisseurfactures->count() }}</span></h1>
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

          <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" href="#">Factures en cours de traitement</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('comptable.fournisseur.facture.valide') }}" tabindex="-1" aria-disabled="true">Factures approuvées</a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
      </div>
      <!-- End Page Header -->

      <!-- Card -->
      <div class="card card-table">
          @if($fournisseurfactures->count() > 0)
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
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatablePagination"
                 }'>
                <thead class="thead-light">
                  <tr>
                    <th>Numéro facture</th>
                    <th>Total à payer (Fcfa)</th>
                    <th>Produits</th>
                    <th>Fournisseur</th>
                    <th>Facture</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($fournisseurfactures as $fournisseurfacture)
                    <tr>
                      <td class="fw-bold">{{ $fournisseurfacture->numero_facture }}</td>
                      <td class="fw-bold">{{ getprice($fournisseurfacture->total_ttc) }}</td>
                      <td class="text-center">
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="{{ route('comptable.fournisseur.facture.detail', $fournisseurfacture) }}">
                            <i class="bi-eye me-1"></i> {{ $fournisseurfacture->fournisseurfactureprods()->count() }}
                          </a>
                        </div>
                      </td>
                      <td class="fw-bold">{{ $fournisseurfacture->fournisseur->nom }}</td>
                      <td class="text-center">
                        <div class="btn-group" role="group">
                          @if($fournisseurfacture->ffacture)
                            <a class="btn btn-white btn-sm" target="_blank" href="{{ asset(Storage::url($fournisseurfacture->ffacture)) }}">
                              <i class="bi-eye me-1"></i> Voir
                            </a>
                          @else
                            <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#addfacturefournisseur{{ $fournisseurfacture->id }}">
                              <i class="bi-printer me-1"></i> Associer
                            </a>
                          @endif
                        </div>
                      </td>
                      <td class="text-center">
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="{{ route('comptable.fournisseur.facture.etat.update', $fournisseurfacture) }}">
                            <i class="bi-check2-all me-1"></i> Approuver
                          </a>
                        </div>
                      </td>
                    </tr>
                    
                    @include('include.comptable.facture-fournisseur')
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
                    <span class="me-2">Showing:</span>

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
              <!-- End Row -->
            </div>
            <!-- End Footer -->
          @else
              <!-- Header -->
              <div class="card-header card-header-content-md-between p-4">
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucune factures fournisseur n'est en cours de traitement sur la plateforme</h3>
              </div>
              <!-- End Header -->
          @endif
      </div>
      <!-- End Card -->
    </div>
    <!-- End Content -->

  </main>
  <!-- ========== END MAIN CONTENT ========== -->


@endsection