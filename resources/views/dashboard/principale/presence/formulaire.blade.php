@extends('dashboard.principale.layout.app')
@section('body')


  @include('include.message.dashboard')


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
            <form method="POST" action="{{ route('commun.formulaire.presence.store') }}">
              @csrf
              <div class="text-center">
                <div class="mb-5">
                  <h1 class="display-5">Formulaire de presence employé</h1>
                  <!-- <p>Don't have an account yet? <a class="link" href="authentication-signup-basic.html">Sign up here</a></p> -->
                </div>

                <div class="d-grid mb-4">
                  <a class="btn btn-white btn-lg" href="#">
                    <span class="d-flex justify-content-center align-items-center">
                      Veillez remplir le formulaire
                    </span>
                  </a>
                </div>

                <span class="divider-center text-muted mb-4">Commencer</span>
              </div>

              <!-- Form -->
              <div class="mb-4">
                <label class="form-label" for="signinSrEmail">Votre email</label>
                <input type="email" class="form-control form-control-lg" name="email" id="signinSrEmail" tabindex="1" placeholder="email@address.com" aria-label="email@address.com" required>
                @error('email') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
              </div>
              <!-- End Form -->

              <!-- Form -->
              <div class="mb-4">
                <label class="form-label" for="employe_id">Employés</label>
                @if($employes->count() > 0)
                    @foreach($employes as $employe)
                      <select name="employe_id" class="form-control form-control-lg" id="employe_id">
                        <option value="{{ $employe->id }}">{{ $employe->nom }} {{ $employe->prenom }} : {{ $employe->contact }}</option>
                      </select>
                    @endforeach
                @else
                  <input type="text" name="employe_id" class="form-control form-control-lg" id="employe_id" tabindex="1" placeholder="Désolé! Aucun employé disponible" aria-label="email@address.com" required readonly>
                @endif
                @error('employe_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
              </div>
              <!-- End Form -->

              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Valider</button>
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