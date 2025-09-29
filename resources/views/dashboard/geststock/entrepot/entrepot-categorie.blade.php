@extends('dashboard.geststock.layout.app')
@section('body')

  @include('include.message.dashboard')
  @include('include.geststock.entrepot-categorie1')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Liste des familles de produit de l'entrepôt <span class="text-danger">{{ $categorie->nom }}</span> <span class="badge bg-soft-dark text-dark ms-2">{{ $categorie->entrepotcategs->count() }}</span></h1>
          </div>
          <!-- End Col -->

          <div class="col-auto">
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEntrepotCategorie{{ $categorie->id }}">
              <i class="bi-plus me-1"></i> Ajouter une famille
            </a>
            <a class="btn btn-primary" href="{{ route('geststock.categorie.index') }}">
              <i class="bi-arrow-return-left me-1"></i> Retour
            </a>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->

      </div>
      <!-- End Page Header -->

      <!-- Card -->
      <div class="card card-table">
          @if($categorie->entrepotcategs->count() > 0)
            <!-- Header -->
            <div class="card-header card-header-content-md-between">
              <div class="mb-2 mb-md-0 w-100">
                <form>
                  <!-- Search -->
                  <div class="input-group input-group-merge input-group-flush">
                    <div class="input-group-prepend input-group-text">
                      <i class="bi-search"></i>
                    </div>
                    <input id="datatableSearch" type="search" class="form-control" placeholder="Rechercher une famille" aria-label="Rechercher une famille">
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
                    <th class="text-center">Nombre de produit</th>
                    <th>Total TTC (Fcfa)</th>
                    <th class="text-center">Actions</th>
                  </tr>
                </thead>

                <tbody>
                  @php $n = 1 ; @endphp
                  @foreach($categorie->entrepotcategs as $entrepotcateg)
                    <tr>
                      <td class="fw-bold">{{ $n++ }}</td>
                      <td class="fw-bold">{{ $entrepotcateg->categorieprod->nom }}</td>
                      <td class="text-center">
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" @if($entrepotcateg->produits()->count() > 0) href="{{ route('geststock.entrepot.categorie.produit', $entrepotcateg) }}" @else href="#" @endif>
                            <i class="bi-eye me-1"></i> {{ $entrepotcateg->produits()->count() }}
                          </a>
                        </div>
                      </td>
                      <td class="fw-bold">{{ entrepotCategorieProduitPrix($entrepotcateg) }}</td>
                      <td class="text-center">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#deleteEntrepotCategorie{{ $entrepotcateg->id }}">
                            <i class="bi-trash me-1"></i> Supprimer
                          </a>
                        </div>
                      </td>
                    </tr>
                    @include('include.geststock.entrepot-categorie3')
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
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucune famille de produit n'a été ajouté dans cet entrepôt sur la plateforme</h3>
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