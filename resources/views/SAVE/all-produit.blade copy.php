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
            <h1 class="page-header-title">Tout les produits disponibles <span class="badge bg-soft-dark text-dark ms-2">{{ $produits->count() }}</span></h1>
          </div>
          <!-- End Col -->

          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('geststock.produit.create') }}">
              <i class="bi-person-plus-fill me-1"></i> Ajouter
            </a>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->

        <!-- End Nav Scroller -->
      </div>
      <!-- End Page Header -->

      <!-- Card -->
      <div class="card card-table">
          @if($produits->count() > 0)
            <!-- Header -->
            <div class="card-header card-header-content-md-between">
              <div class="mb-2 mb-md-0">
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
                    <!-- <th scope="col" class="table-column-pe-0">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll">
                        <label class="form-check-label">
                        </label>
                      </div>
                    </th> -->
                    <th>Produit</th>
                    <th>Description</th>
                    <th>Prix unitaire</th>
                    <th>Quantités en stock</th>
                    <th>Quantités en commande</th>
                    <th>Référence</th>
                    <th>Type de produit</th>
                    <th>Entrepôt</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($produits as $produit)
                    <tr>
                      <!-- <td class="table-column-pe-0">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll1">
                          <label class="form-check-label" for="datatableCheckAll1"></label>
                        </div>
                      </td> -->
                      <td>
                        <h5 class="text-inherit mb-0">{{ $produit->nom }}</h5>
                      </td>
                      <td class="fw-bold">@if($produit->description) {{ $produit->description }} @else Aucune description @endif</td>
                      <td class="fw-bold">{{ getprice($produit->prix) }} F</td>
                      <td class="text-warning">{{ $produit->qtyStock }} (en stock)</td>
                      @php 
                        $qtyC = 0;
                        $qtyL = 0;
                        foreach($produit->clientdevisprods as $clientdevisprod)
                        {
                          
                          if($clientdevisprod->clientdevis->clientdevisinfo->isvalide && !$clientdevisprod->clientdevis->clientdevisinfo->livraison)
                          {
                            $qtyC += $clientdevisprod->quantite;
                          }
                          if($produit->TP)
                          {
                          }else
                          {
                            if($clientdevisprod->clientdevis->clientdevisinfo->isvalide && !$clientdevisprod->clientdevis->clientdevisinfo->livraison)
                            {
                              $qtyC += $clientdevisprod->quantite;
                            }
                          }
                        }
                      @endphp
                      <td class="text-warning">{{ $qtyC }}</td>
                      <td class="text-warning">{{ $produit->reference }}</td>
                      <td class="fw-bold">@if($produit->TP) Prestation de service @else Vente @endif</td>
                      <td class="fw-bold">{{ $produit->categorie->nom }}</td>
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
                              <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteProduit{{ $produit->id }}">
                                <i class="bi-trash dropdown-item-icon"></i> Supprimer
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