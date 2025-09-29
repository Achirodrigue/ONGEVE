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
            <h1 class="page-header-title">Chiffres d'affaire des factures clients</h1>
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
              <a class="nav-link" href="{{ route('comptable.chiffre.affaire.client.paye') }}" tabindex="-1" aria-disabled="true">
                Factures Soldées
                <span class="badge bg-soft-dark text-dark rounded-pill ms-1">{{ CAPYG() }} / {{ CFPYG() }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('comptable.chiffre.affaire.client.partielle') }}" tabindex="-1" aria-disabled="true">
                Factures Partielle
                <span class="badge bg-soft-dark text-dark rounded-pill ms-1">{{ CAPTG() }} / {{ CFPTG() }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('comptable.chiffre.affaire.client.impaye') }}" tabindex="-1" aria-disabled="true" href="#">
                Factures Impayées
                <span class="badge bg-soft-dark text-dark rounded-pill ms-1">{{ CFIG() }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active">
                Chiffres d'affaires des soldes
              </a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
      </div>
      <!-- End Page Header -->

      <div class="card mb-5 card-table">
          <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
              <div class="col-md">
                <div class="d-flex justify-content-between align-items-center">
                  <h4 class="card-header-title">Factures générales</h4>
                </div>
              </div>
            </div>
          </div>

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

      <div class="card mb-5 card-table">
          <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
              <div class="col-md">
                <div class="d-flex justify-content-between align-items-center">
                  <h4 class="card-header-title">Factures soldées</h4>
                </div>
              </div>
            </div>
          </div>

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
                    if($clientdevispayes->count() > 0)
                    {
                        foreach($clientdevispayes as $devisclient)
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

      <div class="card mb-5 card-table">
          <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
              <div class="col-md">
                <div class="d-flex justify-content-between align-items-center">
                  <h4 class="card-header-title">Factures Partiellent payées</h4>
                </div>
              </div>
            </div>
          </div>

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
                    if($clientdevispartielles->count() > 0)
                    {
                        foreach($clientdevispartielles as $devisclient)
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

      <div class="card card-table">
          <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
              <div class="col-md">
                <div class="d-flex justify-content-between align-items-center">
                  <h4 class="card-header-title">Factures impayées</h4>
                </div>
              </div>
            </div>
          </div>

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
                    if($clientdevisimpayes->count() > 0)
                    {
                        foreach($clientdevisimpayes as $devisclient)
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

    </div>
    <!-- End Content -->
     
  </main>



@endsection