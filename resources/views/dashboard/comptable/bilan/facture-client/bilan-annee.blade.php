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
            <h1 class="page-header-title">Bilans annuels des factures client sur la plateforme <span class="badge bg-soft-dark text-dark ms-2">{{ $clientdevis->count() }}</span></h1>
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
              <a class="nav-link" href="{{ route('comptable.bilan.semaine.facture.client') }}" tabindex="-1" aria-disabled="true">Bilans mensuels</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('comptable.bilan.mois.facture.client') }}" tabindex="-1" aria-disabled="true">Bilans par mois</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('comptable.bilan.trimestre.facture.client') }}" tabindex="-1" aria-disabled="true">Bilans trimestriels</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Bilans annuels</a>
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
                    <input id="datatableSearch" type="search" class="form-control" placeholder="Rechercher une periode" aria-label="Rechercher une facture">
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
                    <th>Année</th>
                    <th>Montan HT</th>
                    <th>TVA</th>
                    <th>AIRSI</th>
                    <th>Timbre</th>
                    <th>Frais</th>
                    <th>Total à payer</th>
                    <th>Déjà verser</th>
                    <th>Reste à payer</th>
                    <th class="text-center">Nombre de facture</th>
                  </tr>
                </thead>

                <tbody>
                  @php $n = 1; @endphp
                  @foreach ($clientdevis as $periode => $factures)
                    @php 
                      $montantHT = 0;
                      $tva = 0;
                      $airsiMontant = 0;
                      $timbreMontant = 0;
                      $frais = 0;
                      $versement = 0;
                      $totalPayer = 0;
                      $restePayer = 0;
                      if($factures->count() > 0)
                      {
                          foreach($factures as $devisclient)
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
                      <td class="fw-bold">{{ $n++ }}</td>
                      <td class="fw-bold">{{ $periode }}</td>
                      <td class="fw-bold">{{ getpricefr($montantHT) }}</td>
                      <td class="fw-bold">{{ getpricefr($tva) }}</td>
                      <td class="fw-bold">{{ getpricefr($airsiMontant) }}</td>
                      <td class="fw-bold">{{ getpricefr($timbreMontant) }}</td>
                      <td class="fw-bold">{{ getpricefr($frais) }}</td>
                      <td class="fw-bold">{{ getpricefr($totalPayer) }}</td>
                      <td class="fw-bold">{{ getpricefr($versement) }}</td>
                      <td class="fw-bold">{{ getpricefr($restePayer) }}</td>
                      <td class="text-center">
                        <div class="btn-group" role="group">
                          @php
                              // On transforme la collection en chaîne séparée par des virgules
                              $ids = $factures->pluck('id')->implode(',');
                          @endphp
                          <a class="btn btn-white btn-sm" 
                            @if($factures->count() > 0) 
                                href="{{ route('comptable.bilan.periode.facture.client', ['ids' => $ids, 'periode' => $periode, 'type' => 3]) }}" 
                            @else 
                                href="#" 
                            @endif>
                              <i class="bi-eye me-1"></i> {{ $factures->count() }}
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
            <div class="card-footer">
              <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                <div class="col-sm mb-2 mb-sm-0">
                  <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                    <span class="me-2">Pagination:</span>

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
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucune facture client sur la plateforme</h3>
              </div>
              <!-- End Header -->
          @endif
      </div>
      <!-- End Card -->
    </div>
    <!-- End Content -->
     
  </main>



@endsection