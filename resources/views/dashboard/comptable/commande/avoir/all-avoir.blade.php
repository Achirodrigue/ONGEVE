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
            <h1 class="page-header-title">Nombre de factures d'avoir pour la vente <span class="text-warning">{{ $clientdevis->numero_devis }}</span> <span class="badge bg-soft-dark text-dark ms-2">{{ $clientdevis->clientdevisavoirs->count() }}</span></h1>
          </div>

          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('comptable.commande.client.impaye') }}">
              <i class="bi-arrow-return-left me-1"></i> Retour
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
              <a class="nav-link" href="{{ route('comptable.commande.client.impaye') }}" tabindex="-1" aria-disabled="true" href="#">
                Les Factures
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active">
                Factures d'avoir de {{ $clientdevis->numero_devis }}
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
          @if($clientdevis->clientdevisavoirs->count() > 0)
            <!-- Header -->
            <div class="card-header card-header-content-md-between">
              <div class="mb-2 mb-md-0 w-100">
                <form>
                  <!-- Search -->
                  <div class="input-group input-group-merge input-group-flush">
                    <div class="input-group-prepend input-group-text">
                      <i class="bi-search"></i>
                    </div>
                    <input id="datatableSearch" type="search" class="form-control" placeholder="Search users" aria-label="Search users">
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
                    <th>N° facture avoir</th>
                    <th>Date</th>
                    <th>Tva</th>
                    <th>Total HT</th>
                    <th>Total à payer</th>
                    <th>Nombre produit</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($clientdevis->clientdevisavoirs as $clientdevisavoir)
                    <tr>
                      <td class="fw-bold">{{ $clientdevisavoir->numero_devis }}</td>
                      <td class="fw-bold">{{ $clientdevisavoir->created_at->format('d/m/Y H:i') }}</td>
                      <td class="fw-bold">{{ getprice($clientdevisavoir->tva) }}F</td>
                      <td class="fw-bold">{{ getprice($clientdevisavoir->total_ttc) }}F</td>
                      <td class="fw-bold">{{ getprice($clientdevisavoir->total_payer) }}F</td>
                      <td>
                        <div class="btn-group" role="group">
                          @if($clientdevis->TDF != 2)
                            <a class="btn btn-white btn-sm" @if($clientdevisavoir->clientdevisavoirprods->count() > 0) href="{{ route('comptable.commande.client.avoir.detail', $clientdevisavoir) }}" @else href="#" @endif>
                              <i class="bi-eye me-1"></i> {{ $clientdevisavoir->clientdevisavoirprods->count() }}
                            </a>
                          @else
                            <a class="btn btn-white btn-sm" @if($clientdevisavoir->clientdevisavoirprestations->count() > 0) href="{{ route('comptable.commande.client.avoir.detail', $clientdevisavoir) }}" @else href="#" @endif>
                              <i class="bi-eye me-1"></i> {{ $clientdevisavoir->clientdevisavoirprestations->count() }}
                            </a>
                          @endif
                        </div>
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#">
                            <!-- <i class="bi-pencil-fill me-1"></i> -->Action
                          </a>

                          <!-- Button Group -->
                          <div class="btn-group">
                            <button type="button" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="productsEditDrop{{ $clientdevis->id }}down" data-bs-toggle="dropdown" aria-expanded="true"></button>

                            <div class="dropdown-menu dropdown-menu-top mt-1" aria-labelledby="productsEditDrop{{ $clientdevis->id }}down">  
                              @if($clientdevisavoir->facturefneavoir) 
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#infoFneJsonComfirm{{ $clientdevisavoir->id }}">
                                  <i class="bi-eye me-1 dropdown-item-icon"></i> FNE json Confirm
                                </a>
                              @else
                                <a class="dropdown-item" href="{{ route('comptable.certifier.facture.avoir.fne', $clientdevisavoir) }}">
                                  <i class="bi-printer me-1 dropdown-item-icon"></i>FNE
                                </a>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteClientdevisAvoir{{ $clientdevisavoir->id }}">
                                  <i class="bi-trash me-1 dropdown-item-icon"></i> Supprimer
                                </a>
                              @endif
                              <!-- <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editClientdevisAvoir{{ $clientdevisavoir->id }}">
                                <i class="bi-pencil-fill me-1 dropdown-item-icon"></i>Modifier
                              </a> -->
                              <a class="dropdown-item" href="{{ route('pdf.avoir', $clientdevisavoir) }}" target="_blank">
                                <i class="bi-file-earmark-arrow-down me-1 dropdown-item-icon"></i> PDF
                              </a>
                            </div>
                          </div>
                          <!-- End Button Group -->
                        </div>
                      </td>
                    </tr>

                    @include('include.comptable.facture-avoir')
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
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucune facture d'avoir pour la facture de vente <span class="text-warning">{{ $clientdevis->numero_devis }}</span></h3>
              </div>
              <!-- End Header -->
          @endif
      </div>
      <!-- End Card -->
    </div>
    <!-- End Content -->
     
  </main>



@endsection