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
            <h1 class="page-header-title">Listes des familles de produit <span class="badge bg-soft-dark text-dark ms-2">{{ $categorieprods->count() }}</span></h1>
          </div>
          <!-- End Col -->

          <div class="col-sm-auto">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategorieProduit">
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
          @if($categorieprods->count() > 0)
            <!-- Header -->
            <div class="card-header card-header-content-md-between">
              <div class="mb-2 mb-md-0 w-100">
                <form>
                  <!-- Search -->
                  <div class="input-group input-group-merge input-group-flush">
                    <div class="input-group-prepend input-group-text">
                      <i class="bi-search"></i>
                    </div>
                    <input id="datatableSearch" type="search" class="form-control" placeholder="Rechercher une catégorie" aria-label="Search users">
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
                    <th>N°</th>
                    <th>Nom de la famille</th>
                    <th class="text-center">Actions</th>
                  </tr>
                </thead>

                <tbody>
                  @php $n = 1; @endphp
                  @foreach($categorieprods as $categorieprod)
                    <tr>
                      <td class="fw-bold">{{ $n++ }}</td>
                      <td class="fw-bold">{{ $categorieprod->nom }}</td>
                      <td class="text-center">
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#editCategorieProduit{{ $categorieprod->id }}">
                            <i class="bi-pencil-fill me-1"></i>
                          </a>
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#deleteCategorieProduit{{ $categorieprod->id }}">
                            <i class="bi-trash me-1"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                    @include('include.geststock.categorie-produit')
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- End Table -->

            <!-- Footer -->
              @include('dashboard.IncludePage.commun.pagination.pagination')
            <!-- End Footer -->
          @else
              <!-- Header -->
              <div class="card-header card-header-content-md-between p-4">
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucune famille de produit n'a été ajouté sur la plateforme</h3>
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
  <div class="modal fade" id="addCategorieProduit" tabindex="-1" aria-labelledby="createAKIKeyModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Ajouter une famille de produit</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <form method="post" action="{{ route('geststock.categorieprod.store') }}" enctype="multipart/form-data">
        @csrf
          <div class="modal-body">
              <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" placeholder="Nom de la catégorie" required>
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