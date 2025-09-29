@extends('dashboard.admin.layout.apps')
@section('body')

  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="container">
      <a class="position-absolute top-0 start-0 end-0 py-4" href="index.html">
        <img class="avatar avatar-xl avatar-4x3 avatar-centered" src="{{ asset("principale/assets/img/logo/logo.png") }}" width="15%" alt="Image Description" data-hs-theme-appearance="default">
        <img class="avatar avatar-xl avatar-4x3 avatar-centered" src="{{ asset("principale/assets/img/logo/logo.png") }}" width="15%" alt="Image Description" data-hs-theme-appearance="dark">
      </a>

      <div class="footer-height-offset d-flex justify-content-center align-items-center flex-column">
        <div class="row justify-content-center align-items-sm-center w-100">
          <div class="col-9 col-sm-6 col-lg-4">
            <div class="text-center text-sm-end me-sm-4 mb-5 mb-sm-0">
              <img class="img-fluid" src="assets/svg/illustrations/oc-thinking.svg" alt="Image Description" data-hs-theme-appearance="default">
              <img class="img-fluid" src="assets/svg/illustrations-light/oc-thinking.svg" alt="Image Description" data-hs-theme-appearance="dark">
            </div>
          </div>
          <!-- End Col -->

          <div class="col-sm-6 col-lg-4 text-center text-sm-start">
            <h1 class="display-1 mb-0">Oups ! La page que vous recherchez est introuvable.</h1>
            <p class="lead">
              Désolé, nous n'avons pas trouvé la page que vous recherchiez. Nous vous suggérons de revenir aux sections principales.
            </p>
            <a href="{{ route('accueil') }}" class="btn btn-primary">Retour à l'accueil</a>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
      </div>
    </div>
    <!-- End Content -->

    <!-- Footer -->
    <div class="footer text-center">
      <ul class="list-inline list-separator">
        <li class="list-inline-item">
          <a class="list-separator-link" href="#">Front Support</a>
        </li>

        <li class="list-inline-item">
          <a class="list-separator-link" href="#">Front Status</a>
        </li>

        <li class="list-inline-item">
          <a class="list-separator-link" href="#">Get Help</a>
        </li>
      </ul>
    </div>
    <!-- End Footer -->
  </main>
  <!-- ========== END MAIN CONTENT ========== -->

@endsection