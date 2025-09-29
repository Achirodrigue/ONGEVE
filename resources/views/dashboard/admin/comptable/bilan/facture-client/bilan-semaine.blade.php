@extends('dashboard.admin.layout.app')
@section('body')


  @include('include.message.dashboard')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Bilans par semaine des factures client sur la plateforme <span class="badge bg-soft-dark text-dark ms-2">{{ $clientdevis->count() }}</span></h1>
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
              <a class="nav-link active" href="#">Bilans mensuels</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.bilan.mois.facture.client') }}" tabindex="-1" aria-disabled="true">Bilans par mois</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.bilan.trimestre.facture.client') }}" tabindex="-1" aria-disabled="true">Bilans trimestriels</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.bilan.annee.facture.client') }}" tabindex="-1" aria-disabled="true">Bilans annuels</a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
      </div>
      <!-- End Page Header -->

      <!-- Card -->
      @if($clientdevis->count() > 0)
        @php $n = 1; @endphp
        @foreach ($clientdevis as $semaine => $factures)
          <div class="card card-table mb-5">
              <!-- Header -->
              <div class="card-header card-header-content-md-between">
                <h4 class="card-header-title">{{ $semaine }}</h4>
              </div>
              <!-- End Header -->

              @if($factures->count() > 0)
                <div class="card-header card-header-content-md-between">
                  <div class="mb-2 mb-md-0 w-100">
                    <form>
                      <!-- Search -->
                      <div class="input-group input-group-merge input-group-flush">
                        <div class="input-group-prepend input-group-text">
                          <i class="bi-search"></i>
                        </div>
                        <input id="datatable{{$n}}Search" type="search" class="form-control" placeholder="Rechercher une facture" aria-label="Search users">
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
                        "totalQty": "#datatable{{$n}}WithPaginationInfoTotalQty"
                      },
                      "search": "#datatable{{$n}}Search",
                      "entries": "#datatable{{$n}}Entries",
                      "pageLength": 12,
                      "isResponsive": false,
                      "isShowPaging": false,
                      "pagination": "datatable{{$n}}Pagination"
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
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      @forelse($factures as $clientdevis)
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
                          <td class="fw-bold">{{ getprice($clientdevis->frais) }}F</td>
                          <td class="fw-bold">{{ getprice($clientdevis->total_payer) }}F</td>
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
                              <a class="btn btn-white btn-sm" href="{{ route('admin.commande.client.detail', $clientdevis) }}">
                                <i class="bi-printer me-1"></i> Details
                              </a>
                            </div>
                          </td>
                          <td>
                            <div class="btn-group" role="group">
                              <a class="btn btn-white btn-sm" @if($clientdevis->Clientdevistransactions->count() > 0) href="{{ route('admin.commande.client.versement', $clientdevis) }}" @else href="#" @endif>
                                <i class="bi-eye me-1"></i> {{ $clientdevis->Clientdevistransactions->count() }}
                              </a>
                            </div>
                          </td>
                        </tr>
                      @empty
                          <tr><td colspan="3">Aucune facture</td></tr>
                      @endforelse
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
                          <select id="datatable{{$n}}Entries" class="js-select form-select form-select-borderless w-auto" autocomplete="off" data-hs-tom-select-options='{
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
                        <span id="datatable{{$n}}WithPaginationInfoTotalQty"></span>
                      </div>
                    </div>
                    <!-- End Col -->

                    <div class="col-sm-auto">
                      <div class="d-flex justify-content-center justify-content-sm-end">
                        <!-- Pagination -->
                        <nav id="datatable{{$n}}Pagination" aria-label="Activity pagination"></nav>
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
                    <h5 class="fw-bold mb-0 text-center">Désolé! Aucune facture disponible pour cette semaine sur la plateforme</h5>
                  </div>
                  <!-- End Header -->
              @endif   
          </div>
          @php $n++; @endphp
        @endforeach
      @else
          <!-- Header -->
          <div class="card-header card-header-content-md-between p-4">
            <h3 class="fw-bold mb-0 text-center">Désolé! Aucune facture disponible sur la plateforme</h3>
          </div>
          <!-- End Header -->
      @endif
      <!-- End Card -->
    </div>
    <!-- End Content -->
     
  </main>



@endsection