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
            <h1 class="page-header-title">Liste des produits de la famille <span class="text-danger">{{ $entrepotcateg->categorieprod->nom }}</span> de l'entrepôt <span class="text-danger">{{ $entrepotcateg->categorie->nom }}</span> <span class="badge bg-soft-dark text-dark ms-2">{{ $produits->count() }}</span></h1>
          </div>
          <!-- End Col -->

          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('geststock.entrepot.categorie', $entrepotcateg->categorie) }}">
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
                <thead class="thead-light">
                  <tr>
                    <th>N°</th>
                    <th>Type de produit</th>
                    <th>Produit</th>
                    <th>Description</th>
                    <th>Prix unitaire</th>
                    <th>Quantités en stock</th>
                    <th>Référence</th>
                    <th>Unité</th>
                    <th>Image</th>
                    <!-- <th>Ref du fournisseur</th> -->
                    <th>Actions</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>
                  @php $n = 1; @endphp
                  @foreach($produits as $produit)
                    @php $a=$n; @endphp
                    <tr>
                      <td class="fw-bold">{{ $n++ }}</td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn @if($produit->TP) btn-warning @else btn-danger @endif btn-sm">
                            @if($produit->TP) Location @else Vente @endif
                          </a>
                        </div>
                      </td>
                      <td>
                        <h5 class="text-inherit mb-0">{{ $produit->nom }}</h5>
                      </td>
                      <td class="fw-bold">
                        @if($produit->description)
                          <div class="btn-group" role="group">
                            <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#infoDescProduit{{ $produit->id }}">
                              <i class="bi-eye me-1"></i>Voir
                            </a>
                          </div>
                        @else Aucune @endif
                      </td>
                      <td class="fw-bold">{{ getprice($produit->prix) }}</td>
                      @php 
                        $qtyC = 0;
                        foreach($produit->clientdevisprods as $clientdevisprod)
                        {
                          if($clientdevisprod->clientdevis->clientdevisinfo->isvalide && !$clientdevisprod->clientdevis->clientdevisinfo->livraison)
                          {
                            $qtyC += $clientdevisprod->quantite;
                          }
                        }
                      @endphp
                      <td class="text-danger">@if($produit->qtyStock > 0) {{ $produit->qtyStock }} @else 0 @endif @if($qtyC > 0) ({{ $qtyC }} en commande) @endif</td>
                      <td class="text-danger">{{ $produit->reference }}</td>
                      <td class="fw-bold">@if($produit->unite) {{ $produit->unite }} @else Aucune @endif</td>
                      <td class="text-center">
                        @if($produit->image)
                          <div class="btn-group" role="group">
                            <a class="btn btn-white btn-sm" target="_blank" href="{{ asset(Storage::url($produit->image)) }}">
                              <i class="bi-eye me-1"></i> Voir
                            </a>
                          </div>
                        @else Aucune @endif
                      </td>
                      <!-- <td class="text-warning">{{ $produit->reff }}</td> -->
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="{{ route('geststock.produit.edit', $produit) }}">
                            <i class="bi-pencil-fill me-1"></i>
                          </a>
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#deleteProduit{{ $produit->id }}">
                            <i class="bi-trash me-1"></i>
                          </a>

                          <!-- Button Group -->
                          <!-- <div class="btn-group">
                            <button type="button" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="productsEditDropdown1" data-bs-toggle="dropdown" aria-expanded="false"></button>

                            <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="productsEditDropdown1">
                              
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
                      <td class="fw-bold">{{ $a }}</td>
                    </tr>
                    @include('include.produit.produit')
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
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucun produit n'a été ajouté dans cet entrepôt sur la plateforme</h3>
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