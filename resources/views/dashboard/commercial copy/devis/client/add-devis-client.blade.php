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
            <h1 class="page-header-title">Ajouter un devis pour un <span class="text-warning">Client</span></h1>
            <h4 class="page-header-title">Etape 1</h4>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
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
                            <option value="Nouveau">Nouveau particulier</option>
                            @if(particuliers()->count() > 0)
                              <option value="ChoisirClient">Choisir un particulier</option>
                            @endif
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row" id="addClient" style="display: block;">
                      <hr>
                      <div class="col-sm-12">
                        <div class="mb-4">
                          <label for="nom" class="form-label">Nom du client</label>
                          <input type="text" class="form-control" name="nom" value="{{ old('nom') }}" id="nom" placeholder="Entrer un nom">
                          @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="mb-4">
                          <label for="prenom" class="form-label">Prénom du client</label>
                          <input type="text" class="form-control" name="prenom" value="{{ old('prenom') }}" id="prenom" placeholder="Entrer un prénom">
                          @error('prenom') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="mb-4">
                          <label for="email" class="form-label">Email du client</label>
                          <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email" placeholder="Entrer un email">
                          @error('email') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="mb-4">
                          <label for="contact" class="form-label">Contact du client</label>
                          <input type="number" minlength="8" maxlength="10" class="form-control" name="contact" value="{{ old('contact') }}" id="contact" placeholder="Entrer un contact">
                          @error('contact') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="mb-4">
                          <label for="Pachat" class="form-label">Plafond d'achat</label>
                          <input type="number" min="1" minlength="1" class="form-control" name="Pachat" value="{{ old('Pachat') }}" id="Pachat" placeholder="Entrer un plafond d'achat">
                          @error('Pachat') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="mb-4">
                          <label for="genre" class="form-label">Genre</label>
                          <select name="genre" class="js-select form-select">
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                          </select>
                          @error('genre') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="mb-4">
                          <label for="naissance" class="form-label">Date de naissance</label>
                          <input type="date" name="naissance" id="naissance" value="{{ old('naissance') }}" class="flatpickr-custom form-control" placeholder="Entrer une date de naissance">
                          @error('naissance') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="mb-4">
                          <label for="adresse_postale" class="form-label">Adresse postale complète</label>
                          <input type="text" name="adresse_postale" value="{{ old('adresse_postale') }}" class="form-control" id="adresse_postale" placeholder="Entrer une adresse postale complète">
                          @error('adresse_postale') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="card" id="ChoisirClient" style="display: none;">
                  @if(clients()->count() > 0)
                    <!-- Header -->
                    <div class="card-header card-header-content-md-between">
                      <div class="mb-2 mb-md-0">
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
                            <th>Prénom</th>
                            <th>Plafond d'achat (Fcfa)</th>
                            <th>Email</th>
                            <th>Contact</th>
                          </tr>
                        </thead>

                        <tbody>
                          @foreach(clients() as $client)
                            <tr>
                              <td class="table-column-pe-0">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="clients" value="{{ $client->id }}" id="datatableCheckAll1">
                                  <label class="form-check-label" for="datatableCheckAll1"></label>
                                </div>
                              </td>
                              <td class="fw-bold">{{ $client->nom }}</td>
                              <td class="fw-bold">{{ $client->prenom }}</td>
                              <td class="fw-bold">{{ getprice($client->Pachat) }}</td>
                              <td class="fw-bold">{{ $client->email }}</td>
                              <td class="fw-bold">{{ $client->contact }}</td>
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
                            <span class="me-2">Showing:</span>

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
                  <h4 class="card-header-title">Information du devis </h4>
                </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="mb-4">
                        <label for="frais" class="form-label">Frais de livraison</label>
                        <input readonly type="text" class="form-control" name="frais" value="Se fera lors de la vilidation du devis" id="frais" placeholder="Entrer les frais de livraison" required aria-label="eg. 348121032">
                        @error('frais') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="mb-4">
                        <label for="delai_livraison" class="form-label">Délai de livraison</label>
                        <input readonly type="text" class="form-control" name="delai_livraison" value="Se fera lors de la vilidation du devis" id="delai_livraison" placeholder="Entrer un Délai de livraison" required aria-label="eg. 348121032">
                        @error('delai_livraison') <span class="text-danger"> {{ $message }} </span> @enderror
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
                      <button type="button" class="btn btn-ghost-light">Discard</button>
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

    <!-- Footer -->

    <div class="footer">
      <div class="row justify-content-between align-items-center">
        <div class="col">
          <p class="fs-6 mb-0">&copy; Front. <span class="d-none d-sm-inline-block">2022 Htmlstream.</span></p>
        </div>
        <!-- End Col -->

        <div class="col-auto">
          <div class="d-flex justify-content-end">
            <!-- List Separator -->
            <ul class="list-inline list-separator">
              <li class="list-inline-item">
                <a class="list-separator-link" href="#">FAQ</a>
              </li>

              <li class="list-inline-item">
                <a class="list-separator-link" href="#">License</a>
              </li>

              <li class="list-inline-item">
                <!-- Keyboard Shortcuts Toggle -->
                <button class="btn btn-ghost-secondary btn btn-icon btn-ghost-secondary rounded-circle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasKeyboardShortcuts" aria-controls="offcanvasKeyboardShortcuts">
                  <i class="bi-command"></i>
                </button>
                <!-- End Keyboard Shortcuts Toggle -->
              </li>
            </ul>
            <!-- End List Separator -->
          </div>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->
    </div>

    <!-- End Footer -->
  </main>



@endsection