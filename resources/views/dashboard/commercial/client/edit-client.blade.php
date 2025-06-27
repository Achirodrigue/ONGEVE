@extends('dashboard.commercial.layout.app')
@section('body')


  @include('include.message.dashboard')

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
            <a class="btn btn-primary" href="{{ route('commercial.client.index') }}">
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

      <form method="POST" action="{{ route('commercial.client.update', $client) }}" enctype="multipart/form-data">
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
                    <a href="{{ route('commercial.client.index') }}" class="btn btn-ghost-danger">Retour</a>
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