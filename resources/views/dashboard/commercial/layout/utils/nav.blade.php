  <!-- ========== HEADER ========== -->
  <header id="header" class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered bg-white">
    <div class="navbar-nav-wrap">
      <!-- Logo -->
      <a class="navbar-brand" href="#" aria-label="Front">
          <!-- <h3 class="fw-bold navbar-brand-logo mb-0" style="color: blue;">{{ auth()->user()->nom }} <br> {{ auth()->user()->prenom }}</h3> -->
          <img class="navbar-brand-logo" src="{{ asset("dashboard/img/logo1.png") }}" alt="Logo" data-hs-theme-appearance="default">
          <img class="navbar-brand-logo" src="{{ asset("dashboard/img/logo1.png") }}" alt="Logo" data-hs-theme-appearance="dark">
          <img class="navbar-brand-logo-mini" src="{{ asset("dashboard/img/logo1.png") }}" alt="Logo" data-hs-theme-appearance="default">
          <img class="navbar-brand-logo-mini" src="{{ asset("dashboard/img/logo1.png") }}" alt="Logo" data-hs-theme-appearance="dark">
      </a>
      <!-- End Logo -->

      <div class="navbar-nav-wrap-content-start">
        <!-- Navbar Vertical Toggle -->
        <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
          <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
          <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
        </button>

        <!-- End Navbar Vertical Toggle -->

        <!-- Search Form -->
        <div class="dropdown ms-2">
          <!-- Input Group -->
          <div class="d-none d-lg-block">
            <div class="input-group input-group-merge input-group-borderless input-group-hover-light navbar-input-group">
              <!-- <div class="input-group-prepend input-group-text">
                <i class="bi-search"></i>
              </div>

              <input type="search" class="js-form-search form-control" placeholder="Search in front" aria-label="Search in front" data-hs-form-search-options='{
                       "clearIcon": "#clearSearchResultsIcon",
                       "dropMenuElement": "#searchDropdownMenu",
                       "dropMenuOffset": 20,
                       "toggleIconOnFocus": true,
                       "activeClass": "focus"
                     }'>
              <a class="input-group-append input-group-text" href="javascript:;">
                <i id="clearSearchResultsIcon" class="bi-x-lg" style="display: none;"></i>
              </a> -->
              <div class="marquee-rtl">
                  <div>
                      Aucune notification pour le moment
                  </div>
              </div>
            </div>
          </div>

          <!-- <button class="js-form-search js-form-search-mobile-toggle btn btn-ghost-secondary btn-icon rounded-circle d-lg-none" type="button" data-hs-form-search-options='{
                       "clearIcon": "#clearSearchResultsIcon",
                       "dropMenuElement": "#searchDropdownMenu",
                       "dropMenuOffset": 20,
                       "toggleIconOnFocus": true,
                       "activeClass": "focus"
                     }'>
            <i class="bi-search"></i>
          </button> -->
          <!-- End Input Group -->

          <!-- Card Search Content -->
          <div id="searchDropdownMenu" class="hs-form-search-menu-content dropdown-menu dropdown-menu-form-search navbar-dropdown-menu-borderless">
            <div class="card">
              <!-- Body -->
              <div class="card-body-height">
                <div class="d-lg-none">
                  <div class="input-group input-group-merge navbar-input-group mb-5">
                    <div class="input-group-prepend input-group-text">
                      <i class="bi-search"></i>
                    </div>

                    <input type="search" class="form-control" placeholder="Search in front" aria-label="Search in front">
                    <a class="input-group-append input-group-text" href="javascript:;">
                      <i class="bi-x-lg"></i>
                    </a>
                  </div>
                </div>

                <span class="dropdown-header">Recent searches</span>

                <div class="dropdown-item bg-transparent text-wrap">
                  <a class="btn btn-soft-dark btn-xs rounded-pill" href="index.html">
                    Gulp <i class="bi-search ms-1"></i>
                  </a>
                  <a class="btn btn-soft-dark btn-xs rounded-pill" href="index.html">
                    Notification panel <i class="bi-search ms-1"></i>
                  </a>
                </div>

                <div class="dropdown-divider"></div>

                <span class="dropdown-header">Tutorials</span>

                <a class="dropdown-item" href="index.html">
                  <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                      <span class="icon icon-soft-dark icon-xs icon-circle">
                        <i class="bi-sliders"></i>
                      </span>
                    </div>

                    <div class="flex-grow-1 text-truncate ms-2">
                      <span>How to set up Gulp?</span>
                    </div>
                  </div>
                </a>

                <a class="dropdown-item" href="index.html">
                  <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                      <span class="icon icon-soft-dark icon-xs icon-circle">
                        <i class="bi-paint-bucket"></i>
                      </span>
                    </div>

                    <div class="flex-grow-1 text-truncate ms-2">
                      <span>How to change theme color?</span>
                    </div>
                  </div>
                </a>

                <div class="dropdown-divider"></div>

                <span class="dropdown-header">Members</span>

                <a class="dropdown-item" href="index.html">
                  <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                      <img class="avatar avatar-xs avatar-circle" src="assets/img/160x160/img10.jpg" alt="Image Description">
                    </div>
                    <div class="flex-grow-1 text-truncate ms-2">
                      <span>Amanda Harvey <i class="tio-verified text-primary" data-toggle="tooltip" data-placement="top" title="Top endorsed"></i></span>
                    </div>
                  </div>
                </a>

                <a class="dropdown-item" href="index.html">
                  <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                      <img class="avatar avatar-xs avatar-circle" src="assets/img/160x160/img3.jpg" alt="Image Description">
                    </div>
                    <div class="flex-grow-1 text-truncate ms-2">
                      <span>David Harrison</span>
                    </div>
                  </div>
                </a>

                <a class="dropdown-item" href="index.html">
                  <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                      <div class="avatar avatar-xs avatar-soft-info avatar-circle">
                        <span class="avatar-initials">A</span>
                      </div>
                    </div>
                    <div class="flex-grow-1 text-truncate ms-2">
                      <span>Anne Richard</span>
                    </div>
                  </div>
                </a>
              </div>
              <!-- End Body -->

              <!-- Footer -->
              <a class="card-footer text-center" href="index.html">
                See all results <i class="bi-chevron-right small"></i>
              </a>
              <!-- End Footer -->
            </div>
          </div>
          <!-- End Card Search Content -->

        </div>

        <!-- End Search Form -->
      </div>

      <div class="navbar-nav-wrap-content-end">
        <!-- Navbar -->
        <ul class="navbar-nav">
          <li class="nav-item d-none d-sm-inline-block">
            <!-- Notification -->
            <div class="dropdown">
              <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="navbarNotificationsDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-dropdown-animation>
                <i class="bi-bell"></i>
                <span class="btn-status btn-sm-status btn-status-danger"></span>
              </button>

              <div class="dropdown-menu dropdown-menu-end dropdown-card navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="navbarNotificationsDropdown" style="width: 25rem;">
                <div class="card">
                  <div class="card-header card-header-content-between">
                    <h4 class="card-title mb-0">Notifications</h4>

                    <div class="dropdown">
                      <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle" id="navbarNotificationsDropdownSettings" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi-three-dots-vertical"></i>
                      </button>

                      <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="navbarNotificationsDropdownSettings">
                        <span class="dropdown-header">Settings</span>
                        <a class="dropdown-item" href="#">
                          <i class="bi-archive dropdown-item-icon"></i> Archive all
                        </a>
                        <a class="dropdown-item" href="#">
                          <i class="bi-check2-all dropdown-item-icon"></i> Mark all as read
                        </a>
                        <a class="dropdown-item" href="#">
                          <i class="bi-toggle-off dropdown-item-icon"></i> Disable notifications
                        </a>
                        <a class="dropdown-item" href="#">
                          <i class="bi-gift dropdown-item-icon"></i> What's new?
                        </a>
                        <div class="dropdown-divider"></div>
                        <span class="dropdown-header">Feedback</span>
                        <a class="dropdown-item" href="#">
                          <i class="bi-chat-left-dots dropdown-item-icon"></i> Report
                        </a>
                      </div>
                    </div>
                  </div>
                  
                  <ul class="nav nav-tabs nav-justified" id="notificationTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" href="#notificationNavOne" id="notificationNavOne-tab" data-bs-toggle="tab" data-bs-target="#notificationNavOne" role="tab" aria-controls="notificationNavOne" aria-selected="true">Messages (3)</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#notificationNavTwo" id="notificationNavTwo-tab" data-bs-toggle="tab" data-bs-target="#notificationNavTwo" role="tab" aria-controls="notificationNavTwo" aria-selected="false">Archivé</a>
                    </li>
                  </ul>
                  
                  <div class="card-body-height">
                    <div class="tab-content" id="notificationTabContent">
                      <div class="tab-pane fade show active" id="notificationNavOne" role="tabpanel" aria-labelledby="notificationNavOne-tab">
                        <ul class="list-group list-group-flush navbar-card-list-group">

                          <li class="list-group-item form-check-select">
                            <div class="row">
                              <div class="col ms-n2">
                                <h5 class="mb-1">Bientôt disponible</h5>
                              </div>
                            </div>
                          </li>
                          <!-- <li class="list-group-item form-check-select">
                            <div class="row">
                              <div class="col-auto">
                                <div class="d-flex align-items-center">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="notificationCheck1" checked>
                                    <label class="form-check-label" for="notificationCheck1"></label>
                                    <span class="form-check-stretched-bg"></span>
                                  </div>
                                  <img class="avatar avatar-sm avatar-circle" src="assets/img/160x160/img3.jpg" alt="Image Description">
                                </div>
                              </div>

                              <div class="col ms-n2">
                                <h5 class="mb-1">Brian Warner</h5>
                                <p class="text-body fs-5">changed an issue from "In Progress" to <span class="badge bg-success">Review</span></p>
                              </div>

                              <small class="col-auto text-muted text-cap">2hr</small>
                            </div>

                            <a class="stretched-link" href="#"></a>
                          </li>
                          
                          <li class="list-group-item form-check-select">
                            <div class="row">
                              <div class="col-auto">
                                <div class="d-flex align-items-center">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="notificationCheck2" checked>
                                    <label class="form-check-label" for="notificationCheck2"></label>
                                    <span class="form-check-stretched-bg"></span>
                                  </div>
                                  <div class="avatar avatar-sm avatar-soft-dark avatar-circle">
                                    <span class="avatar-initials">K</span>
                                  </div>
                                </div>
                              </div>

                              <div class="col ms-n2">
                                <h5 class="mb-1">Klara Hampton</h5>
                                <p class="text-body fs-5">mentioned you in a comment</p>
                                <blockquote class="blockquote blockquote-sm">
                                  Nice work, love! You really nailed it. Keep it up!
                                </blockquote>
                              </div>

                              <small class="col-auto text-muted text-cap">10hr</small>
                            </div>

                            <a class="stretched-link" href="#"></a>
                          </li> -->
                        </ul>
                      </div>

                      <div class="tab-pane fade" id="notificationNavTwo" role="tabpanel" aria-labelledby="notificationNavTwo-tab">
                        <!-- List Group -->
                        <ul class="list-group list-group-flush navbar-card-list-group">
                            <li class="list-group-item form-check-select">
                              <div class="row">
                                <div class="col ms-n2">
                                  <h5 class="mb-1">Bientôt disponible</h5>
                                </div>
                              </div>
                              
                              <a class="stretched-link" href="#"></a>
                            </li>
                          <!-- 
                            <li class="list-group-item form-check-select">
                              <div class="row">
                                <div class="col-auto">
                                  <div class="d-flex align-items-center">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="notificationCheck6">
                                      <label class="form-check-label" for="notificationCheck6"></label>
                                      <span class="form-check-stretched-bg"></span>
                                    </div>
                                    <div class="avatar avatar-sm avatar-soft-dark avatar-circle">
                                      <span class="avatar-initials">A</span>
                                    </div>
                                  </div>
                                </div>

                                <div class="col ms-n2">
                                  <h5 class="mb-1">Anne Richard</h5>
                                  <p class="text-body fs-5">accepted your invitation to join Notion</p>
                                </div>

                                <small class="col-auto text-muted text-cap">1dy</small>
                              </div>
                              
                              <a class="stretched-link" href="#"></a>
                            </li>
                          -->
                        </ul>
                        <!-- End List Group -->
                      </div>
                    </div>
                    <!-- End Tab Content -->
                  </div>
                  <!-- End Body -->

                  <!-- Card Footer -->
                  <a class="card-footer text-center" href="#">
                    Voir toutes les notifications <i class="bi-chevron-right"></i>
                  </a>
                  <!-- End Card Footer -->
                </div>
              </div>
            </div>
            <!-- End Notification -->
          </li>

          @if(auth()->user()->statut)
            <li class="nav-item d-none d-sm-inline-block">
              <!-- Apps -->
              <div class="dropdown">
                <button type="button" class="btn btn-icon btn-ghost-secondary rounded-circle" id="navbarAppsDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>
                  <i class="bi-app-indicator"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-end dropdown-card navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="navbarAppsDropdown" style="width: 25rem;">
                  <div class="card">
                    <!-- Header -->
                    <div class="card-header">
                      <h4 class="card-title">Mes differents services</h4>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->                  
                    <div class="card-body card-body-height">
                        <div class="row">
                          <div class="col ms-n2">
                            <h5 class="mb-1">Bientôt disponible</h5>
                          </div>
                        </div>
                        <!-- 
                          <a class="dropdown-item" href="{{ route('comptable.home') }}">
                            <div class="d-flex align-items-center">
                              <div class="flex-shrink-0">
                                <img class="avatar avatar-xs avatar-4x3" src="{{ asset("dashboard/assets/svg/brands/atlassian-icon.svg") }}" alt="Image Description">
                              </div>
                              <div class="flex-grow-1 text-truncate ms-3">
                                <h5 class="mb-0">Comptable</h5>
                                <p class="card-text text-body">Visiter le tableau de bord</p>
                              </div>
                            </div>
                          </a>

                          <a class="dropdown-item" href="{{ route('commercial.home') }}">
                            <div class="d-flex align-items-center">
                              <div class="flex-shrink-0">
                                <img class="avatar avatar-xs avatar-4x3" src="{{ asset("dashboard/assets/svg/brands/slack-icon.svg") }}" alt="Image Description">
                              </div>
                              <div class="flex-grow-1 text-truncate ms-3">
                                <h5 class="mb-0">Commercial <span class="badge bg-primary rounded-pill text-uppercase ms-1">Try</span></h5>
                                <p class="card-text text-body">Visiter le tableau de bord</p>
                              </div>
                            </div>
                          </a>

                          <a class="dropdown-item" href="{{ route('magasinier.home') }}">
                            <div class="d-flex align-items-center">
                              <div class="flex-shrink-0">
                                <img class="avatar avatar-xs avatar-4x3" src="{{ asset("dashboard/assets/svg/brands/google-webdev-icon.svg") }}" alt="Image Description">
                              </div>
                              <div class="flex-grow-1 text-truncate ms-3">
                                <h5 class="mb-0">Magasinier</h5>
                                <p class="card-text text-body">Visiter le tableau de bord</p>
                              </div>
                            </div>
                          </a>

                          <a class="dropdown-item" href="{{ route('magasinier.home') }}">
                            <div class="d-flex align-items-center">
                              <div class="flex-shrink-0">
                                <img class="avatar avatar-xs avatar-4x3" src="{{ asset("dashboard/assets/svg/brands/frontapp-icon.svg") }}" alt="Image Description">
                              </div>
                              <div class="flex-grow-1 text-truncate ms-3">
                                <h5 class="mb-0">Logistique</h5>
                                <p class="card-text text-body">Visiter le tableau de bord</p>
                              </div>
                            </div>
                          </a>

                          <a class="dropdown-item" href="http://fonction-rh.test/" target="_blanc">
                            <div class="d-flex align-items-center">
                              <div class="flex-shrink-0">
                                <img class="avatar avatar-xs avatar-4x3" src="{{ asset("dashboard/assets/svg/illustrations/review-rating-shield.svg") }}" alt="Image Description">
                              </div>
                              <div class="flex-grow-1 text-truncate ms-3">
                                <h5 class="mb-0">Ressource humaine</h5>
                                <p class="card-text text-body">Visiter le tableau de bord</p>
                              </div>
                            </div>
                          </a>

                          <a class="dropdown-item" href="{{ route('admin.home') }}">
                            <div class="d-flex align-items-center">
                              <div class="flex-shrink-0">
                                <div class="avatar avatar-sm avatar-soft-dark">
                                  <span class="avatar-initials"><i class="bi-grid"></i></span>
                                </div>
                              </div>
                              <div class="flex-grow-1 text-truncate ms-3">
                                <h5 class="mb-0">Retour au tableau de bord</h5>
                                <p class="card-text text-body">Administrateur</p>
                              </div>
                            </div>
                          </a> 
                        -->
                    </div>
                    <!-- End Body -->

                    <!-- Footer -->
                    <a class="card-footer text-center" href="#">
                      Voir tout <i class="bi-chevron-right"></i>
                    </a>
                    <!-- End Footer -->
                  </div>
                </div>
              </div>
              <!-- End Apps -->
            </li>
          @endif

          <li class="nav-item d-none d-sm-inline-block">
            <!-- Activity -->
            <button class="btn btn-ghost-secondary btn-icon rounded-circle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasActivityStream" aria-controls="offcanvasActivityStream">
              <i class="bi-x-diamond"></i>
            </button>
            <!-- Activity -->
          </li>

          <li class="nav-item">
            <!-- Account -->
            <div class="dropdown">
              <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-dropdown-animation>
                <div class="avatar avatar-sm avatar-circle">
                  @if(auth()->user()->photo)
                    <img class="avatar-img" src="{{ asset(Storage::url(auth()->user()->photo)) }}" alt="Aucune photo ajouté">
                  @else
                    <img class="avatar-img" src="{{ asset("dashboard/assets/img/160x160/img9.jpg") }}" alt="Aucune photo ajouté">
                  @endif
                  <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                </div>
              </a>

              <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account" aria-labelledby="accountNavbarDropdown" style="width: 16rem;"><div class="dropdown-item-text">
                  <div class="d-flex align-items-center">
                    <div class="avatar avatar-sm avatar-circle">
                      @if(auth()->user()->photo)
                        <img class="avatar-img" src="{{ asset(Storage::url(auth()->user()->photo)) }}" alt="Aucune photo ajouté">
                      @else
                        <img class="avatar-img" src="{{ asset("dashboard/assets/img/160x160/img9.jpg") }}" alt="Aucune photo ajouté">
                      @endif
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <h5 class="mb-0">{{ auth()->user()->nom }}</h5>
                      <p class="card-text text-body">{{ auth()->user()->prenom }}</p>
                    </div>
                  </div>
                </div>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="{{ route('commercial.profil') }}"><i class="bi-people nav-icon"></i> Profil</a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('commercial.logout') }}" method="post">
                @csrf
                    <a class="dropdown-item">
                        <button type="submit" class="button-connexion">Deconnexion</button>
                    </a>
                </form>
              </div>
            </div>
            <!-- End Account -->
          </li>
        </ul>
        <!-- End Navbar -->
      </div>
    </div>
  </header>
  <!-- ========== END HEADER ========== -->

  <!-- ========== MAIN CONTENT ========== -->
  <!-- Navbar Vertical -->
  <aside class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white  ">
    <div class="navbar-vertical-container">
      <div class="navbar-vertical-footer-offset">
        <!-- Logo -->

        <a class="navbar-brand" href="index.html" aria-label="Front">
          <!-- <h3 class="fw-bold navbar-brand-logo mb-0" style="color: blue;">{{ auth()->user()->nom }} <br> {{ auth()->user()->prenom }}</h3>-->
          
          <img class="navbar-brand-logo" src="{{ asset("dashboard/img/logo1.png") }}" alt="Logo" data-hs-theme-appearance="default">
          <img class="navbar-brand-logo" src="{{ asset("dashboard/img/logo1.png") }}" alt="Logo" data-hs-theme-appearance="dark">
          <img class="navbar-brand-logo-mini" src="{{ asset("dashboard/img/logo1.png") }}" alt="Logo" data-hs-theme-appearance="default">
          <img class="navbar-brand-logo-mini" src="{{ asset("dashboard/img/logo1.png") }}" alt="Logo" data-hs-theme-appearance="dark"> 
        </a>

        <!-- End Logo -->

        <!-- Navbar Vertical Toggle -->
        <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
          <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
          <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
        </button>

        <!-- End Navbar Vertical Toggle -->

        <!-- Content -->
        <div class="navbar-vertical-content">
          <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
            <!-- Collapse -->
            <div class="nav-item">
              <a class="nav-link dropdown-toggle active" href="#navbarVerticalMenuDashboards" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuDashboards" aria-expanded="true" aria-controls="navbarVerticalMenuDashboards">
                <i class="bi-house-door nav-icon"></i>
                <span class="nav-link-title">Tableau de bord</span>
              </a>

              <div id="navbarVerticalMenuDashboards" class="nav-collapse collapse @if(Route::currentRouteName() === 'commercial.home') show @endif" data-bs-parent="#navbarVerticalMenu">
                <a class="nav-link @if(Route::currentRouteName() === 'commercial.home') active @endif" href="{{ route('commercial.home') }}">Accueil</a>
              </div>
            </div>
            <!-- End Collapse -->

            <!-- <span class="dropdown-header mt-4">Pages</span>
            <small class="bi-three-dots nav-subtitle-replacer"></small> -->

            <!-- Collapse -->
            <div class="navbar-nav nav-compact">

            </div>
            <div id="navbarVerticalMenuPagesMenu">
              
              <!-- Devis -->
              <span class="dropdown-header mt-2">Listes des devis</span>
              <div class="nav-item">
                <a  class="nav-link dropdown-toggle @if(Route::currentRouteName() === 'commercial.devis.client.create' or Route::currentRouteName() === 'commercial.devis.client.create.deux' or Route::currentRouteName() === 'commercial.devis.client.encours' or Route::currentRouteName() === 'commercial.devis.client.finalite') active @endif" 
                    href="#devis" role="button" data-bs-toggle="collapse" data-bs-target="#devis" 
                    aria-expanded="false" aria-controls="devis">
                  <i class="bi-grid-1x2 nav-icon"></i>
                  <span class="nav-link-title">Devis</span>
                </a>
                <div  id="devis" 
                      class="nav-collapse collapse @if(Route::currentRouteName() === 'commercial.devis.client.create' or Route::currentRouteName() === 'commercial.devis.client.create.deux' or Route::currentRouteName() === 'commercial.devis.client.encours' or Route::currentRouteName() === 'commercial.devis.client.finalite') show @endif" 
                      data-bs-parent="#navbarVerticalMenuPagesMenu">
                  <a class="nav-link @if(Route::currentRouteName() === 'commercial.devis.client.create' or Route::currentRouteName() === 'commercial.devis.client.create.deux') active @endif" href="{{ route('commercial.devis.client.create') }}">Etablir un(e) devis/facture</a>
                  <a class="nav-link @if(Route::currentRouteName() === 'commercial.devis.client.encours' or Route::currentRouteName() === 'commercial.devis.client.finalite') active @endif" href="{{ route('commercial.devis.client.encours') }}">Historique des devis </a>
                </div>
              </div>
              <!-- End devis -->
               
              <span class="dropdown-header mt-2">Listes des Factures émises</span>
              <div class="nav-item">
                <a  class="nav-link dropdown-toggle 
                    @if(Route::currentRouteName() === 'commercial.facture.client.impaye' or Route::currentRouteName() === 'commercial.facture.client.partielle' or Route::currentRouteName() === 'commercial.facture.client.paye'
                    ) active @endif" 
                    href="#facture" role="button" data-bs-toggle="collapse" data-bs-target="#facture" 
                    aria-expanded="false" aria-controls="facture">
                  <i class="bi-grid-1x2 nav-icon"></i>
                  <span class="nav-link-title">Factures émises</span>
                </a>

                <div  id="facture" 
                      class="nav-collapse collapse 
                      @if(Route::currentRouteName() === 'commercial.facture.client.impaye' or Route::currentRouteName() === 'commercial.facture.client.partielle' or Route::currentRouteName() === 'commercial.facture.client.paye'
                      ) show @endif" 
                      data-bs-parent="#navbarVerticalMenuPagesMenu">
                  <a class="nav-link @if(Route::currentRouteName() === 'commercial.facture.client.impaye') active @endif" href="{{ route('commercial.facture.client.impaye') }}">Factures impayées</a>
                  <a class="nav-link @if(Route::currentRouteName() === 'commercial.facture.client.partielle') active @endif" href="{{ route('commercial.facture.client.partielle') }}">Factures partielle</a>
                  <a class="nav-link @if(Route::currentRouteName() === 'commercial.facture.client.paye') active @endif" href="{{ route('commercial.facture.client.paye') }}">Factures finalisées</a>
                </div>
              </div>
              
              <!-- @if(!auth()->user()->role)
              @endif -->
                <span class="dropdown-header mt-2">Mes apports</span>
                <div class="nav-item">
                  <a class="nav-link  @if(Route::currentRouteName() === 'commercial.statistique') active @endif" href="{{ route('commercial.statistique') }}" data-placement="left">
                    <i class="bi-people nav-icon"></i>
                    <span class="nav-link-title">Mes apports</span>
                  </a>
                </div>

              <span class="dropdown-header mt-2">Statistique</span>
              <div class="nav-item">
                <a class="nav-link  @if(Route::currentRouteName() === 'commercial.statistique.annee' or Route::currentRouteName() === 'commercial.statistique.mois') active @endif" href="{{ route('commercial.statistique.annee') }}" data-placement="left">
                  <i class="bi-people nav-icon"></i>
                  <span class="nav-link-title">Mes statistiques</span>
                </a>
              </div>

              <span class="dropdown-header mt-2">Listes des clients</span>
              <div class="nav-item">
                <a class="nav-link  @if(Route::currentRouteName() === 'commercial.client.index' or Route::currentRouteName() === 'commercial.client.edit' or Route::currentRouteName() === 'commercial.client.create') active @endif" href="{{ route('commercial.client.index') }}" data-placement="left">
                  <i class="bi-people nav-icon"></i>
                  <span class="nav-link-title">Client</span>
                </a>
              </div>

              <span class="dropdown-header mt-2">Listes des remises</span>
              <div class="nav-item">
                <a class="nav-link  @if(Route::currentRouteName() === 'commercial.client.remise') active @endif" href="{{ route('commercial.client.remise') }}" data-placement="left">
                  <i class="bi-people nav-icon"></i>
                  <span class="nav-link-title">remise client</span>
                </a>
              </div>
              
                <span class="dropdown-header mt-2">Historique des stocks</span>
                <div class="nav-item">
                  <a class="nav-link @if(Route::currentRouteName() === 'commercial.stock.global.produit') active @endif"
                    href="#" data-placement="left"
                    data-bs-toggle="modal" data-bs-target="#entrepotProduit">
                    <i class="bi-people nav-icon"></i>
                    <span class="nav-link-title">Stock Produits</span>
                  </a>
                </div>

              @if(auth()->user()->role)
                <span class="dropdown-header mt-2">Liste des commercials</span>
                <div class="nav-item">
                  <a class="nav-link 
                            @if(Route::currentRouteName() === 'commercial.commercial.index' or Route::currentRouteName() === 'commercial.commercial.edit' or Route::currentRouteName() === 'commercial.commercial.edit' or
                                Route::currentRouteName() === 'commercial.commercial.statistique.mois' or Route::currentRouteName() === 'commercial.commercial.statistique.annee' or Route::currentRouteName() === 'commercial.commercial.statistique') 
                              active @endif" 
                      href="{{ route('commercial.commercial.index') }}" data-placement="left">
                    <i class="bi-people nav-icon"></i>
                    <span class="nav-link-title">Commercial</span>
                  </a>
                </div>
              
                <span class="dropdown-header mt-2">Liste des projet</span>
                <div class="nav-item">
                  <a class="nav-link @if(Route::currentRouteName() === 'commercial.projet' or Route::currentRouteName() === 'commercial.projet.tache') active @endif" href="{{ route('commercial.projet') }}" data-placement="left">
                    <i class="bi-people nav-icon"></i>
                    <span class="nav-link-title">Projet</span>
                  </a>
                </div>
              @endif

              <span class="dropdown-header mt-2">Profil</span>
              <div class="nav-item">
                <a class="nav-link  @if(Route::currentRouteName() === 'commercial.profil') active @endif" href="{{ route('commercial.profil') }}" data-placement="left">
                  <i class="bi-people nav-icon"></i>
                  <span class="nav-link-title">Mon profil</span>
                </a>
              </div>

            </div>
            <!-- End Collapse -->
             
          </div>
        </div>
        <!-- End Content -->

        <!-- Footer -->
        <div class="navbar-vertical-footer">
          <ul class="navbar-vertical-footer-list">
            <li class="navbar-vertical-footer-list-item">
              <!-- Style Switcher -->
              <div class="dropdown dropup">
                <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>

                </button>

                <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectThemeDropdown">
                  <a class="dropdown-item" href="#" data-icon="bi-moon-stars" data-value="auto">
                    <i class="bi-moon-stars me-2"></i>
                    <span class="text-truncate" title="Auto (system default)">Auto (system default)</span>
                  </a>
                  <a class="dropdown-item" href="#" data-icon="bi-brightness-high" data-value="default">
                    <i class="bi-brightness-high me-2"></i>
                    <span class="text-truncate" title="Default (light mode)">Default (light mode)</span>
                  </a>
                  <a class="dropdown-item active" href="#" data-icon="bi-moon" data-value="dark">
                    <i class="bi-moon me-2"></i>
                    <span class="text-truncate" title="Dark">Dark</span>
                  </a>
                </div>
              </div>

              <!-- End Style Switcher -->
            </li>

            <li class="navbar-vertical-footer-list-item">
              <!-- Other Links -->
              <div class="dropdown dropup">
                <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="otherLinksDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>
                  <i class="bi-info-circle"></i>
                </button>

                <div class="dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="otherLinksDropdown">
                  <span class="dropdown-header">Help</span>
                  <a class="dropdown-item" href="#">
                    <i class="bi-journals dropdown-item-icon"></i>
                    <span class="text-truncate" title="Resources &amp; tutorials">Resources &amp; tutorials</span>
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="bi-command dropdown-item-icon"></i>
                    <span class="text-truncate" title="Keyboard shortcuts">Keyboard shortcuts</span>
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="bi-alt dropdown-item-icon"></i>
                    <span class="text-truncate" title="Connect other apps">Connect other apps</span>
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="bi-gift dropdown-item-icon"></i>
                    <span class="text-truncate" title="What's new?">What's new?</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <span class="dropdown-header">Contacts</span>
                  <a class="dropdown-item" href="#">
                    <i class="bi-chat-left-dots dropdown-item-icon"></i>
                    <span class="text-truncate" title="Contact support">Contact support</span>
                  </a>
                </div>
              </div>
              <!-- End Other Links -->
            </li>

            <li class="navbar-vertical-footer-list-item">
              <!-- Language -->
              <div class="dropdown dropup">
                <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="selectLanguageDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>
                  <img class="avatar avatar-xss avatar-circle" src="assets/vendor/flag-icon-css/flags/1x1/us.svg" alt="United States Flag">
                </button>

                <div class="dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectLanguageDropdown">
                  <span class="dropdown-header">Select language</span>
                  <a class="dropdown-item" href="#">
                    <img class="avatar avatar-xss avatar-circle me-2" src="assets/vendor/flag-icon-css/flags/1x1/us.svg" alt="Flag">
                    <span class="text-truncate" title="English">English (US)</span>
                  </a>
                  <a class="dropdown-item" href="#">
                    <img class="avatar avatar-xss avatar-circle me-2" src="assets/vendor/flag-icon-css/flags/1x1/gb.svg" alt="Flag">
                    <span class="text-truncate" title="English">English (UK)</span>
                  </a>
                  <a class="dropdown-item" href="#">
                    <img class="avatar avatar-xss avatar-circle me-2" src="assets/vendor/flag-icon-css/flags/1x1/de.svg" alt="Flag">
                    <span class="text-truncate" title="Deutsch">Deutsch</span>
                  </a>
                  <a class="dropdown-item" href="#">
                    <img class="avatar avatar-xss avatar-circle me-2" src="assets/vendor/flag-icon-css/flags/1x1/dk.svg" alt="Flag">
                    <span class="text-truncate" title="Dansk">Dansk</span>
                  </a>
                  <a class="dropdown-item" href="#">
                    <img class="avatar avatar-xss avatar-circle me-2" src="assets/vendor/flag-icon-css/flags/1x1/it.svg" alt="Flag">
                    <span class="text-truncate" title="Italiano">Italiano</span>
                  </a>
                  <a class="dropdown-item" href="#">
                    <img class="avatar avatar-xss avatar-circle me-2" src="assets/vendor/flag-icon-css/flags/1x1/cn.svg" alt="Flag">
                    <span class="text-truncate" title="中文 (繁體)">中文 (繁體)</span>
                  </a>
                </div>
              </div>

              <!-- End Language -->
            </li>
          </ul>
        </div>
        <!-- End Footer -->
      </div>
    </div>
  </aside>
  <!-- End Navbar Vertical -->