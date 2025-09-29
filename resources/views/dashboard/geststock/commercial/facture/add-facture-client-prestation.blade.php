@extends('dashboard.geststock.layout.app')
@section('body')


  @include('include.message.dashboard')
  @include('include.CG.clientdevis')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-md-6">
            <div class="row">
              <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title">
                  Ajout de prestation de service dans @if($clientdevis->clientdevisinfo->isvalide) la facture @else le devis @endif de 
                </h1>
                <h3>
                  <span class="badge bg-soft-dark text-dark">{{ $clientdevis->client->nom }}</span>
                </h3> 
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="row justify-content-end">
              <div class="col-auto mb-2">
                <a class="btn btn-white mb-2" href="#" data-bs-toggle="modal" data-bs-target="#devisPrestationAdd{{ $clientdevis->id }}"">
                  <i class="bi-person-plus-fill me-1"></i> Ajouter une prestation
                </a>
                @if($clientdevis->clientdevisprestations()->count() > 0)
                  <a class="btn btn-white mb-2" target="_blank" href="{{ route('pdf.devis.commande.client', $clientdevis) }}">
                    <i class="bi-file-earmark-arrow-down me-1"></i> PDF
                  </a>
                  <a class="btn btn-white mb-2" href="{{ route('geststock.facture.client.detail', $clientdevis) }}">
                    <i class="bi-printer me-1"></i> Finalité
                  </a>
                @endif
                <a class="btn btn-white mb-2" href="{{ route('geststock.commercial.facture.client.etablie.general') }}">
                  <i class="bi-eye me-1"></i> Factures établies
                </a>
                @if(!$clientdevis->clientdevisinfo->isvalide)
                  <a class="btn btn-white mb-2" href="#" data-bs-toggle="modal" data-bs-target="#editclientdevis{{ $clientdevis->id }}">
                    <i class="bi-pencil-fill me-1"></i> Modifier
                  </a>
                @endif
              </div>
            </div>
          </div>
        </div>
        <!-- End Row -->

        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
          <!-- Nav -->
          <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Etape 1</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Etape 2</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('commun.client.devis.survole.plafond.achat', $clientdevis) }}">
                Plafond @if($clientdevis->survolepf) Désactivé @else Activé @endif
              </a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>

      </div>
      <!-- End Page Header -->

      <!-- Card -->
      <div class="card card-table mb-3">
          @if($clientdevis->clientdevisprestations()->count() > 0)
            <!-- Table -->
            <div class="table-responsive datatable-custom">
              <table class="table table-bordered table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table" style="width: 100%" data-hs-datatables-options='{
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
                 }'
                >
                <thead class="thead-light">
                  <tr>
                    <th colspan="5" scope="col" class="fw-bold text-black">Inventaire du Total à payer (Fcfa)</th>
                    <th scope="col" class="fw-bold text-black">{{ getprice($clientdevis->total_ttc) }}</th>
                  </tr>
                  <tr>
                    <th>Désignation</th>
                    <th>Unité</th>
                    <th>Nombre de passage</th>
                    <!-- <th>Quantité</th> -->
                    <th>Prix unitaire (Fcfa)</th>
                    <th>Prix Total (Fcfa)</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($clientdevis->clientdevisprestations as $clientdevisprestation)
                    <tr>
                      <td>
                        <h5 class="text-inherit mb-0">{{ $clientdevisprestation->designation }}</h5>
                      </td>
                      <td class="text-warning">@if($clientdevisprestation->unite) {{ $clientdevisprestation->unite }} @else Aucune @endif</td>
                      <td class="text-warning">{{ $clientdevisprestation->nbre_passage }}</td>
                      <!-- <td class="text-warning">{{ $clientdevisprestation->quantite }}</td> -->
                      <td class="fw-bold">{{ getprice($clientdevisprestation->prix_unitaire) }}</td>
                      <td class="fw-bold">{{ getprice($clientdevisprestation->prix_total) }}</td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#devisPrestationUpdate{{ $clientdevisprestation->id }}">
                            <i class="bi-pencil-fill me-1"></i>
                          </a>
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#devisPrestationDelete{{ $clientdevisprestation->id }}">
                            <i class="bi-trash dropdown-item-icon"></i>
                          </a>
                        </div>
                      </td>
                    </tr>

                    @include('include.CG.clientdevisprestation')
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- End Table -->
          @else
              <!-- Header -->
              <div class="card-header card-header-content-md-between p-4">
                <h4 class="fw-bold mb-0 text-center">Désolé! Aucune prestation de service n'a été associé à cette facture</h4>
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