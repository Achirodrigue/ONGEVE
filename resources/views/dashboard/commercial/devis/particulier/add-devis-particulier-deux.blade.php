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
            <h1 class="page-header-title">Ajout de produit dans le devis de 
              <span class="badge bg-soft-dark text-dark ms-2">{{ $particulierdevis->particulier->nom }}</span>
            </h1>
            <h4 class="page-header-title">Etape 2</h4>
          </div>
          <!-- End Col -->

          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('commercial.devis.particulier.encours') }}">
              <i class="bi-arrow-return-left me-1"></i> Retour
            </a>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->

      </div>
      <!-- End Page Header -->

      <!-- Card -->
      <div class="card mb-3">
          @if($particulierdevis->particulierdevisprods()->count() > 0)
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
                    <th colspan="5" scope="col" class="fw-bold text-black">Inventaire du Total à payer (Fcfa)</th>
                    <th scope="col" class="fw-bold text-black">{{ getprice($particulierdevis->total_ttc) }}</th>
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
                  @foreach($particulierdevis->particulierdevisprods as $particulierdevisprod)
                    <tr>
                      <td>
                        <a class="d-flex align-items-center" href="#">
                          <div class="flex-shrink-0">
                            <img class="avatar avatar-lg" src="{{ asset(Storage::url($particulierdevisprod->produit->image)) }}" alt="Image Description">
                          </div>
                          <div class="flex-grow-1 ms-3">
                            <h5 class="text-inherit mb-0">{{ $particulierdevisprod->produit->nom }}</h5>
                          </div>
                        </a>
                      </td>
                      <td class="text-warning">{{ $particulierdevisprod->quantite }}</td>
                      <td class="fw-bold">{{ getprice($particulierdevisprod->prix_unitaire) }}</td>
                      <td class="fw-bold">{{ getprice($particulierdevisprod->prix_total) }}</td>
                      <td class="text-warning">{{ $particulierdevisprod->produit->reference }}</td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#devisProduitQtyUpdate{{ $particulierdevisprod->id }}">
                            <i class="bi-pencil-fill me-1"></i> Modifier
                          </a>
                          <a class="btn btn-white btn-sm" href="{{ route('commercial.produit.devis.particulier.destroy', $particulierdevisprod) }}">
                            <i class="bi-trash dropdown-item-icon"></i> Supprimer
                          </a>
                          @if($particulierdevisprod->particulierremise)
                            <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#devisProduitRemise{{ $particulierdevisprod->id }}">
                              <i class="bi-eye me-1"></i> Remise
                            </a>
                          @endif
                        </div>
                      </td>
                    </tr>

                    @include('include.produit.particulier.produit-devis2')
                    @if($particulierdevisprod->particulierremise) @include('include.produit.particulier.produit-devis3') @endif
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
                    <th scope="col" class="table-column-pe-0">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll">
                        <label class="form-check-label">
                        </label>
                      </div>
                    </th>
                    <th class="table-column-ps-0">Produit</th>
                    <th>Description</th>
                    <th>Prix unitaire (Fcfa)</th>
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
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#editProdPrix{{ $produit->id }}">
                            <i class="bi-pencil-fill me-1"></i> Prix
                          </a>
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#addProdDevis{{ $produit->id }}">
                            <i class="bi-plus me-1"></i> Ajouter
                          </a>
                        </div>
                      </td>
                    </tr>
                    @include('include.produit.particulier.produit-devis1')
                    @include('include.produit.produit')
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

  </main>
  <!-- ========== END MAIN CONTENT ========== -->


@endsection