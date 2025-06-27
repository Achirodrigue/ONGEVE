@extends('dashboard.comptable.layout.app')
@section('body')


  @include('include.message.dashboard')

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <div class="row justify-content-lg-center">
        <div class="col-lg-10">
          <!-- Profile Cover -->
          <div class="profile-cover">
            <div class="profile-cover-img-wrapper">
              <img class="profile-cover-img" src="{{ asset("dashboard/assets/img/1920x400/img1.jpg") }}" alt="Aucune banniere ajouté">
            </div>
          </div>
          <!-- End Profile Cover -->

          <!-- Profile Header -->
          <div class="text-center mb-5">
            <!-- Avatar -->
            <div class="avatar avatar-xxl avatar-circle profile-cover-avatar">
              @if(auth()->user()->photo)
                <img class="avatar-img" src="{{ asset(Storage::url(auth()->user()->photo)) }}" alt="Aucune photo ajouté">
              @else
                <img class="avatar-img" src="{{ asset("dashboard/assets/img/160x160/img9.jpg") }}" alt="Aucune photo ajouté">
              @endif
              <span class="avatar-status avatar-status-success"></span>
            </div>
            <!-- End Avatar -->

            <h1 class="page-header-title">{{ auth()->user()->nom }} {{ auth()->user()->prenom }} <i class="bi-patch-check-fill fs-2 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Top endorsed"></i></h1>
          </div>
          <!-- End Profile Header -->

          <!-- Nav -->
          <div class="js-nav-scroller hs-nav-scroller-horizontal mb-5">
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

            <ul class="nav nav-tabs align-items-center">
              <li class="nav-item">
                <a class="nav-link active" href="#">Profile</a>
              </li>
            </ul>
          </div>
          <!-- End Nav -->

          <div class="row">
            <div class="col-lg-4">
              <!-- <div class="card card-body mb-3 mb-lg-5">
                <h5>Complete your profile</h5>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="progress flex-grow-1">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <span class="ms-4">82%</span>
                </div>
              </div> -->

              <!-- Sticky Block Start Point -->
              <div id="accountSidebarNav"></div>

              <!-- Card -->
              <div class="js-sticky-block card mb-3 mb-lg-5" data-hs-sticky-block-options='{
                     "parentSelector": "#accountSidebarNav",
                     "breakpoint": "lg",
                     "startPoint": "#accountSidebarNav",
                     "endPoint": "#stickyBlockEndPoint",
                     "stickyOffsetTop": 20
                   }'>
                <!-- Header -->
                <div class="card-header">
                  <h4 class="card-header-title">Profile</h4>
                </div>
                <!-- End Header -->

                <!-- Body -->
                <div class="card-body">
                  <ul class="list-unstyled list-py-2 text-dark mb-0">
                    <li class="pb-0"><span class="card-subtitle">Identificateur</span></li>
                    <li><i class="bi-person dropdown-item-icon"></i> {{ auth()->user()->nom }}</li>
                    <li><i class="bi-person dropdown-item-icon"></i> {{ auth()->user()->prenom }}</li>

                    <li class="pt-4 pb-0"><span class="card-subtitle">Contacts</span></li>
                    <li><i class="bi-at dropdown-item-icon"></i> {{ auth()->user()->email }}</li>
                    <li><i class="bi-phone dropdown-item-icon"></i> (+225) {{ auth()->user()->contact }}</li>

                    <li class="pt-4 pb-0"><span class="card-subtitle">Connection</span></li>
                    <li><i class="bi-shield-lock dropdown-item-icon"></i> {{ auth()->user()->identifiant }}</li>
                  </ul>
                </div>
                <!-- End Body -->
              </div>
              <!-- End Card -->
            </div>

            <div class="col-lg-8">
              <div class="d-grid gap-3 gap-lg-5">
                <!-- Card -->
                <div class="card">
                  <!-- Header -->
                  <div class="card-header card-header-content-between">
                    <h4 class="card-header-title">Information comptable</h4>
                  </div>
                  <!-- End Header -->

                  <!-- Body -->
                  <div class="card-body"><!--  card-body-height" style="height: 30rem;  -->
                    <form method="POST" action="{{ route('comptable.profil.update') }}" enctype="multipart/form-data">
                      @csrf
                      @method('PATCH')

                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-4">
                              <!-- <label for="nom" class="form-label">Nom <i class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Products are the goods or services you sell."></i></label> -->
                              <label for="nom" class="form-label">Nom *</i></label>
                              <input type="text" class="form-control" name="nom" value="{{ auth()->user()->nom }}" id="nom" required>
                              @error('nom') <span class="text-danger"> {{ $message }} </span> @enderror
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-4">
                              <label for="prenom" class="form-label">Prénom *</i></label>
                              <input type="text" class="form-control" name="prenom" value="{{ auth()->user()->prenom }}" id="nom" required>
                              @error('prenom') <span class="text-danger"> {{ $message }} </span> @enderror
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-4">
                              <label for="email" class="form-label">Email *</i></label>
                              <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" id="nom" required>
                              @error('email') <span class="text-danger"> {{ $message }} </span> @enderror
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-4">
                              <label for="contact" class="form-label">Contact *</i></label>
                              <input type="number" minlength="8" maxlength="12" class="form-control" name="contact" value="{{ auth()->user()->contact }}" id="nom" required>
                              @error('contact') <span class="text-danger"> {{ $message }} </span> @enderror
                            </div>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-4">
                              <label for="identifiant" class="form-label">Identifiant *</i></label>
                              <input type="text" class="form-control" name="identifiant" value="{{ auth()->user()->identifiant }}" id="identifiant" required>
                              @error('identifiant') <span class="text-danger"> {{ $message }} </span> @enderror
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-4">
                              <label for="password" class="form-label">Nouveau mot de passe (facultatif)</i></label>
                              <input type="password" class="form-control" name="password" placeholder="Entrer un nouveau mot de passe" id="password">
                              <img src="{{ asset("auth/oeil/oeilc.png") }}" style="width: 5%; float: right; margin-top: -30px; margin-right: 3px;" id="eye" onClick="changer()">
                              @error('password') <span class="text-danger"> {{ $message }} </span> @enderror
                            </div>
                          </div>
                        </div>
                        
                        <div class="mb-4">
                          <label for="photo" class="form-label">Nouvelle photo (facultatif)</label>
                          <input type="file" class="form-control" name="photo" id="photo" placeholder="Entrer une nouvelle photo">
                          @error('photo') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>

                        <div class="position-fixed start-50 bottom-0 translate-middle-x w-100 zi-99 mb-3" style="max-width: 40rem;">
                          <!-- Card -->
                          <div class="card card-sm bg-dark border-dark mx-2">
                            <div class="card-body">
                              <div class="row justify-content-center justify-content-sm-between">
                                <div class="col">
                                  <a href="{{ route('comptable.home') }}" class="btn btn-ghost-danger">Retour</a>
                                </div>
                                <!-- End Col -->

                                <div class="col-auto">
                                  <div class="d-flex gap-3">
                                    <!-- <button type="button" class="btn btn-ghost-light">Discard</button> -->
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
                  <!-- End Body -->

                </div>
                <!-- End Card -->
              </div>

              <!-- Sticky Block End Point -->
              <div id="stickyBlockEndPoint"></div>
            </div>
          </div>
          <!-- End Row -->
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->
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