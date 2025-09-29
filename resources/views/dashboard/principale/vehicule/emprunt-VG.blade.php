@extends('dashboard.principale.layout.app')
@section('body')



  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main" class="main" style="background-image: url(/images/img1.jpg); background-size: cover;">

    <!-- Content -->
    <div class="container py-5 py-sm-7">
      <a class="d-flex justify-content-center mb-5" href="index.html">
        <img class="zi-2" src="{{ asset("dashboard/img/logo1.png") }}" alt="Image Description" style="width: 8rem;">
      </a>

      <div class="mx-auto" style="max-width: 30rem;">
        <!-- Card -->
        <div class="card card-lg mb-5">
          <div class="card-body">
            <!-- Form -->
            <form method="POST" action="{{ route('commun.emprunt.vehicule.store') }}">
              @csrf
              <div class="text-center">
                @include('include.message.qr-dashboard')

                <div class="mb-5">
                  <h1 class="display-5">Formulaire d'emprunt de véhicule</h1>
                  <!-- <p>Don't have an account yet? <a class="link" href="authentication-signup-basic.html">Sign up here</a></p> -->
                </div>

                <div class="d-grid mb-4">
                  <a class="btn btn-white btn-lg" href="#">
                    <span class="d-flex justify-content-center align-items-center">
                      Veillez remplir le formulaire
                    </span>
                  </a>
                </div>
              </div>
     
              <span class="divider-center text-muted mb-4">Chauffeur</span>

              <div class="mb-4">
                <label class="form-label" for="signinSrEmail">Votre email</label>
                <input type="email" class="form-control form-control-lg" name="email" id="signinSrEmail" tabindex="1" placeholder="email@address.com" aria-label="email@address.com" required>
                @error('email') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
              </div>

              <div class="mb-4">
                <label class="form-label" for="employe_id">Chauffeur *</label>
                @if(chauffeurs()->count() > 0)
                    @foreach(chauffeurs() as $pchauffeur)
                      <select name="pchauffeur_id" class="form-control form-control-lg" id="pchauffeur_id">
                        <option value="{{ $pchauffeur->id }}">{{ $pchauffeur->nom }} {{ $pchauffeur->prenom }} : {{ $pchauffeur->contact }}</option>
                      </select>
                    @endforeach
                @else
                  <input type="text" name="pchauffeur_id" class="form-control form-control-lg" id="pchauffeur_id" tabindex="1" placeholder="Désolé! Aucun chauffeur disponible" required readonly>
                @endif
                @error('pchauffeur_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
              </div>

              <span class="divider-center text-muted mb-4">Emprunt</span>
              
              <div class="mb-4">
                <label class="form-label" for="date_debut">Date de début d'emprunt *</label>
                <input type="date" class="form-control form-control-lg" value="{{ old('date_debut') }}" name="date_debut" id="date_debut" tabindex="1" placeholder="Date de début d'emprunt" aria-label="Date de début d'emprunt" required>
                @error('date_debut') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
              </div>
              
              <div class="mb-4">
                <label class="form-label" for="date_fin">Date de fin d'emprunt</label>
                <input type="date" class="form-control form-control-lg" name="date_fin" value="{{ old('date_fin') }}" id="date_fin" tabindex="1" placeholder="Date de fin d'emprunt" aria-label="Date de fin d'emprunt" required>
                @error('date_fin') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
              </div>
              
              <div class="mb-4">
                <label class="form-label" for="mission">Mission *</label>
                <textarea name="mission" id="mission" value="{{ old('mission') }}" class="form-control form-control-lg" placeholder="Entrer le motif de l'emprunt" required></textarea>
                @error('mission') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
              </div>

              <div class="mb-4">
                <label class="form-label" for="pvehicule_id">Véhicule *</label>
                @if(vehicules()->count() > 0)
                    @foreach(vehicules() as $pvehicule)
                      <select name="pvehicule_id" class="form-control form-control-lg" id="pvehicule_id">
                        <option value="{{ $pvehicule->id }}">{{ $pvehicule->marque }} : {{ $pvehicule->immatriculation }}</option>
                      </select>
                    @endforeach
                @else
                  <input type="text" name="pvehicule_id" class="form-control form-control-lg" id="pvehicule_id" tabindex="1" placeholder="Désolé! Aucun véhicule disponible" aria-label="email@address.com" required readonly>
                @endif
                @error('pvehicule_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
              </div>
               
              <!-- Form -->
                  <!-- $table->date('date_debut');
                  $table->date('date_fin')->nullable();
                  $table->boolean('etat')->default(1);
                  $table->longText('mission')->nullable();
                  $table->boolean('type')->default(0);
                  $table->boolean('statut')->default(1);
                  $table->foreignId('employe_id')->nullable()->constrained()->onDelete('cascade');   // employé si emprunt
                  $table->foreignId('pchauffeur_id')->nullable()->constrained()->onDelete('cascade');// chauffeur si mission
                  $table->foreignId('pvehicule_id')->constrained()->onDelete('cascade'); -->
              <!-- Form -->

              <!-- <div class="mb-4">
                <label class="form-label" for="employe_id">Employés *</label>
                @if(employes()->count() > 0)
                    @foreach(employes() as $employe)
                      <select name="employe_id" class="form-control form-control-lg" id="employe_id">
                        <option value="{{ $employe->id }}">{{ $employe->nom }} {{ $employe->prenom }} : {{ $employe->contact }}</option>
                      </select>
                    @endforeach
                @else
                  <input type="text" name="employe_id" class="form-control form-control-lg" id="employe_id" tabindex="1" placeholder="Désolé! Aucun employé disponible" aria-label="email@address.com" required readonly>
                @endif
                @error('employe_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
              </div> -->

              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Emprunter</button>
              </div>
            </form>
            <!-- End Form -->
          </div>
        </div>
        <!-- End Card -->

      </div>
    </div>
    <!-- End Content -->
  </main>
  <!-- ========== END MAIN CONTENT ========== -->

@endsection