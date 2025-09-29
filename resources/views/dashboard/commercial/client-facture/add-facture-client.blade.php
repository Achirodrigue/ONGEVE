@extends('dashboard.commercial.layout.app')
@section('body')

  @include('include.message.dashboard')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Ajouter une facture ou un devis pour un <span class="text-warning">Client</span></h1>
            <!-- <h4 class="page-header-title">Etape 1</h4> -->
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
         
        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
          <!-- Nav -->
          <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" href="#">Etape 1</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Etape 2</a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
      </div>
      <!-- End Page Header -->

      <form method="POST" action="{{ route('commercial.devis.client.store') }}" enctype="multipart/form-data">
        @csrf
          <div class="row">
            <div class="col-lg-8">
              <div class="card mb-3 mb-lg-5">
                <div class="card-header">
                  <h4 class="card-header-title">Information du client</h4>
                </div>

                <div class="card-body">

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="mb-4">
                        <label for="categoryLabel" class="form-label">Choix du particulier</label>
                        <div class="tom-select-custom">
                          <select id="client" onchange="toggleInput()" name="client" class="js-select form-select" autocomplete="off" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "placeholder": "Select category"
                                  }' required>
                            <option value="Nouveau">Nouveau client</option>
                            @if(clients()->count() > 0)
                              <option value="ChoisirClient">Choisir un client</option>
                            @endif
                          </select>
                        </div>
                      </div>
                    </div>

                    <div id="addClient" style="display: block;">
                      <div class="row">
                        <hr>
                        @include('dashboard.IncludePage.commun.client.add-client-facture')
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="card card-table" id="ChoisirClient" style="display: none;">
                  @if(clients()->count() > 0)
                    <!-- Header -->
                    <div class="card-header card-header-content-md-between">
                      <div class="mb-2 mb-md-0 w-100">
                          <!-- Search -->
                          <div class="input-group input-group-merge input-group-flush">
                            <div class="input-group-prepend input-group-text">
                              <i class="bi-search"></i>
                            </div>
                            <input id="datatableSearch" type="search" class="form-control" placeholder="Search users" aria-label="Search users">
                          </div>
                          <!-- End Search -->
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
                          "isResponsive": false,
                          "isShowPaging": false,
                          "pagination": "datatablePagination"
                        }'>
                        <thead class="thead-light">
                          <tr>
                            <th scope="col" class="table-column-pe-0">
                              Cocher
                            </th>
                            <th>Nom</th>
                            <th>Contact</th>
                            <th>Plafond d'achat (Fcfa)</th>
                          </tr>
                        </thead>

                        <tbody>
                          @foreach(clients() as $client)
                            <tr>
                              <td class="table-column-pe-0">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="clients" value="{{ $client->id }}" id="datatableCheckAll1" style="padding: 9px; border: 2px solid;">
                                </div>
                              </td>
                              <td class="fw-bold">{{ $client->nom }}</td>
                              <td class="fw-bold">{{ $client->contact }}</td>
                              <td class="fw-bold">{{ getprice($client->Pachat) }}</td>
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
                            <span class="me-2">Page:</span>

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
                        <h3 class="fw-bold mb-0 text-center">Désolé! Aucun client n'a été ajouté sur la plateforme</h3>
                      </div>
                      <!-- End Header -->
                  @endif
              </div>
            </div>

            <div class="col-lg-4 mb-3 mb-lg-0">
              <div class="card mb-3 mb-lg-5">
                <div class="card-header">
                  <h4 class="card-header-title">Information devis/facture </h4>
                </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="mb-4">
                        <label for="TD" class="form-label">Type de creation</label>
                        <div class="tom-select-custom">
                          <select name="DF" class="js-select form-select" autocomplete="off" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "placeholder": "Select category"
                                  }' required>
                            <option value="0">Devis</option>
                            <option value="1">Facture</option>
                          </select>
                          @error('DF') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-12">
                      <div class="mb-4">
                        <label for="apptva" class="form-label">TVA</label>
                        <div class="tom-select-custom">
                          <select id="apptva" name="apptva" class="js-select form-select" autocomplete="off" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "placeholder": "Select category"
                                  }' required>
                            <option value="1">Appliquer la TVA</option>
                            <option value="0">Suspendre la TVA</option>
                            @error('apptva') <span class="text-danger">{{ $message }}</span> @enderror
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="mb-4">
                        <label for="frais" class="form-label">Frais de livraison (facultatif)</label>
                        <input type="text" class="form-control" min="1" minlength="1" name="frais" value="{{ old('frais') }}" id="frais" placeholder="Entrer les frais de livraison">
                        @error('frais') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="mb-4">
                        <label for="delai_livraison" class="form-label">Délai de livraison (facultatif)</label>
                        <input type="text" class="form-control" name="delai_livraison" value="{{ old('delai_livraison') }}" id="delai_livraison" placeholder="Entrer un Délai de livraison">
                        @error('delai_livraison') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-12">
                      <div class="mb-4">
                        <label for="delai_paiement" class="form-label">Délai de paiement</label>
                        <div class="tom-select-custom">
                          <select id="delai_paiement" name="delai_paiement" class="js-select form-select" autocomplete="off" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "placeholder": "Select category"
                                  }' required>
                            @foreach(delaipays() as $delaipay)
                              <option value="{{ $delaipay->delaipay }}">{{ $delaipay->delaipay }}</option>
                            @endforeach
                            <option value="">Aucun</option>
                            @error('delai_paiement') <span class="text-danger">{{ $message }}</span> @enderror
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-12">
                      <div class="mb-4">
                        <label for="MP" class="form-label">Moyen de paiement</label>
                        <div class="tom-select-custom">
                          <select id="MP" name="MP" class="js-select form-select" autocomplete="off" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "placeholder": "Select category"
                                  }' required>
                            @foreach(moyenpays() as $moyenpay)
                              <option value="{{ $moyenpay->nom }}">{{ $moyenpay->nom }}</option>
                            @endforeach
                            <option value="">Aucun</option>
                            @error('MP') <span class="text-danger">{{ $message }}</span> @enderror
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="mb-4">
                        <label for="objet" class="form-label">Objet de facturation</label>
                        <input type="text" class="form-control" name="objet" value="{{ old('objet') }}" id="objet" placeholder="Entrer l'objet de facturation" required>
                        @error('objet') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-12">
                      <div class="mb-4">
                        <label for="TD" class="form-label">Type de devis</label>
                        <div class="tom-select-custom">
                          <select id="typeDev" onchange="typeDevis()" name="TD" class="js-select form-select" autocomplete="off" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "placeholder": "Select category"
                                  }' required>
                            <option value="0">Vente de produit</option>
                            <option value="1">Location de produit</option>
                            <option value="2">Prestation de service</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div id="devisLocation" style="display: none;">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="mb-4">
                          <label for="debut" class="form-label">Date de debut</label>
                          <input type="date" class="form-control" name="debut" value="{{ old('debut') }}" id="debut" placeholder="Entrer une date de debut">
                          @error('debut') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="mb-4">
                          <label for="fin" class="form-label">Date de fin</label>
                          <input type="date" class="form-control" name="fin" value="{{ old('fin') }}" id="fin" placeholder="Entrer une date de fin">
                          @error('fin') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="mb-4">
                          <label for="chantier" class="form-label">Chantier</label>
                          <input type="text" class="form-control" name="chantier" value="{{ old('chantier') }}" id="chantier" placeholder="Entrer Le chantier">
                          @error('chantier') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>

          <div class="position-fixed start-50 bottom-0 translate-middle-x w-100 zi-99 mb-3" style="max-width: 40rem;">
            <div class="card card-sm bg-dark border-dark mx-2">
              <div class="card-body">
                <div class="row justify-content-center justify-content-sm-between">
                  <div class="col">
                    <a href="{{ route('commercial.home') }}" class="btn btn-ghost-danger">Retour</a>
                  </div>

                  <div class="col-auto">
                    <div class="d-flex gap-3">
                      <!-- <button type="button" class="btn btn-ghost-light">Discard</button> -->
                      <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </form>

    </div>
    <!-- End Content -->

  </main>



@endsection