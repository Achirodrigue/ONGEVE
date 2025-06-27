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
            <h1 class="page-header-title">Nombre de devis en cours <span class="badge bg-soft-dark text-dark ms-2">{{ $clientdevis->count() }}</span></h1>

            <!-- <div class="mt-2">
              <a class="text-body me-3" href="javascript:;" data-bs-toggle="modal" data-bs-target="#exportProductsModal">
                <i class="bi-download me-1"></i> Export
              </a>
              <a class="text-body" href="javascript:;" data-bs-toggle="modal" data-bs-target="#importProductsModal">
                <i class="bi-upload me-1"></i> Import
              </a>
            </div> -->
          </div>
          <!-- End Col -->

          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('commercial.devis.particulier.encours') }}">
              <i class="bi-eye me-1"></i> Devis Entreprise en cours
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
              <a class="nav-link active" href="#">All products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Archived</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Publish</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Unpublish</a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
      </div>
      <!-- End Page Header -->

      <div class="row justify-content-end mb-3">
        <div class="col-lg">
          <!-- Datatable Info -->
          <div id="datatableCounterInfo" style="display: none;">
            <div class="d-sm-flex justify-content-lg-end align-items-sm-center">
              <span class="d-block d-sm-inline-block fs-5 me-3 mb-2 mb-sm-0">
                <span id="datatableCounter">0</span>
                Selected
              </span>
              <a class="btn btn-outline-danger btn-sm mb-2 mb-sm-0 me-2" href="javascript:;">
                <i class="bi-trash"></i> Delete
              </a>
              <a class="btn btn-white btn-sm mb-2 mb-sm-0 me-2" href="javascript:;">
                <i class="bi-archive"></i> Archive
              </a>
              <a class="btn btn-white btn-sm mb-2 mb-sm-0 me-2" href="javascript:;">
                <i class="bi-upload"></i> Publish
              </a>
              <a class="btn btn-white btn-sm mb-2 mb-sm-0" href="javascript:;">
                <i class="bi-x-lg"></i> Unpublish
              </a>
            </div>
          </div>
          <!-- End Datatable Info -->
        </div>
      </div>
      <!-- End Row -->

      <!-- Card -->
      <div class="card">
          @if($clientdevis->count() > 0)
            <!-- Header -->
            <div class="card-header card-header-content-md-between">
              <div class="mb-2 mb-md-0">
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
              

              <div class="d-grid d-sm-flex gap-2">
                <button class="btn btn-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEcommerceProductFilter" aria-controls="offcanvasEcommerceProductFilter">
                  <i class="bi-filter me-1"></i> Filters
                </button>

                <!-- Dropdown -->
                <div class="dropdown">
                  <button type="button" class="btn btn-white w-100" id="showHideDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                    <i class="bi-table me-1"></i> Columns <span class="badge bg-soft-dark text-dark rounded-circle ms-1">6</span>
                  </button>

                  <div class="dropdown-menu dropdown-menu-end dropdown-card" aria-labelledby="showHideDropdown" style="width: 15rem;">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="d-grid gap-3">
                          <!-- Form Switch -->
                          <label class="row form-check form-switch" for="toggleColumn_product">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="me-2">Product</span>
                            </span>
                            <span class="col-4 col-sm-3 text-end">
                              <input type="checkbox" class="form-check-input" id="toggleColumn_product" checked>
                            </span>
                          </label>
                          <!-- End Form Switch -->

                          <!-- Form Switch -->
                          <label class="row form-check form-switch" for="toggleColumn_type">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="me-2">Type</span>
                            </span>
                            <span class="col-4 col-sm-3 text-end">
                              <input type="checkbox" class="form-check-input" id="toggleColumn_type" checked>
                            </span>
                          </label>
                          <!-- End Form Switch -->

                          <!-- Form Switch -->
                          <label class="row form-check form-switch" for="toggleColumn_vendor">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="me-2">Vendor</span>
                            </span>
                            <span class="col-4 col-sm-3 text-end">
                              <input type="checkbox" class="form-check-input" id="toggleColumn_vendor">
                            </span>
                          </label>
                          <!-- End Form Switch -->

                          <!-- Form Switch -->
                          <label class="row form-check form-switch" for="toggleColumn_stocks">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="me-2">Stocks</span>
                            </span>
                            <span class="col-4 col-sm-3 text-end">
                              <input type="checkbox" class="form-check-input" id="toggleColumn_stocks" checked>
                            </span>
                          </label>
                          <!-- End Form Switch -->

                          <!-- Form Switch -->
                          <label class="row form-check form-switch" for="toggleColumn_sku">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="me-2">SKU</span>
                            </span>
                            <span class="col-4 col-sm-3 text-end">
                              <input type="checkbox" class="form-check-input" id="toggleColumn_sku" checked>
                            </span>
                          </label>
                          <!-- End Form Switch -->

                          <!-- Form Switch -->
                          <label class="row form-check form-switch" for="toggleColumn_price">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="me-2">Price</span>
                            </span>
                            <span class="col-4 col-sm-3 text-end">
                              <input type="checkbox" class="form-check-input" id="toggleColumn_price" checked>
                            </span>
                          </label>
                          <!-- End Form Switch -->

                          <!-- Form Switch -->
                          <label class="row form-check form-switch" for="toggleColumn_quantity">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="me-2">Quantity</span>
                            </span>
                            <span class="col-4 col-sm-3 text-end">
                              <input type="checkbox" class="form-check-input" id="toggleColumn_quantity">
                            </span>
                          </label>
                          <!-- End Form Switch -->

                          <!-- Form Switch -->
                          <label class="row form-check form-switch" for="toggleColumn_variants">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="me-2">Variants</span>
                            </span>
                            <span class="col-4 col-sm-3 text-end">
                              <input type="checkbox" class="form-check-input" id="toggleColumn_variants" checked>
                            </span>
                          </label>
                          <!-- End Form Switch -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Dropdown -->
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
                    <th>Infos devis</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($clientdevis as $clientdevis)
                    <tr>
                      <td class="fw-bold">{{ $clientdevis->client->nom }} {{ $clientdevis->client->prenom }}</td>
                      <td class="fw-bold">{{ $clientdevis->client->contact }}</td>
                      <td class="fw-bold">{{ $clientdevis->numero_devis }}</td>
                      <td class="fw-bold">@if($clientdevis->delai_livraison) {{ $clientdevis->delai_livraison }} @else En cours @endif</td>
                      <td class="fw-bold">{{ getprice($clientdevis->tva) }}F</td>
                      <td class="fw-bold">{{ $clientdevis->total_ttc + $clientdevis->frais + $clientdevis->tva }}</td>
                      <td class="fw-bold">@if($clientdevis->frais) {{ getprice($clientdevis->frais) }} F @else En cours @endif</td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#">
                            <i class="bi-pencil-fill me-1"></i> Details
                          </a>

                          <!-- Button Group -->
                          <div class="btn-group">
                            <button type="button" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="productsEditDropdown1" data-bs-toggle="dropdown" aria-expanded="false"></button>

                            <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="productsEditDropdown1">
                              <a class="dropdown-item" href="{{ route('commercial.devis.client.create.deux', $clientdevis) }}">
                                <i class="bi-pencil-fill me-1 dropdown-item-icon"></i> Produit
                              </a>
                              <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editClientDevis{{ $clientdevis->id }}">
                                <i class="bi-pencil-fill me-1 dropdown-item-icon"></i> Devis
                              </a>
                              @if($clientdevis->clientdevisprods()->count() > 0)
                                <a class="dropdown-item" href="{{ route('commercial.devis.client.finalite', $clientdevis) }}">
                                  <i class="bi-printer me-1 dropdown-item-icon"></i> Finalité
                                </a>
                                <a class="dropdown-item" href="{{ route('pdf.devis.commande.client', $clientdevis) }}" target="_blank">
                                  <i class="bi-file-earmark-arrow-down me-1 dropdown-item-icon"></i> PDF
                                </a>
                                <a class="dropdown-item" href="{{ route('commercial.devis.client.convertir.update', $clientdevis) }}">
                                  <i class="bi-share-fill dropdown-item-icon"></i> Convertir en commande
                                </a>
                              @endif
                            </div>
                          </div>
                          <!-- End Button Group -->
                        </div>
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#deleteClientDevis{{ $clientdevis->id }}">
                            <i class="bi-trash dropdown-item-icon"></i> Delete
                          </a>
                        </div>
                      </td>
                    </tr>
                    @include('include.devis-client')
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
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucun devis client n'a été ajouté sur la plateforme</h3>
              </div>
              <!-- End Header -->
          @endif
      </div>
      <!-- End Card -->
    </div>
    <!-- End Content -->

    <!-- Footer -->

    <div class="footer">
      <div class="row justify-content-between align-items-center">
        <div class="col">
          <p class="fs-6 mb-0">&copy; Front. <span class="d-none d-sm-inline-block">2022 Htmlstream.</span></p>
        </div>
        <!-- End Col -->

        <div class="col-auto">
          <div class="d-flex justify-content-end">
            <!-- List Separator -->
            <ul class="list-inline list-separator">
              <li class="list-inline-item">
                <a class="list-separator-link" href="#">FAQ</a>
              </li>

              <li class="list-inline-item">
                <a class="list-separator-link" href="#">License</a>
              </li>

              <li class="list-inline-item">
                <!-- Keyboard Shortcuts Toggle -->
                <button class="btn btn-ghost-secondary btn btn-icon btn-ghost-secondary rounded-circle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasKeyboardShortcuts" aria-controls="offcanvasKeyboardShortcuts">
                  <i class="bi-command"></i>
                </button>
                <!-- End Keyboard Shortcuts Toggle -->
              </li>
            </ul>
            <!-- End List Separator -->
          </div>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->
    </div>

    <!-- End Footer -->
  </main>
  <!-- ========== END MAIN CONTENT ========== -->



@endsection