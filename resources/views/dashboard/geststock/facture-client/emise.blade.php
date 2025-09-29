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
            <h1 class="page-header-title">Nombre de factures client en attente de traitement <span class="badge bg-soft-dark text-dark ms-2">{{ $clientdevis->count() }}</span></h1>
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
              <a class="nav-link active" href="#">
                Factures émises
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('geststock.facture.encours.livraison') }}" tabindex="-1" aria-disabled="true">
                Factures en cours de livraison
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('geststock.facture.livre') }}" tabindex="-1" aria-disabled="true">
                Factures livrées
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
          @if($clientdevis->count() > 0)
            <!-- Header -->
            <div class="card-header card-header-content-md-between">
              <div class="mb-2 mb-md-0 w-100">
                <form>
                  <!-- Search -->
                  <div class="input-group input-group-merge input-group-flush">
                    <div class="input-group-prepend input-group-text">
                      <i class="bi-search"></i>
                    </div>
                    <input id="datatableSearch" type="search" class="form-control" placeholder="Rechercher une facture" aria-label="Search users">
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
                    <th>Type de facture</th>
                    <th>N° facture</th>
                    <th>Date</th>
                    <th>Nom</th>
                    <th>Tva</th>
                    <th>Frais</th>
                    <th>Total à payer</th>
                    <th>Déjà payer</th>
                    <th>Détails</th>
                    <th>Bon commande</th>
                    <th>Infos facture</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($clientdevis as $clientdevis)
                    <tr>
                    <td>
                      <div class="btn-group" role="group">
                        <a class="btn @if($clientdevis->TD) btn-warning @else btn-danger @endif btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#deleteClientDevis{{ $clientdevis->id }}">
                          @if($clientdevis->TD) Prestation @else Vente @endif
                        </a>
                      </div>
                    </td>
                      <td class="fw-bold">{{ $clientdevis->numero_devis }}</td>
                      <td class="fw-bold">{{ $clientdevis->created_at->format('d/m/Y H:i') }}</td>
                      <td class="fw-bold">{{ $clientdevis->client->nom }}</td>
                      <td class="fw-bold">{{ getprice($clientdevis->tva) }}F</td>
                      <td class="fw-bold">{{ getprice($clientdevis->frais) }}F</td>
                      <td class="fw-bold">{{ getprice($clientdevis->total_payer) }}F</td>
                      <td class="fw-bold">{{ getprice($clientdevis->versement) }}F</td>
                      <td class="text-center">
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#infoClientdevis{{ $clientdevis->id }}">
                              <i class="bi-eye me-1"></i>
                          </a>
                        </div>
                      </td>
                      <td class="text-center fw-bold">
                        @if($clientdevis->clientdevisbon)
                          <div class="btn-group" role="group">
                              <a class="btn btn-white btn-sm" target="_blank" href="{{ asset(Storage::url($clientdevis->clientdevisbon->bon)) }}">
                                <i class="bi-eye me-1"></i> Voir
                              </a>
                          </div>
                        @else
                          Aucun
                        @endif
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="{{ route('geststock.facture.client.detail', $clientdevis) }}">
                            <i class="bi-printer me-1"></i> Details
                          </a>
                        </div>
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="{{ route('commun.facture.transfert.magasinier', $clientdevis) }}">
                            <i class="bi-pencil-fill me-1"></i>Transfert magasinier
                          </a>
                        </div>
                      </td>
                    </tr>

                    @include('include.comptable.commande-client')
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
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucune facture client en attente de traitement émise sur la plateforme</h3>
              </div>
              <!-- End Header -->
          @endif
      </div>
      <!-- End Card -->
    </div>
    <!-- End Content -->
     
  </main>



@endsection