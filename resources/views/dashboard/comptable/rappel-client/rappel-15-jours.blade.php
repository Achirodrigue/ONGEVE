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
            <h1 class="page-header-title">Les différents clients non commandé depuis 15 jours <span class="badge bg-soft-dark text-dark ms-2">{{ $clients->count() }}</span></h1>
          </div>
           
          <div class="col-auto">
            <a class="btn btn-primary" href="#">
              <i class="bi-person-plus-fill me-1"></i> Rappel Client
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
              <a class="nav-link active" href="#">Clients depuis 15 jours</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('comptable.client.rappel.vente.mois') }}" tabindex="-1" aria-disabled="true">
                Clients depuis 1 mois
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
          @if($clients->count() > 0)
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
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatablePagination"
                 }'>
                <thead class="thead-light">
                  <tr>
                    <th>Nom</th>
                    <th>email</th>
                    <th>Contact</th>
                    <th>Plafond d'achat (Fcfa)</th>
                    <th>Adresse postale</th>
                    <th>Infos client</th>
                    <th>Commande client</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($clients as $client)
                    <tr>
                      <td class="fw-bold">{{ $client->nom }}</td>
                      <td class="fw-bold">{{ $client->email }}</td>
                      <td class="fw-bold">{{ $client->contact }}</td>
                      <td class="fw-bold">{{ getprice($client->Pachat) }}</td>
                      <td class="fw-bold">{{ $client->adresse_postale }}</td>                
                      <!-- <td class="fw-bold">{{ auth()->user()->nom }}</td>                 -->
                      <td class="text-center">
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#infoClient{{ $client->id }}">
                              <i class="bi-eye me-1"></i>
                          </a>
                        </div>
                      </td>
                      <td class="text-center">
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" @if($client->clientdevis->count()) href="{{ route('comptable.client.commande.impaye', $client) }}" @else href="#" @endif>
                              <i class="bi-eye me-1"></i> {{ $client->clientdevis->count() }}
                          </a>
                        </div>
                      </td>
                    </tr>
                    @include('include.client')
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

                    <span class="text-secondary me-2">de</span>

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
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucun client  n'a de facture incommandé depuis 15 jours</h3>
              </div>
              <!-- End Header -->
          @endif
      </div>
      <!-- End Card -->
    </div>
    <!-- End Content -->

  </main>
  <!-- ========== END MAIN CONTENT ========== -->

  <!-- Modal -->
  <div class="modal fade" id="addClient" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="createAKIKeyModalLabel">Ajouter un nouveau client</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- End Header -->

        <form method="post" action="{{ route('comptable.client.store') }}" enctype="multipart/form-data">
        @csrf
          <!-- Body -->
          <div class="modal-body">
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Nom</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="nom" class="visually-hidden form-label">Nom</label>
                <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" id="nom" placeholder="Entrer un nom" aria-label="Entrer un nom" required>
                @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-people nav-icon"></i>
                  <div class="flex-grow-1">Prénom</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="prenom" class="visually-hidden form-label">Prénom</label>
                <input type="text" name="prenom" value="{{ old('prenom') }}" class="form-control" id="nom" placeholder="Entrer un prenom" aria-label="Entrer un prenom" required>
                @error('prenom') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Genre</div>
                </div>
              </div>
              <div class="col-sm">
                <div class="tom-select-custom">
                  <select name="genre" required class="js-select form-select w-auto" autocomplete="off" id="eventColorLabel" data-hs-tom-select-options='{
                            "searchInDropdown": false,
                            "placeholder": "Select event color"
                          }'>
                    <option value="Homme" data-option-template='<span class="d-flex align-items-center">Select event color</span>'>Homme</option>
                    <option value="Femme" data-option-template='<span class="d-flex align-items-center"><span class="legend-indicator bg-primary me-2"></span>HS Team</span>'>Femme</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-calendar-event nav-icon"></i>
                  <div class="flex-grow-1">Date de naissance</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="naissance" class="visually-hidden form-label">Date de naissance</label>
                <input type="date" name="naissance" value="{{ old('naissance') }}" required id="naissance" class="flatpickr-custom form-control mb-2" placeholder="Entrer une date de naissance" data-hs-flatpickr-options='{
                        "dateFormat": "m/d/Y",
                        "mode": "range",
                        "minDate": "12/01/2020"
                      }'>
                @error('naissance') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Contact</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="contact" class="visually-hidden form-label">Contact</label>
                <input type="number" name="contact" required minlength="8" value="{{ old('contact') }}" class="form-control" id="contact" placeholder="Entrer un contact" aria-label="Entrer un contact">
                @error('contact') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Email</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="email" class="visually-hidden form-label">Email</label>
                <input type="email" name="email" required value="{{ old('email') }}" class="form-control" id="email" placeholder="Entrer un email" aria-label="Entrer un email">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-list-ul nav-icon"></i>
                  <div class="flex-grow-1">Plafond d'achat</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="Pachat" class="visually-hidden form-label">Plafond d'achat</label>
                <input type="number" name="Pachat" min="1" minlength="1" required value="{{ old('Pachat') }}" class="form-control" id="Pachat" placeholder="Entrer un plafond d'achat" aria-label="Entrer un plafond d'achat">
                @error('Pachat') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-sm-3 mb-2 mb-sm-0">
                <div class="d-flex align-items-center mt-2">
                  <i class="bi-geo-alt nav-icon"></i>
                  <div class="flex-grow-1">Adresse postale complète</div>
                </div>
              </div>
              <div class="col-sm">
                <label for="adresse_postale" class="visually-hidden form-label">Adresse postale complète</label>
                <input type="text" name="adresse_postale" value="{{ old('adresse_postale') }}" class="form-control" required id="adresse_postale" placeholder="Entrer une adresse postale complète" aria-label="Entrer une adresse postale complète">
                @error('adresse_postale') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
          </div>
          <!-- End Body -->

          <!-- Footer -->
          <div class="modal-footer gap-3">
            <button type="button" id="discardFormt" class="btn btn-white" data-bs-dismiss="modal">Sortir</button>
            <button type="submit" id="processEvent" class="btn btn-primary">Ajouter</button>
          </div>
          <!-- End Footer -->
          </form>
      </div>
    </div>
  </div>


@endsection