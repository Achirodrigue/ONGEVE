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
            <h1 class="page-header-title">Détails des infos de <span class="text-danger">{{ $employe->nom }} {{ $employe->prenom }}</span></h1>
          </div>

          <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('ressource.employedoc.show', $employe) }}">
              <i class="bi-eye me-1"></i> Documents
            </a>
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
              <a class="nav-link active" href="#">Détails employé</a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
      </div>
      <!-- End Page Header -->

      <!-- Step Form -->
      <form class="js-step-form py-md-5" data-hs-step-form-options='{
              "progressSelector": "#addUserStepFormProgress",
              "stepsSelector": "#addUserStepFormContent",
              "endSelector": "#addUserFinishBtn",
              "isValidate": false
            }'>
        <div class="row justify-content-lg-center">
          <div class="col-lg-8">
            <div id="addUserStepFormContent">
              <div id="addUserStepConfirmation" class="card card-lg active">
                <!-- Profile Cover -->
                <div class="profile-cover">
                  <div class="profile-cover-img-wrapper">
                    <img class="profile-cover-img" src="{{ asset("dashboard/assets/img/1920x400/img1.jpg") }}" alt="Image Description">
                  </div>
                </div>
                <!-- End Profile Cover -->

                <!-- Avatar -->
                <div class="avatar avatar-xxl avatar-circle avatar-border-lg profile-cover-avatar">
                  @if($employe->photo)
                    <img class="avatar-img" src="{{ asset(Storage::url($employe->photo)) }}" alt="Aucune photo ajouté">
                  @else
                    <img class="avatar-img" src="{{ asset("dashboard/assets/img/160x160/img9.jpg") }}" alt="Aucune photo ajouté">
                  @endif
                </div>
                <!-- End Avatar -->

                <!-- Body -->
                <div class="card-body">
                  <h4 class="text-danger text-center">1. Informations personnelles</h4>
                  <dl class="row">
                    <dt class="col-sm-6 text-sm-end">Nom complet:</dt>
                    <dd class="col-sm-6">{{ $employe->nom }} {{ $employe->prenom }}</dd>

                    <dt class="col-sm-6 text-sm-end">Date de naissance:</dt>
                    <dd class="col-sm-6">{{ $employe->date_naissance }}</dd>

                    <dt class="col-sm-6 text-sm-end">Lieu de naissance:</dt>
                    <dd class="col-sm-6">{{ $employe->lieu_naissance }}</dd>

                    <dt class="col-sm-6 text-sm-end">Sexe:</dt>
                    <dd class="col-sm-6">{{ $employe->sexe }}</dd>

                    <dt class="col-sm-6 text-sm-end">Nationalité:</dt>
                    <dd class="col-sm-6">{{ $employe->nationalite }}</dd>

                    <dt class="col-sm-6 text-sm-end">Situation matrimoniale:</dt>
                    <dd class="col-sm-6">{{ $employe->situation_matrimoniale }}</dd>

                    <dt class="col-sm-6 text-sm-end">Nombre d'enfant:</dt>
                    <dd class="col-sm-6">{{ $employe->nombre_enfant }}</dd>
                  </dl>
                  
                  <h4 class="text-danger text-center mt-2">2. Coordonnées</h4>
                  <dl class="row">
                    <dt class="col-sm-6 text-sm-end">Adresse:</dt>
                    <dd class="col-sm-6">{{ $employe->adresse }}</dd>

                    <dt class="col-sm-6 text-sm-end">Email:</dt>
                    <dd class="col-sm-6">{{ $employe->email }}</dd>

                    <dt class="col-sm-6 text-sm-end">Contact:</dt>
                    <dd class="col-sm-6">{{ $employe->contact_urgence }}</dd>

                    <dt class="col-sm-6 text-sm-end">Contact:</dt>
                    <dd class="col-sm-6">{{ $employe->contact_urgence }}</dd>
                  </dl>

                  <h4 class="text-danger text-center mt-2">3. Situation professionnelle</h4>
                  <dl class="row">
                    <dt class="col-sm-6 text-sm-end">Matricule interne:</dt>
                    <dd class="col-sm-6">{{ $employe->matricule_interne }}</dd>

                    <dt class="col-sm-6 text-sm-end">Fonction / Poste:</dt>
                    <dd class="col-sm-6">{{ $employe->post }}</dd>

                    <dt class="col-sm-6 text-sm-end">Département ou service:</dt>
                    <dd class="col-sm-6">{{ $employe->departement }}</dd>

                    <dt class="col-sm-6 text-sm-end">Lieu d'affectation:</dt>
                    <dd class="col-sm-6">{{ $employe->lieu_affectation }}</dd>

                    <dt class="col-sm-6 text-sm-end">Manager hiérarchique:</dt>
                    <dd class="col-sm-6">{{ $employe->nom_manageur }}</dd>

                    <dt class="col-sm-6 text-sm-end">Statut du contrat:</dt>
                    <dd class="col-sm-6">{{ $employe->statut }}</dd>

                    <dt class="col-sm-6 text-sm-end">Date d'embauche:</dt>
                    <dd class="col-sm-6">{{ $employe->date_embauche }}</dd>

                    <dt class="col-sm-6 text-sm-end">Date de fin de contratt:</dt>
                    <dd class="col-sm-6">{{ $employe->date_embauche }}</dd>
                    <!-- <div class="info-item"><p><strong>Date d'embauche :</strong> {{ \Carbon\Carbon::parse($employe->hire_date)->format('d/m/Y') }}</p></div>
                    <div class="info-item"><p><strong>Date de fin de contrat :</strong> {{ $employe->end_date ? \Carbon\Carbon::parse($employe->end_date)->format('d/m/Y') : 'N/A' }}</p></div> -->
                  </dl>
                  
                  <h4 class="text-danger text-center mt-2">4. Informations de paie</h4>
                  <dl class="row">
                    <dt class="col-sm-6 text-sm-end">Salaire de base:</dt>
                    <dd class="col-sm-6">{{ $employe->salaire }}</dd>

                    <dt class="col-sm-6 text-sm-end">Mode de paiement:</dt>
                    <dd class="col-sm-6">{{ $employe->mode_paiement }}</dd>

                    <dt class="col-sm-6 text-sm-end">Numéro de compte bancaire:</dt>
                    <dd class="col-sm-6">{{ $employe->compte_bancaire }}</dd>

                    <dt class="col-sm-6 text-sm-end">Numéro CNPS / Sécurité sociale:</dt>
                    <dd class="col-sm-6">{{ $employe->numero_cnps }}</dd>
                  </dl>
                  
                  <h4 class="text-danger text-center mt-2">5. Informations internes</h4>
                  <dl class="row">
                    <dt class="col-sm-6 text-sm-end">Équipements fournis:</dt>
                    <dd class="col-sm-6">{{ $employe->equipement_fournis }}</dd>
                  </dl>
                  <!-- End Row -->
                </div>
                <!-- End Body -->

                <!-- Footer -->
                <div class="card-footer d-sm-flex align-items-sm-center">
                  <button type="button" class="btn btn-ghost-secondary mb-2 mb-sm-0" data-hs-step-form-prev-options='{
                       "targetSelector": "#addUserStepBillingAddress"
                     }'>
                    <i class="bi-chevron-left"></i> Previous step
                  </button>

                  <div class="ms-auto">
                    <button type="button" class="btn btn-white me-2">Save in drafts</button>
                    <button id="addUserFinishBtn" type="button" class="btn btn-primary">Add user</button>
                  </div>
                </div>
                <!-- End Footer -->
              </div>
            </div>

            <!-- Message Body -->
            <div id="successMessageContent" style="display:none;">
              <div class="text-center">
                <img class="img-fluid mb-3" src="assets/svg/illustrations/oc-hi-five.svg" alt="Image Description" data-hs-theme-appearance="default" style="max-width: 15rem;">
                <img class="img-fluid mb-3" src="assets/svg/illustrations-light/oc-hi-five.svg" alt="Image Description" data-hs-theme-appearance="dark" style="max-width: 15rem;">

                <div class="mb-4">
                  <h2>Successful!</h2>
                  <p>New <span class="fw-semibold text-dark">Ella Lauda</span> user has been successfully created.</p>
                </div>

                <div class="d-flex justify-content-center">
                  <a class="btn btn-white me-3" href="users.html">
                    <i class="bi-chevron-left ms-1"></i> Back to users
                  </a>
                  <a class="btn btn-primary" href="users-add-user.html">
                    <i class="bi-person-plus-fill me-1"></i> Add new user
                  </a>
                </div>
              </div>
            </div>
            <!-- End Message Body -->
          </div>
        </div>
        <!-- End Row -->
      </form>
      <!-- End Step Form -->
    </div>
    <!-- End Content -->
  </main>

  


@endsection