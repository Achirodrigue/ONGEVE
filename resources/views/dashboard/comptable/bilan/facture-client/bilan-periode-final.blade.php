@extends('dashboard.comptable.layout.app')
@section('body')


  @include('include.message.dashboard')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">
              Bilans des factures client 
              @if($startDate && !$endDate)
                  du {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}
              @elseif($startDate && $endDate)
                  du {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
              @endif
              @if($type !== 'all')
                  - Type : {{ ucfirst($type) }}
              @endif
              <span class="badge bg-soft-dark text-dark ms-2">{{ $clientdevis->count() }}</span>
            </h1>
            <!-- <h3 class="page-header-title"><span class="text-danger"></span></h3> -->
          </div>

          <div class="col-auto">
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#choixPeriodeBilanFacture">
              <i class="bi-person-plus-fill me-1"></i> choisir une période
            </a>
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
                Bilan des factures par période
              </a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
      </div>
      <!-- End Page Header -->

      <!-- Card -->
      @if($clientdevis->count() > 0)
        <div class="card card-table mb-5">
            <!-- Header -->
            <div class="card-header card-header-content-md-between">
              <h4 class="card-header-title">Bilan des ventes</h4>
            </div>
            <!-- End Header -->

            <div class="table-responsive datatable-custom">
              <table id="datatables" class="table table-bordered table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table" style="width: 100%" data-hs-datatables-options='{
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
                <thead style="background: #fccf7d">
                  <tr>
                    <th>Montan HT</th>
                    <th>TVA</th>
                    <th>AIRSI</th>
                    <th>Timbre</th>
                    <th>Frais</th>
                    <th>Total à payer</th>
                    <th>Déjà verser</th>
                    <th>Reste à payer</th>
                  </tr>
                </thead>

                <tbody>
                    @php 
                      $montantHT = 0;
                      $tva = 0;
                      $airsiMontant = 0;
                      $timbreMontant = 0;
                      $frais = 0;
                      $versement = 0;
                      $totalPayer = 0;
                      $restePayer = 0;
                      if($clientdevis->count() > 0)
                      {
                          foreach($clientdevis as $devisclient)
                          {
                              // dd($factures->total_ttc);
                              $montantHT += $devisclient->total_ttc;
                              $tva += $devisclient->tva ;
                              $airsiMontant += $devisclient->airsi_montant ;
                              $timbreMontant += $devisclient->timbre_montant ;
                              $frais += $devisclient->frais ;
                              $versement += $devisclient->versement ;
                              $totalPayer += $devisclient->total_payer ;
                          }

                          $restePayer = $totalPayer - $versement ;
                      }
                    @endphp
                    <tr>
                      <td class="fw-bold">{{ getpricefr($montantHT) }}</td>
                      <td class="fw-bold">{{ getpricefr($tva) }}</td>
                      <td class="fw-bold">{{ getpricefr($airsiMontant) }}</td>
                      <td class="fw-bold">{{ getpricefr($timbreMontant) }}</td>
                      <td class="fw-bold">{{ getpricefr($frais) }}</td>
                      <td class="fw-bold">{{ getpricefr($totalPayer) }}</td>
                      <td class="fw-bold">{{ getpricefr($versement) }}</td>
                      <td class="fw-bold">{{ getpricefr($restePayer) }}</td>
                    </tr>
                </tbody>
              </table>
            </div>
        </div>
      @endif  

      <div class="card card-table mb-5">
          <!-- Header -->
          <div class="card-header card-header-content-md-between">
            <h4 class="card-header-title">Factures
              @if($startDate && !$endDate)
                  du {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}
              @elseif($startDate && $endDate)
                  du {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
              @endif
            </h4>
          </div>
          <!-- End Header -->

          @php $n = 1; @endphp
          @if($clientdevis->count() > 0)
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
                    <th>Etat</th>
                    <th>N° facture</th>
                    <th>Date</th>
                    <th>Nom</th>
                    <th>Tva</th>
                    <th>Frais</th>
                    <th>Total à payer</th>
                    <th>Déjà payer</th>
                    <th>Bon commande</th>
                    <th>Infos facture</th>
                    <th>Transaction</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($clientdevis as $clientdevis)
                    <tr>
                      <td class="text-center">
                        <div class="btn-group" role="group">
                          <a class="btn btn-sm
                              @if($clientdevis->statut == null || $clientdevis->statut == 2) btn-danger @else btn-success @endif
                            ">
                            @if($clientdevis->statut == null) Impayé @elseif($clientdevis->statut == 2) Partielle @else Finalisé @endif
                          </a>
                        </div>
                      </td>
                      <td class="fw-bold">{{ $clientdevis->numero_devis }}</td>
                      <td class="fw-bold">{{ $clientdevis->created_at->format('d/m/Y H:i') }}</td>
                      <td class="fw-bold">{{ $clientdevis->client->nom }}</td>
                      <td class="fw-bold">{{ getprice($clientdevis->tva) }}F</td>
                      <td class="text-center fw-bold">
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="{{ route('comptable.client.devis.frais.detail', $clientdevis) }}">
                              <i class="bi-eye me-1"></i> {{ getpricefr($clientdevis->frais) }}
                          </a>
                        </div>
                      </td>
                      <td class="fw-bold">{{ getpricefr($clientdevis->total_payer) }}</td>
                      <td class="fw-bold">{{ getprice($clientdevis->versement) }}F</td>
                      <td class="text-center fw-bold">
                        @if($clientdevis->clientdevisbon)
                          <div class="btn-group" role="group">
                            <a class="btn btn-white btn-sm" target="_blank" href="{{ asset(Storage::url($clientdevis->clientdevisbon->bon)) }}">
                              <i class="bi-eye me-1"></i> Voir
                            </a>
                          </div>
                        @else Aucun @endif
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="{{ route('comptable.commande.client.detail', $clientdevis) }}">
                            <i class="bi-printer me-1"></i> Details
                          </a>
                        </div>
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" @if($clientdevis->Clientdevistransactions->count() > 0) href="{{ route('comptable.commande.client.versement', $clientdevis) }}" @else href="#" @endif>
                            <i class="bi-eye me-1"></i> {{ $clientdevis->Clientdevistransactions->count() }}
                          </a>
                        </div>
                      </td>
                    </tr>
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
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucune facture disponible pour cette periode sur la plateforme</h3>
              </div>
              <!-- End Header -->
          @endif   
      </div>
      <!-- End Card -->
    </div>
    <!-- End Content -->
     
  </main>



@endsection