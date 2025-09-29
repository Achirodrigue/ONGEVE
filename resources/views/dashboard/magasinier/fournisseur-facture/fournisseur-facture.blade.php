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
            <h1 class="page-header-title">Les différents facture du fournisseurs <span class="badge bg-soft-dark text-dark ms-2">{{ $fournisseur->nom }}</span></h1>
          </div>
          <!-- End Col -->
           
          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('magasinier.fournisseur.index') }}">
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
              <a class="nav-link" href="{{ route('magasinier.fournisseur.index') }}" tabindex="-1" aria-disabled="true">Tout les fournisseurs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Factures fournisseurs</a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
      </div>
      <!-- End Page Header -->

      <!-- Card -->
      <div class="card card-table">
          @if($fournisseur->fournisseurfactures->count() > 0)
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
                    <th>Numéro facture</th>
                    <th>Total à payer</th>
                    <th>Approbation</th>
                    <th>Detail</th>
                    <th>Action</th>
                    
                  </tr>
                </thead>

                <tbody>
                  @foreach($fournisseur->fournisseurfactures as $fournisseurfacture)
                    <tr>
                      <td class="fw-bold">{{ $fournisseurfacture->numero_facture }}</td>
                      <td class="fw-bold">{{ $fournisseurfacture->total_ttc }}</td>
                      <td class="fw-bold">@if($fournisseurfacture->isvalide) Approuvé @else En cours @endif</td>
                      <td class="text-center">
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#editfournisseur{{ $fournisseur->id }}">
                            <i class="bi-eye me-1"></i> Voir
                          </a>
                        </div>
                      </td>

                      <td class="text-center">
                        <div class="btn-group" role="group">
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#editfournisseur{{ $fournisseur->id }}">
                            <i class="bi-pencil-fill me-1"></i>
                          </a>
                          <a class="btn btn-white btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#deletefournisseur{{ $fournisseur->id }}">
                            <i class="bi-trash dropdown-item-icon"></i>
                          </a>
                          <!-- End Button Group -->
                        </div>
                      </td>
                    </tr>

                    @include('include.fournisseur-facture')
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
                <h3 class="fw-bold mb-0 text-center">Désolé! Aucune facture fournisseur n'a été ajouté sur la plateforme</h3>
              </div>
              <!-- End Header -->
          @endif
      </div>
      <!-- End Card -->
    </div>
    <!-- End Content -->

  </main>

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Modification de {{ $client->nom }}</h1>
          </div>
          <!-- End Col -->
           
          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('comptable.client.index') }}">
              <i class="bi-arrow-return-left me-1"></i> Retour
            </a>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->

        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
          <!-- Nav -->
          <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Clients</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Modifier un client</a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>

      </div>
      <!-- End Page Header -->

      <form method="POST" action="{{ route('comptable.client.update', $client) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
          <div class="row">
            <div class="col-lg-10 mx-auto">
              <div class="card mb-3 mb-lg-5">
                <div class="card-header">
                  <h4 class="card-header-title">Information du client</h4>
                </div>

                <div class="card-body">

                      <div class="row">
                        <div class="col-md-12">
                          <div class="mb-4">
                            <label for="nom" class="form-label">Nom complet du client</label>
                            <input type="text" class="form-control" name="nom" value="{{ $client->nom }}" id="nom" placeholder="Entrer un nom">
                            @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-4">
                            <label for="contact" class="form-label">Contact du client</label>
                            <input type="number" minlength="8" maxlength="10" class="form-control" name="contact" value="{{ $client->contact }}" id="contact" placeholder="Entrer un contact">
                            @error('contact') <span class="text-danger"> {{ $message }} </span> @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-4">
                            <label for="email" class="form-label">Email du client</label>
                            <input type="email" class="form-control" name="email" value="{{ $client->email }}" id="email" placeholder="Entrer un email">
                            @error('email') <span class="text-danger"> {{ $message }} </span> @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-4">
                            <label for="Pachat" class="form-label">Plafond d'achat</label>
                            <input type="number" min="1" minlength="1" class="form-control" name="Pachat" value="{{ $client->Pachat }}" id="Pachat" placeholder="Entrer un plafond d'achat">
                            @error('Pachat') <span class="text-danger"> {{ $message }} </span> @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-4">
                            <label for="adresse_postale" class="form-label">Adresse postale complète</label>
                            <input type="text" name="adresse_postale" value="{{ $client->adresse_postale }}" class="form-control" id="adresse_postale" placeholder="Entrer une adresse postale complète">
                            @error('adresse_postale') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                        </div>
                        
                        @if(!$client->TC)
                          <div class="row">
                            <div class="col-md-6">
                              <div class="mb-4">
                                <label for="forme_juridique" class="form-label">Forme juridique</label>
                                <input type="text" name="forme_juridique" value="{{ $client->clientinfo->forme_juridique }}" class="form-control" id="forme_juridique" placeholder="Entrer une Forme juridique">
                                @error('forme_juridique') <span class="text-danger">{{ $message }}</span> @enderror
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-4">
                                <label for="numero_identifie" class="form-label">Numéro d'identification</label>
                                <input type="text" name="numero_identifie" value="{{ $client->clientinfo->numero_identifie }}" class="form-control" id="numero_identifie" placeholder="Entrer un Numéro d'identification">
                                @error('numero_identifie') <span class="text-danger">{{ $message }}</span> @enderror
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-4">
                                <label for="domaine" class="form-label">Secteur d'activité</label>
                                <input type="text" name="domaine" value="{{ $client->clientinfo->domaine }}" class="form-control" id="domaine" placeholder="Entrer un Secteur d'activité">
                                @error('domaine') <span class="text-danger">{{ $message }}</span> @enderror
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-4">
                                <label for="siege_social" class="form-label">Siège social</label>
                                <input type="text" name="siege_social" value="{{ $client->clientinfo->siege_social }}" class="form-control" id="siege_social" placeholder="Entrer un Siège social">
                                @error('siege_social') <span class="text-danger">{{ $message }}</span> @enderror
                              </div>
                            </div>
                          </div>
                        @else
                          <div class="row">
                            <div class="col-md-6">
                              <div class="mb-4">
                                <label for="genre" class="form-label">Genre</label>
                                <select name="genre" class="js-select form-select">
                                  @if($client->clientinfo->genre === "Homme")
                                    <option value="Homme" data-option-template='<span class="d-flex align-items-center">Select event color</span>'>Homme</option>
                                    <option value="Femme" data-option-template='<span class="d-flex align-items-center"><span class="legend-indicator bg-primary me-2"></span>HS Team</span>'>Femme</option>
                                  @else
                                    <option value="Femme" data-option-template='<span class="d-flex align-items-center"><span class="legend-indicator bg-primary me-2"></span>HS Team</span>'>Femme</option>
                                    <option value="Homme" data-option-template='<span class="d-flex align-items-center">Select event color</span>'>Homme</option>
                                  @endif
                                </select>
                                @error('genre') <span class="text-danger"> {{ $message }} </span> @enderror
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-4">
                                <label for="naissance" class="form-label">Date de naissance</label>
                                <input type="date" name="naissance" id="naissance" value="{{ $client->clientinfo->naissance }}" class="flatpickr-custom form-control" placeholder="Entrer une date de naissance">
                                @error('naissance') <span class="text-danger">{{ $message }}</span> @enderror
                              </div>
                            </div>
                          </div>
                        @endif
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
                    <a href="{{ route('comptable.client.index') }}" class="btn btn-ghost-danger">Retour</a>
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
  <!-- ========== END MAIN CONTENT ========== -->


@endsection