@extends('dashboard.geststock.layout.app')
@section('body')


  @include('include.message.dashboard')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">
              Stock des produits de l'entrepôt 
              <span class="text-danger">{{ $categorie->nom }}</span> de 
              <span class="badge bg-soft-dark text-dark ms-2">{{ $produits->count() }}</span></h1>
          </div>
          <div class="col-auto">
            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#entrepotProduit">
              <i class="bi-eye me-1"></i> Entrepôt
            </a>
          </div>
        </div>

      </div>
      <!-- End Page Header -->

      <!-- Card -->
      <div class="card card-table">
          @if($produits->count() > 0)
            <!-- Header -->
            <div class="card-header card-header-content-md-between">
              <div class="mb-2 mb-md-0 w-100">
                <form>
                  <!-- Search -->
                  <div class="input-group input-group-merge input-group-flush">
                    <div class="input-group-prepend input-group-text">
                      <i class="bi-search"></i>
                    </div>
                    <input id="datatableSearch" type="search" class="form-control" placeholder="Rechercher un produit" aria-label="Search users">
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
                @php
                    $prixTotal = 0;
                    $n = 1;
                    foreach($produits as $produit)
                    {
                          $prixTotal = $prixTotal + ($produit->prix * ($produit->qtyStock - $produit->produitstat->sortie)) ;
                    }
                @endphp
                <thead class="thead-light">
                  <tr>
                    <th colspan="8" scope="col">Inventaire du stock avec alerte du stock minimum</th>
                    <th colspan="2" scope="col">Montant du Stock (Fcfa)</th>
                    <th colspan="2" scope="col">{{ getprice($prixTotal) }}</th>
                  </tr>
                  <tr>
                    <th>N°</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Code article</th>
                    <th scope="col">Stock min</th>
                    <th scope="col">Stock initial</th>
                    <th scope="col">Entrée</th>
                    <th scope="col">Sortie</th>
                    <th scope="col">Alerte stock</th>
                    <th scope="col">Stock final</th>
                    <th scope="col">P.U (Fcfa)</th>
                    <th scope="col">Valeur du stock</th>
                    <th scope="col"></th>
                  </tr>
                </thead>

                <tbody>
                  @php $n = 1; @endphp
                  @foreach($produits as $produit)
                    @php $a = $n; @endphp
                    <tr>
                      <td class="fw-bold">{{ $n++ }}</td>
                      <td>
                        <h5 class="text-inherit mb-0">{{ $produit->nom }}</h5>
                      </td>
                      <td>{{ $produit->reference }}</td>
                      <td>
                          @if($produit->qtyStock <= $produit->produitstat->stock_min) 
                                <span class="text-danger">{{ $produit->produitstat->stock_min }}</span>
                          @else
                                {{ $produit->produitstat->stock_min }}
                          @endif
                      </td>
                      <td>{{ $produit->qtyStock }} <span class="text-danger">@if(produitEnCommande($produit) > 0) ({{ produitEnCommande($produit) }} en commande) @endif</span></td>
                      <td>{{ $produit->produitstat->entree }}</td>
                      <td>{{ $produit->produitstat->sortie }}</td>
                      <td class="text-center">
                          @if($produit->qtyStock <= $produit->produitstat->stock_min)
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="red" viewBox="0 0 24 24">
                                    <path d="M12 0C5.3726 0 0 5.3726 0 12s5.3726 12 12 12 12-5.3726 12-12S18.6274 0 12 0zm4.95 16.95l-1.41 1.41L12 13.41l-3.54 3.54-1.41-1.41L10.59 12 7.05 8.46l1.41-1.41L12 10.59l3.54-3.54 1.41 1.41L13.41 12l3.54 3.54z"/>
                                </svg>
                          @endif
                      </td>
                      <td>{{ $produit->qtyStock - $produit->produitstat->sortie }}</td>
                      <td>{{ getprice($produit->prix) }}</td>
                      <td>{{ getprice($produit->prix * ($produit->qtyStock - $produit->produitstat->sortie)) }}</td>
                      <td class="fw-bold">{{ $a }}</td>
                    </tr>
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
                    <span class="me-2">Page:</span>

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
                <h3 class="fw-bold mb-0 text-center">
                  Désolé! Aucun produit n'a été ajouté dans l'entrepôt <span class="text-danger">{{ $categorie->nom }}</span></h3>
              </div>
              <!-- End Header -->
          @endif
      </div>
      <!-- End Card -->
    </div>
    <!-- End Content -->


    <!-- End Footer -->
  </main>
  <!-- ========== END MAIN CONTENT ========== -->



@endsection