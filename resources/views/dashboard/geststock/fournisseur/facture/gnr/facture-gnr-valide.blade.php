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
            <h1 class="page-header-title">Les différentes factures fournisseur établies, receptionnées et conformes<span class="badge bg-soft-dark text-dark ms-2">{{ $fournisseurfactures->count() }}</span></h1>
          </div>
        </div>
        <!-- End Row -->

        <!-- Nav Scroller -->
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

          <!-- Nav -->
          <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('geststock.generale.fournisseur.facture.reception.encours') }}" tabindex="-1" aria-disabled="true">
                Factures en attente
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('geststock.generale.fournisseur.facture.reception.recu') }}" tabindex="-1" aria-disabled="true">
                Factures receptionnées
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">
                Factures receptionnées et conformes
              </a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
      </div>
      <!-- End Page Header -->

      <!-- Card -->
       <div class="card card-table">
          @if($fournisseurfactures->count() > 0)
            <!-- Header -->
            <div class="card-header card-header-content-md-between">
              <div class="mb-2 mb-md-0 w-100">
                <form>
                  <!-- Search -->
                  <div class="input-group input-group-merge input-group-flush">
                    <div class="input-group-prepend input-group-text">
                      <i class="bi-search"></i>
                    </div>
                    <input id="datatableSearch" type="search" class="form-control" placeholder="Rechercher une facture" aria-label="Rechercher une facture">
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
                    <th>Fournisseur</th>
                    <th>N° facture</th>
                    <th>Produit</th>
                    <th>Tva</th>
                    <th>Frais</th>
                    <th>Airsi</th>
                    <th>Timbre</th>
                    <th>Total TTC</th>
                    <th>Total à payer</th>
                    <th>Déjà payer</th>
                    <th>Facture</th>
                    <th>Bon</th>
                    <!-- <th>Action</th> -->
                    <th>N°</th>
                  </tr>
                </thead>

                <tbody>
                  @php $n=1; @endphp
                  @foreach($fournisseurfactures as $fournisseurfacture)
                    @php $a=$n; @endphp
                    <tr>
                      <td class="fw-bold">{{ $n++ }}</td>
                      <td class="fw-bold">{{ $fournisseurfacture->fournisseur->nom }}</td>
                      <td class="fw-bold">{{ $fournisseurfacture->numero_facture }}</td>
                      <td class="text-center">
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="{{ route('geststock.facture.fournisseur.detail', $fournisseurfacture) }}">
                              <i class="bi-eye me-1"></i> {{ $fournisseurfacture->fournisseurfactureprods->count() }}
                          </a>
                        </div>
                      </td>
                      <td class="fw-bold">{{ getpricefr($fournisseurfacture->tva) }}</td>
                      <td class="fw-bold">{{ getpricefr($fournisseurfacture->frais) }}</td>
                      <td class="fw-bold">{{ getpricefr($fournisseurfacture->airsi_montant) }}</td>
                      <td class="fw-bold">{{ getpricefr($fournisseurfacture->timbre_montant) }}</td>
                      <td class="fw-bold">{{ getpricefr($fournisseurfacture->total_ttc) }}</td>
                      <td class="fw-bold">{{ getpricefr($fournisseurfacture->tva + $fournisseurfacture->frais + $fournisseurfacture->airsi_montant + $fournisseurfacture->timbre_montant + $fournisseurfacture->total_ttc) }}</td>
                      <td class="fw-bold">{{ getpricefr($fournisseurfacture->versement) }}</td>
                      <td class="text-center">
                        @if($fournisseurfacture->facture)
                          <div class="btn-group" role="group">
                            <a class="btn btn-white btn-sm" target="_blank" href="{{ asset(Storage::url($fournisseurfacture->facture)) }}">
                              <i class="bi-eye me-1"></i> Voir
                            </a>
                          </div>
                        @else Null @endif
                      </td>
                      <td class="text-center">
                        @if($fournisseurfacture->bon)
                          <div class="btn-group" role="group">
                            <a class="btn btn-white btn-sm" target="_blank" href="{{ asset(Storage::url($fournisseurfacture->bon)) }}">
                              <i class="bi-eye me-1"></i> Voir
                            </a>
                          </div>
                        @else Null @endif
                      </td>
                      
                      <!-- @if(auth()->user()->role) -->
                        <!-- <td>
                          <div class="btn-group" role="group">
                            <a class="btn btn-white btn-sm" href="#">
                              Derouler
                            </a>

                            <div class="btn-group">
                              <button type="button" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="productsEditDrop{{ $fournisseurfacture->id }}down" data-bs-toggle="dropdown" aria-expanded="true"></button>

                              <div class="dropdown-menu dropdown-menu-top mt-1" aria-labelledby="productsEditDrop{{ $fournisseurfacture->id }}down">
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editFF{{ $fournisseurfacture->id }}">
                                  <i class="bi-pencil-fill me-1 dropdown-item-icon"></i>Modifier la facture
                                </a>
                                <a  class="dropdown-item" href="{{ route('geststock.fournisseur.facture.produit', $fournisseurfacture) }}">
                                  <i class="bi-pencil-fill me-1 dropdown-item-icon"></i>Modifier les produits
                                </a>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteFF{{ $fournisseurfacture->id }}">
                                  <i class="bi-trash dropdown-item-icon"></i>Supprimer la facture
                                </a>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#confirmeReceptionFF{{ $fournisseurfacture->id }}">
                                  <i class="bi-check dropdown-item-icon"></i>confirmer la reception
                                </a>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#confirmeConformiteFF{{ $fournisseurfacture->id }}">
                                  <i class="bi-check dropdown-item-icon"></i>confirmer la conformité
                                </a>
                              </div>
                            </div>
                          </div>
                        </td> -->
                      <!-- @endif -->
                      <td class="fw-bold">{{ $a }}</td>
                    </tr>

                    @include('include.geststock.fournisseur.fournisseurfacture')
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
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucune facture fournisseur établie, receptionné et conforme sur la plateforme</h3>
              </div>
              <!-- End Header -->
          @endif
      </div>
      <!-- End Card -->
    </div>
    <!-- End Content -->
     
  </main>



@endsection