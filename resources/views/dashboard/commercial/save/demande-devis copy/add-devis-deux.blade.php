@extends('dashboard.commercial.layout.app')
@section('body')


  @include('include.message')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Ajout de produit dans le devis de 
              <span class="badge bg-soft-dark text-dark ms-2">{{ $clientdevis->client->nom }} {{ $clientdevis->client->prenom }}</span>
            </h1>
            <h4 class="page-header-title">Etape 2</h4>
          </div>
          <!-- End Col -->

          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('commercial.devis.index') }}">
              <i class="bi-person-plus-fill me-1"></i> Retour
            </a>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->

      </div>
      <!-- End Page Header -->

      <!-- Card -->
      <div class="card mb-3">
          @if($clientdevis->clientdevisprods()->count() > 0)
            <!-- Table -->
            <div class="table-responsive datatable-custom">
              <table class="table table-bordered table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table" style="width: 100%" data-hs-datatables-options='{
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
                 }'
                >
                <thead class="thead-light">
                  <tr>
                    <th colspan="5" scope="col">Inventaire du Total à payer (Fcfa)</th>
                    <th scope="col" class="fw-bold">{{ getprice($clientdevis->total_ttc) }}</th>
                  </tr>
                  <tr>
                    <th>Produit</th>
                    <!-- <th>Description</th> -->
                    <th>Quantité</th>
                    <th>Prix unitaire (Fcfa)</th>
                    <th>Prix Total (Fcfa)</th>
                    <th>Référence</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($clientdevis->clientdevisprods as $clientdevisprod)
                    <tr>
                      <td>
                        <a class="d-flex align-items-center" href="#">
                          <div class="flex-shrink-0">
                            <img class="avatar avatar-lg" src="{{ asset(Storage::url($clientdevisprod->produit->image)) }}" alt="Image Description">
                          </div>
                          <div class="flex-grow-1 ms-3">
                            <h5 class="text-inherit mb-0">{{ $clientdevisprod->produit->nom }}</h5>
                          </div>
                        </a>
                      </td>
                      <td class="text-warning">{{ $clientdevisprod->quantite }}</td>
                      <td class="fw-bold">{{ getprice($clientdevisprod->prix_unitaire) }}</td>
                      <td class="fw-bold">{{ getprice($clientdevisprod->prix_total) }}</td>
                      <td class="text-warning">{{ $clientdevisprod->produit->reference }}</td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#devisProduitQtyUpdate{{ $clientdevisprod->id }}">
                            <i class="bi-pencil-fill me-1"></i> Edit
                          </a>
                          <a class="btn btn-white btn-sm" href="{{ route('commercial.produit.devis.destroy', $clientdevisprod) }}">
                            <i class="bi-trash dropdown-item-icon"></i> Delete
                          </a>
                        </div>
                      </td>
                    </tr>

                    @include('include.produit.produit-devis2')
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- End Table -->
          @else
              <!-- Header -->
              <div class="card-header card-header-content-md-between p-4">
                <h4 class="fw-bold mb-0 text-center">Désolé! Aucun produit n'a été associé à ce devis</h4>
              </div>
              <!-- End Header -->
          @endif
      </div>
      <!-- End Card -->

      <!-- Card -->
      <div class="card">
          @if(produits()->count() > 0)
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
              <table id="datatable" class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table" style="width: 100%" data-hs-datatables-options='{
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
                    <th scope="col" class="table-column-pe-0">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll">
                        <label class="form-check-label">
                        </label>
                      </div>
                    </th>
                    <th class="table-column-ps-0">Produit</th>
                    <th>Description</th>
                    <th>Prix unitaire</th>
                    <th>Quantités en stock</th>
                    <th>Référence</th>
                    <th>Catégorie</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach(produits() as $produit)
                    <tr>
                      <td class="table-column-pe-0">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll1">
                          <label class="form-check-label" for="datatableCheckAll1"></label>
                        </div>
                      </td>
                      <td class="table-column-ps-0">
                        <a class="d-flex align-items-center" href="ecommerce-product-details.html">
                          <div class="flex-shrink-0">
                            <img class="avatar avatar-lg" src="{{ asset(Storage::url($produit->image)) }}" alt="Image Description">
                          </div>
                          <div class="flex-grow-1 ms-3">
                            <h5 class="text-inherit mb-0">{{ $produit->nom }}</h5>
                          </div>
                        </a>
                      </td>
                      <td class="fw-bold">@if($produit->description) {{ $produit->description }} @else Aucune description @endif</td>
                      <td class="fw-bold">{{ getprice($produit->prix) }}</td>
                      <td class="text-warning">{{ $produit->qtyStock }} (en stock)</td>
                      <td class="text-warning">{{ $produit->reference }}</td>
                      <td class="fw-bold">{{ $produit->categorie->nom }}</td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#addProdDevis{{ $produit->id }}">
                            <i class="bi-pencil-fill me-1"></i> Ajouter
                          </a>

                          <!-- Button Group -->
                          <!-- <div class="btn-group">
                            <button type="button" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="productsEditDropdown1" data-bs-toggle="dropdown" aria-expanded="false"></button>

                            <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="productsEditDropdown1">
                              <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addProdDevis{{ $produit->id }}">
                                <i class="bi-trash dropdown-item-icon"></i> Delete
                              </a>
                              <a class="dropdown-item" href="#">
                                <i class="bi-archive dropdown-item-icon"></i> Archive
                              </a>
                              <a class="dropdown-item" href="#">
                                <i class="bi-upload dropdown-item-icon"></i> Publish
                              </a>
                              <a class="dropdown-item" href="#">
                                <i class="bi-x-lg dropdown-item-icon"></i> Unpublish
                              </a>
                            </div>
                          </div> -->
                          <!-- End Button Group -->
                        </div>
                      </td>
                    </tr>
                    @include('include.produit.produit-devis1')
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
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucun produit n'a été ajouté sur la plateforme</h3>
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