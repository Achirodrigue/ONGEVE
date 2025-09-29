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
            <h1 class="page-header-title">Stock des produits de {{ $categorie->nom }}<span class="badge bg-soft-dark text-dark ms-2">{{ $categorie->produits->count() }}</span></h1>

            <!-- <div class="mt-2">
              <a class="text-body me-3" href="javascript:;" data-bs-toggle="modal" data-bs-target="#exportProductsModal">
                <i class="bi-download me-1"></i> Export
              </a>
              <a class="text-body" href="javascript:;" data-bs-toggle="modal" data-bs-target="#importProductsModal">
                <i class="bi-upload me-1"></i> Import
              </a>
            </div> -->
          </div>
          <div class="col-auto">
            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#entrepotProduit">
              <i class="bi-eye me-1"></i> Entrepôt
            </a>
          </div>
        </div>

        <!-- 

          <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" href="#">Commandes Impayées</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('comptable.commande.client.partielle') }}" tabindex="-1" aria-disabled="true">Commandes Partielle</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('comptable.commande.client.paye') }}" tabindex="-1" aria-disabled="true">Commandes Payées</a>
            </li>
          </ul>
        
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
        </div> -->
      </div>
      <!-- End Page Header -->

      <!-- <div class="row justify-content-end mb-3">
        <div class="col-lg">
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
        </div>
      </div> -->
      <!-- End Row -->

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
                    <th scope="col">Montant du Stock (Fcfa)</th>
                    <th scope="col">{{ getprice($prixTotal) }}</th>
                  </tr>
                  <tr>
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
                  </tr>
                </thead>

                <tbody>
                  @foreach($produits as $produit)
                    <tr>
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
                      <td>{{ $produit->qtyStock }}</td>
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
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucun produit n'a été ajouté dans {{ $categorie->nom }} sur la plateforme</h3>
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