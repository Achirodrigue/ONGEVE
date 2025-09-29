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
            <h1 class="page-header-title">Commandes impayé du client <span class="badge bg-soft-dark text-dark ms-2">{{ $client->nom }}</span></h1>
          </div>

          <div class="col-auto">
            @if($client->clientdevis->count() > 0)
              <a class="btn btn-primary" href="{{ route('comptable.client.facture.individuel.export', ['client' => $client->id, 'statut' => 0]) }}">
                <img class="avatar avatar-xss avatar-4x3 me-2" src="{{ asset("dashboard/assets/svg/brands/excel-icon.svg") }}" alt="Image Description">
                format excel
              </a>
            @endif
            
            <a class="btn btn-primary" href="{{ route('comptable.client.index') }}">
              <i class="bi-arrow-return-left me-1"></i> Retour
            </a>
          </div>
          <!-- End Col -->
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
                Factures Impayées
                <span class="badge bg-soft-dark text-dark rounded-pill ms-1">{{ CFI($client) }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('comptable.client.commande.partielle', $client) }}" tabindex="-1" aria-disabled="true">
                Factures Partielle
                <span class="badge bg-soft-dark text-dark rounded-pill ms-1">{{ CAPT($client) }} / {{ CFPT($client) }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('comptable.client.commande.paye', $client) }}" tabindex="-1" aria-disabled="true">
                Factures Finalisées
                <span class="badge bg-soft-dark text-dark rounded-pill ms-1">{{ CAPY($client) }} / {{ CFPY($client) }}</span>
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
                    <th>N°</th>
                    <th>Type facture</th>
                    <th>N° facture</th>
                    <th>Date</th>
                    <th>Tva</th>
                    <th>Frais</th>
                    <th>Total à payer</th>
                    <th>Déjà payer</th>
                    <th>Plus d'infos</th>
                    <th>Bon commande</th>
                    <th>Infos facture</th>
                    <th>Transaction</th>
                    <th>Action</th>
                    <th>N°</th>
                  </tr>
                </thead>

                <tbody>
                  @php $n=1; @endphp
                  @foreach($clientdevis as $clientdevis)
                    @php $a=$n; @endphp
                    <tr>
                      <td class="fw-bold">{{ $n++ }}</td>
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn @if($clientdevis->TDF == null) btn-secondary @elseif($clientdevis->TDF == 1) btn-warning @else btn-danger @endif btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#deleteClientDevis{{ $clientdevis->id }}">
                            @if($clientdevis->TDF == null) Vente @elseif($clientdevis->TDF == 1) Location @else Prestation @endif
                          </a>
                        </div>
                      </td>
                      <td class="fw-bold">{{ $clientdevis->numero_devis }}</td>
                      <td class="fw-bold">{{ $clientdevis->created_at->format('d/m/Y H:i') }}</td>
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
                      <td class="text-center">
                        <div class="btn-group" role="group">
                          @if($clientdevis->clientdevisbon)
                            <a class="btn btn-white btn-sm" target="_blank" href="{{ asset(Storage::url($clientdevis->clientdevisbon->bon)) }}">
                              <i class="bi-eye me-1"></i> Voir
                            </a>
                          @else
                            <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#adddevisbon{{ $clientdevis->id }}">
                              <i class="bi-printer me-1"></i> Associer
                            </a>
                          @endif
                        </div>
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
                      <td>
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#">
                            <!-- <i class="bi-pencil-fill me-1"></i> -->Action
                          </a>

                          <!-- Button Group -->
                          <div class="btn-group">
                            <button type="button" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="productsEditDrop{{ $clientdevis->id }}down" data-bs-toggle="dropdown" aria-expanded="true"></button>

                            <div class="dropdown-menu dropdown-menu-top mt-1" aria-labelledby="productsEditDrop{{ $clientdevis->id }}down">                
                              @php 
                                $produit = null;
                                $prestation = null;
                                if($clientdevis->TDF != 2) { if($clientdevis->clientdevisprods->count() > 0) { $produit = 1; } }
                                else { if($clientdevis->clientdevisprestations->count() > 0) { $prestation = 1; } }
                              @endphp

                              @if($produit || $prestation)        
                                  @if($clientdevis->facturefne) 
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#infoFneJsonComfirm{{ $clientdevis->id }}">
                                      <i class="bi-eye me-1 dropdown-item-icon"></i> FNE json Confirm
                                    </a>
                                  @else 
                                    <a class="dropdown-item" href="{{ route('comptable.certifier.facture.fne', $clientdevis) }}">
                                      <i class="bi-printer me-1 dropdown-item-icon"></i>FNE
                                    </a>  
                                  @endif
                              @endif
                              <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addtransactioncommande{{ $clientdevis->id }}">
                                <i class="bi-printer me-1 dropdown-item-icon"></i>Add Transaction
                              </a>
                              <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editclientdevis{{ $clientdevis->id }}">
                                <i class="bi-pencil-fill me-1 dropdown-item-icon"></i>Modifier facture
                              </a>
                              <a  class="dropdown-item"
                                  @if($clientdevis->TDF == 2)
                                    href="{{ route('comptable.facture.client.create.prestation', $clientdevis) }}">
                                  @else
                                    href="{{ route('comptable.facture.client.create.deux', $clientdevis) }}">
                                  @endif
                                <i class="bi-pencil-fill me-1 dropdown-item-icon"></i>Modifier les @if($clientdevis->TDF == 2) prestations @else produits @endif
                              </a>
                              <a class="dropdown-item" href="{{ route('comptable.commande.client.avoir', $clientdevis) }}">
                                <i class="bi-printer me-1 dropdown-item-icon"></i>Etablir facture d'avoir
                              </a>
                              @if($clientdevis->clientdevisavoirs->count() > 0)
                                <a class="dropdown-item" href="{{ route('comptable.commande.client.all.avoir', $clientdevis) }}">
                                  <i class="bi-eye me-1 dropdown-item-icon"></i>Voir les factures d'avoir
                                </a>
                              @endif
                              
                              <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteclientdevis{{ $clientdevis->id }}">
                                <i class="bi-trash dropdown-item-icon"></i>Supprimer la facture
                              </a>
                            </div>
                          </div>
                          <!-- End Button Group -->
                        </div>
                      </td>
                      <td class="fw-bold">{{ $a }}</td>
                    </tr>

                    @include('include.comptable.commande-client')
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
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucune commande impayé pour ce client sur la plateforme</h3>
              </div>
              <!-- End Header -->
          @endif
      </div>
      <!-- End Card -->
    </div>
    <!-- End Content -->
     
  </main>



@endsection