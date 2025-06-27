@extends('dashboard.commercial.layout.app')
@section('body')


  @include('include.message.dashboard')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Commandesommandes entreprise refusées <span class="badge bg-soft-dark text-dark ms-2">{{ $particulierdevis->count() }}</span></h1>

          </div>
          <!-- End Col -->

          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('commercial.commande.client.refuse') }}">
              <i class="bi-arrow-return-left me-1"></i> Commandes client refusées
            </a>
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
              <a class="nav-link" href="{{ route('commercial.commande.client.refuse') }}" tabindex="-1" aria-disabled="true">Commande client refusées</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Commandes entreprise refusées</a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
      </div>
      <!-- End Page Header -->

      <!-- Card -->
      <div class="card">
          @if($particulierdevis->count() > 0)
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
                    <th>Nom et prénom</th>
                    <th>Contact</th>
                    <th>N° devis</th>
                    <th>Délai de livraison</th>
                    <th>Tva</th>
                    <th>Total à payer</th>
                    <th>Frais</th>
                    <th>Motif</th>
                    <th>Infos devis</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($particulierdevis as $particulierdevis)
                    <tr>
                      <td class="fw-bold">{{ $particulierdevis->particulier->nom }}</td>
                      <td class="fw-bold">{{ $particulierdevis->particulier->contact }}</td>
                      <td class="fw-bold">{{ $particulierdevis->numero_devis }}</td>
                      <td class="fw-bold">{{ $particulierdevis->delai_livraison }}</td>
                      <td class="fw-bold">{{ $particulierdevis->tva }}</td>
                      <td class="fw-bold">{{ $particulierdevis->total_ttc }}</td>
                      <td class="fw-bold">{{ $particulierdevis->frais }}</td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#motifRejetCommandeParticulier{{ $particulierdevis->id }}">
                            <i class="bi-eye me-1"></i> Voir
                          </a>
                        </div>
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#">
                            <i class="bi-pencil-fill me-1"></i> Details
                          </a>

                          <!-- Button Group -->
                          <div class="btn-group">
                            <button type="button" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="productsEditDropdown1" data-bs-toggle="dropdown" aria-expanded="false"></button>

                            <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="productsEditDropdown1">
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#motifRejetParticulierDevis{{ $particulierdevis->id }}">
                                  <i class="bi-eye dropdown-item-icon"></i> Motif du rejet
                                </a>
                              <a class="dropdown-item" href="{{ route('commercial.devis.particulier.create.deux', $particulierdevis) }}">
                                <i class="bi-pencil-fill me-1 dropdown-item-icon"></i> Produit
                              </a>
                              <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editParticulierDevis{{ $particulierdevis->id }}">
                                <i class="bi-pencil-fill me-1 dropdown-item-icon"></i> Devis
                              </a>
                              @if($particulierdevis->particulierdevisprods()->count() > 0)
                                <a class="dropdown-item" href="{{ route('commercial.devis.particulier.finalite', $particulierdevis) }}">
                                  <i class="bi-printer me-1 dropdown-item-icon"></i> Finalité
                                </a>
                                <a class="dropdown-item" href="{{ route('commercial.devis.particulier.convertir.update', $particulierdevis) }}">
                                  <i class="bi-share-fill dropdown-item-icon"></i> Convertir en devis
                                </a>
                              @endif
                            </div>
                          </div>
                          <!-- End Button Group -->
                        </div>
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#deleteParticulierDevis{{ $particulierdevis->id }}">
                            <i class="bi-trash dropdown-item-icon"></i> supprimer
                          </a>
                        </div>
                      </td>
                    </tr>

                    @include('include.devis-particulier')
                    @include('include.commande-particulier')
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
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucune commande entreprise refusé n'est disponible sur la plateforme</h3>
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