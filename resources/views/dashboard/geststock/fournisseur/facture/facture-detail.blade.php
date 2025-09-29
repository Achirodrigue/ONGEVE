@extends('dashboard.geststock.layout.app')
@section('body')


  @include('include.message.dashboard')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <div class="row justify-content-sm-center text-center py-10">
        <div class="col-sm-7 col-md-5">
          <img class="img-fluid mb-5" src="{{ asset("dashboard/assets/svg/illustrations/oc-collaboration.svg") }}" alt="Image Description" data-hs-theme-appearance="default">
          <img class="img-fluid mb-5" src="{{ asset("dashboard/assets/svg/illustrations-light/oc-collaboration.svg") }}" alt="Image Description" data-hs-theme-appearance="dark">

          <h1>En cours de traitement</h1>
          <p>Bientôt disponible</p>

          <!-- <a class="btn btn-primary" href="layouts/index.html">Create my first campaign</a> -->
        </div>
      </div>
      <!-- End Row -->
    </div>
    <!-- End Content -->

  </main>


@endsection