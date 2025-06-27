@extends('dashboard.ressource.layout.app')
@section('body')

  @include('include.message.dashboard')

    <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Modification des infos de <span class="text-danger">{{ $employe->nom }} {{ $employe->prenom }}</span></h1>
          </div>

          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('ressource.employe.index') }}">
              <i class="bi-arrow-return-left me-1"></i> Retour
            </a>
          </div>
        </div>
        <!-- End Row -->

        <div class="js-nav-scroller hs-nav-scroller-horizontal">
          <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('ressource.employe.index') }}" tabindex="-1" aria-disabled="true">Tout les employés</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Modifier un employé</a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
      </div>
      <!-- End Page Header -->

      <form method="POST" action="{{ route('ressource.employe.update', $employe) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
          <div class="row">
            <div class="col-lg-8 mx-auto mb-3 mb-lg-0">
              <div class="card mb-3 mb-lg-5">
                <!-- Header -->
                <div class="card-header">
                  <h4 class="card-header-title">Informations personnelles</h4>
                </div>
                <!-- End Header -->

                <!-- Body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="nom" class="form-label">Nom de l'employé *</label>
                        <input type="text" class="form-control" name="nom" value="{{ $employe->nom }}" id="nom" required>
                        @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="prenom" class="form-label">Prénom de l'employé *</label>
                        <input type="text" class="form-control" name="prenom" value="{{ $employe->prenom }}" id="prenom" required>
                        @error('prenom') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>
                   
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="date_naissance" class="form-label">Date de naissance *</label>
                        <input type="date" class="form-control" name="date_naissance" value="{{ $employe->date_naissance }}" id="date_naissance" required>
                        @error('date_naissance') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="lieu_naissance" class="form-label">Lieu de naissance *</label>
                        <input type="text" class="form-control" name="lieu_naissance" value="{{ $employe->lieu_naissance }}" id="lieu_naissance" required>
                        @error('lieu_naissance') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>
                   
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="photo" class="form-label">Photo (facultatif)</label>
                        <input type="file" class="form-control" name="photo" id="photo">
                        @error('photo') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="sexe" class="form-label">Sexe *</label>
                        <div class="tom-select-custom">
                          <select name="sexe" class="js-select form-select" autocomplete="off" id="categoryLabel" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "placeholder": "Select category"
                                  }' required>
                            <option value="M" {{ $employe->sexe == 'M' ? 'selected' : '' }}>Masculin</option>
                            <option value="F" {{ $employe->sexe == 'F' ? 'selected' : '' }}>Féminin</option>
                          </select>
                        </div>
                        @error('sexe') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>
                   
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="nationalite" class="form-label">Nationalité *</label>
                        <input type="text" class="form-control" name="nationalite" value="{{ $employe->nationalite }}" id="nationalite" required>
                        @error('nationalite') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="situation_matrimoniale" class="form-label">Situation matrimoniale *</label>
                        <input type="text" class="form-control" name="situation_matrimoniale" value="{{ $employe->situation_matrimoniale }}" id="situation_matrimoniale" required>
                        @error('situation_matrimoniale') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>
                   
                  <div class="row">
                    <div class="col-md-12">
                      <div class="mb-4">
                        <label for="nombre_enfant" class="form-label">Nombre d'enfants *</label>
                        <input type="number" class="form-control" name="nombre_enfant" value="{{ $employe->nombre_enfant }}" id="nombre_enfant" required>
                        @error('nombre_enfant') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="card mb-3 mb-lg-5">
                <!-- Header -->
                <div class="card-header">
                  <h4 class="card-header-title">Coordonnées </h4>
                </div>
                <!-- End Header -->

                <!-- Body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="adresse" class="form-label">Adresse complète *</label>
                        <input type="text" class="form-control" name="adresse" value="{{ $employe->adresse }}" id="adresse" required>
                        @error('adresse') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control" name="email" value="{{ $employe->email }}" id="email" required>
                        @error('email') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="contact" class="form-label">Numéro de téléphone *</label>
                        <input type="text" class="form-control" name="contact" value="{{ $employe->contact }}" id="contact" required>
                        @error('contact') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="contact_urgence" class="form-label">Personne à contacter en cas d'urgence (Téléphone) *</label>
                        <input type="text" class="form-control" name="contact_urgence" value="{{ $employe->contact_urgence }}" id="contact_urgence" required>
                        @error('contact_urgence') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Body -->
              </div>
              
              <div class="card mb-3 mb-lg-5">
                <div class="card-header">
                  <h4 class="card-header-title">Situation professionnelle </h4>
                </div>
                
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="matricule_interne" class="form-label">Matricule interne *</label>
                        <input type="text" class="form-control" name="matricule_interne" value="{{ $employe->matricule_interne }}" id="matricule_interne" required>
                        @error('matricule_interne') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="poste" class="form-label">Fonction / Poste *</label>
                        <input type="text" class="form-control" name="poste" value="{{ $employe->poste }}" id="poste"  required>
                        @error('poste') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="departement" class="form-label">Département ou service *</label>
                        <input type="text" class="form-control" name="departement" value="{{ $employe->departement }}" id="departement" required>
                        @error('departement') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="lieu_affectation" class="form-label">Lieu d'affectation *</label>
                        <input type="text" class="form-control" name="lieu_affectation" value="{{ $employe->lieu_affectation }}" id="lieu_affectation" required>
                        @error('lieu_affectation') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="nom_manageur" class="form-label">Manager hiérarchique *</label>
                        <input type="text" class="form-control" name="nom_manageur" value="{{ $employe->nom_manageur }}" id="nom_manageur" required>
                        @error('nom_manageur') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="statut" class="form-label">Statut du contrat *</label>
                        <div class="tom-select-custom">
                          <select name="statut" class="js-select form-select" autocomplete="off" id="categoryLabel" data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true,
                                    "placeholder": "Select category"
                                  }' required>
                            <option value="CDI" {{ $employe->statut == 'CDI' ? 'selected' : '' }}>CDI</option>
                            <option value="CDD" {{ $employe->statut == 'CDD' ? 'selected' : '' }}>CDD</option>
                            <option value="Interim" {{ $employe->statut == 'Interim' ? 'selected' : '' }}>Intérim</option>
                            <option value="Stage" {{ $employe->statut == 'Stage' ? 'selected' : '' }}>Stage</option>
                          </select>
                        </div>
                        @error('statut') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="date_embauche" class="form-label">Date d'embauche *</label>
                        <input type="date" class="form-control" name="date_embauche" value="{{ $employe->date_embauche }}" id="date_embauche" required>
                        @error('date_embauche') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="date_fin_contrat" class="form-label">Date de fin de contrat (si applicable)</label>
                        <input type="date" class="form-control" name="date_fin_contrat" value="{{ $employe->date_fin_contrat }}" id="date_fin_contrat">
                        @error('date_fin_contrat') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="card mb-3 mb-lg-5">
                <div class="card-header">
                  <h4 class="card-header-title">Informations de paie</h4>
                </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="salaire" class="form-label">Salaire de base *</label>
                        <input type="number" class="form-control" name="salaire" value="{{ $employe->salaire }}" id="salaire" required>
                        @error('salaire') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="mode_paiement" class="form-label">Mode de paiement *</label>
                        <input type="text" class="form-control" name="mode_paiement" value="{{ $employe->mode_paiement }}" id="mode_paiement" required>
                        @error('mode_paiement') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>
                   
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="compte_bancaire" class="form-label">Numéro de compte bancaire</label>
                        <input type="text" class="form-control" name="compte_bancaire" value="{{ $employe->date_naissance }}" id="compte_bancaire">
                        @error('compte_bancaire') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-4">
                        <label for="numero_cnps" class="form-label">Numéro CNPS / Sécurité sociale</label>
                        <input type="text" class="form-control" name="numero_cnps" value="{{ $employe->numero_cnps }}" id="numero_cnps" required>
                        @error('numero_cnps') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>
                   
                  <div class="row">
                    <div class="col-md-12">
                      <div class="mb-4">
                        <label for="equipement_fournis" class="form-label">Équipements fournis (ex: ordinateur, téléphone)</label>
                        <textarea name="equipement_fournis" class="form-control" id="equipement_fournis">{{ $employe->equipement_fournis }}</textarea>
                        @error('equipement_fournis') <span class="text-danger"> {{ $message }} </span> @enderror
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="position-fixed start-50 bottom-0 translate-middle-x w-100 zi-99 mb-3" style="max-width: 40rem;">
            <!-- Card -->
            <div class="card card-sm bg-dark border-dark mx-2">
              <div class="card-body">
                <div class="row justify-content-center justify-content-sm-between">
                  <div class="col">
                    <a href="{{ route('ressource.employe.index') }}" class="btn btn-ghost-danger">Retour</a>
                  </div>
                  <!-- End Col -->

                  <div class="col-auto">
                    <div class="d-flex gap-3">
                      <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Row -->
              </div>
            </div>
            <!-- End Card -->
          </div>
      </form>

    </div>
    <!-- End Content -->

  </main>


@endsection