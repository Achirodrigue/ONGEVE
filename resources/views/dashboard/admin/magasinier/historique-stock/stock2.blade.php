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
            <h1 class="page-header-title">Entrée et sortie des produits sur la plateforme <span class="badge bg-soft-dark text-dark ms-2">{{ $produitses->count() }}</span></h1>
          </div>
          
          <div class="col-auto">
            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#entrepotProduit">
              <i class="bi-eye me-1"></i> Entrepôt
            </a>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->

      </div>
      <!-- End Page Header -->

      <!-- Card -->
      <div class="card card-table">
          @if($produitses->count() > 0)
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
                    <th colspan="6" scope="col">Entrées et sortie du stock</th>
                  </tr>
                  <tr>
                    <th scope="col" class="text-center">N°</th>
                    <th scope="col">Date</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Code article</th>
                    <th scope="col">Entrée</th>
                    <th scope="col">Sortie</th>
                  </tr>
                </thead>

                <tbody>
                    @php
                         $n = 1;
                    @endphp
               
                    @foreach($produitses as $produitse)
                         <tr>
                              <td class="text-center">
                                   <button type="button" class="btn btn-sm btn-soft-secondary px-3 fw-bold">{{ $n++ }}</button>
                              </td>
                              <td>{{ $produitse->created_at->format("d-m-Y H:i") }}</td>
                              <td>{{ $produitse->produit->nom }}</td>
                              <td>{{ $produitse->produit->reference }}</td>
                              <td>@if($produitse->entree_sortie) {{ $produitse->quantite }} @endif</td>
                              <td>@if(!$produitse->entree_sortie) {{ $produitse->quantite }} @endif</td>
                         </tr>
                         @php
                              $produit = $produitse->produit;
                         @endphp
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
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucun produit n'a été ajouté sur la plateforme</h3>
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