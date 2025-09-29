@extends('dashboard.magasinier.layout.app')
@section('body')

  @include('include.message.dashboard')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Entrepôt de produit <span class="badge bg-soft-dark text-dark ms-2">{{ $categories->count() }}</span></h1>
          </div>
          <!-- End Col -->

          <div class="col-sm-auto">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategorie">
              <i class="bi-plus me-1"></i> Ajouter
            </button>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->

      </div>
      <!-- End Page Header -->

      <!-- Card -->
      <div class="card card-table">
          @if($categories->count() > 0)
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
                    <!-- <th scope="col" class="table-column-pe-0">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll">
                        <label class="form-check-label">
                        </label>
                      </div>
                    </th> -->
                    <th>Nom de l'entrepôt</th>
                    <th class="text-center">Nombre de produit</th>
                    <th>Total TTC (Fcfa)</th>
                    <th class="text-center">Actions</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($categories as $categorie)
                    <tr>
                      <!-- <td class="table-column-pe-0">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll1">
                          <label class="form-check-label" for="datatableCheckAll1"></label>
                        </div>
                      </td> -->
                      <td class="fw-bold">{{ $categorie->nom }}</td>
                      <td class="text-center">
                        <a href="{{ route('magasinier.categorie.produit', $categorie) }}" class="btn btn-primary">{{ $categorie->produits()->count() }}</a>
                      </td>
                      <td class="text-warning">{{ prixCategorieProduit($categorie) }}</td>
                      <td class="text-center">
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#editCategorie{{ $categorie->id }}">
                            <i class="bi-pencil-fill me-1"></i>
                          </a>
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#deleteCategorie{{ $categorie->id }}">
                            <i class="bi-trash me-1"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                    @include('include.categorie')
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
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucun entrepôt de produit n'a été ajouté sur la plateforme</h3>
              </div>
              <!-- End Header -->
          @endif
      </div>
      <!-- End Card -->
    </div>
    <!-- End Content -->
  </main>
  <!-- ========== END MAIN CONTENT ========== -->

  <!-- Create New Category Modal -->
  <div class="modal fade" id="addCategorie" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Ajouter un entrepôt</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <form method="post" action="{{ route('magasinier.categorie.store') }}" enctype="multipart/form-data">
        @csrf
          <div class="modal-body">
              <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" placeholder="Nom de l'entrepôt" required>
              @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          <!-- End Body -->

          <!-- Footer -->
          <div class="modal-footer">
            <div class="row align-items-sm-center flex-grow-1 mx-n2 justify-content-end">
              <!-- <div class="col-sm mb-2 mb-sm-0">
                <p class="modal-footer-text">What is an API? <i class="bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="API stands for application programming interface. It can be helpful to think of the API as a way for different apps to talk to one another."></i></p>
              </div> -->
              <!-- End Col -->

              <div class="col-sm-auto">
                <div class="d-flex gap-3">
                  <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                  <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
              </div>
              <!-- End Col -->
            </div>
            <!-- End Row -->
          </div>
          <!-- End Footer -->
        </form>

      </div>
    </div>
  </div>
  <!-- End Create New API Key Modal -->
  
  
@endsection