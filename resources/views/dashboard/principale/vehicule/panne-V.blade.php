@extends('dashboard.principale.layout.app')
@section('body')


  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main" class="main" style="background-image: url(/images/img1.jpg); background-size: cover;">
    <!-- <div class="position-fixed top-0 end-0 start-0 bg-img-start" style="height: 32rem; background-image: url(/dashboard/assets/svg/components/card-6.svg);">
      <div class="shape shape-bottom zi-1">
        <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1921 273">
          <polygon fill="#fff" points="0,273 1921,273 1921,0 " />
        </svg>
      </div>
    </div> -->

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
            <form method="POST" action="{{ route('commun.panne.vehicule.store') }}">
              @csrf
              <div class="text-center">
                @include('include.message.qr-dashboard')

                <div class="mb-5">
                  <h1 class="display-5">Formulaire de signalisation de panne sur le véhicule <span class="text-danger">{{ $pvehicule->marque }} : {{ $pvehicule->immatriculation }}</span></h1>
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

              <span class="divider-center text-muted mb-4">Panne</span>

              <!-- Form -->
              <div class="mb-4">
                <label class="form-label" for="date_panne">Date de constat de la panne *</label>
                <input type="date" class="form-control form-control-lg" value="{{ old('date_panne') }}" name="date_panne" id="date_panne" tabindex="1" placeholder="Date de constat de la panne" aria-label="Date de constat de la panne" required>
                @error('date_panne') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
              </div>
              <!-- End Form -->
              
              <!-- Form -->
              <div class="mb-4">
                <label class="form-label" for="description">Déffaillances constatées *</label>
                <textarea name="description" id="description" value="{{ old('description') }}" class="form-control form-control-lg" placeholder="Entrer les déffaillances constatées" required></textarea>
                @error('description') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
              </div>
              <!-- End Form -->

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
              <!-- End Form -->

              <!-- Form -->
              <div class="mb-4" hidden>
                <label class="form-label" for="pvehicule_id">Véhicule *</label>
                <input type="text" value="{{ $pvehicule->id }}" name="pvehicule_id" class="form-control form-control-lg" id="pvehicule_id" tabindex="1" required readonly>
                @error('pvehicule_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
              </div>
              <!-- End Form -->

              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Signaler</button>
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