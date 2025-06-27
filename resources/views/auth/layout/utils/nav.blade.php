
	<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
          <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="#">
              <img class="navbar-brand-logo" src="{{ asset("dashboard/img/logo1.jpg") }}" alt="Logo" style="width: 108px;">
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2 @if(Route::currentRouteName() === 'comptable.login') active @endif" aria-current="page" href="{{ route('comptable.login') }}">
                    <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                    Comptable
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2 @if(Route::currentRouteName() === 'commercial.login') active @endif" href="{{ route('commercial.login') }}">
                    <i class="fa fa-user opacity-6 text-dark me-1"></i>
                    Commercial
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2 @if(Route::currentRouteName() === 'magasinier.login') active @endif" href="{{ route('magasinier.login') }}">
                    <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                    Magasinier
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2 @if(Route::currentRouteName() === 'logistique.login') active @endif" href="{{ route('logistique.login') }}">
                    <i class="fas fa-key opacity-6 text-dark me-1"></i>
                    Logistique
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2 @if(Route::currentRouteName() === 'ressource.login') active @endif" href="{{ route('ressource.login') }}">
                    <i class="fas fa-key opacity-6 text-dark me-1"></i>
                    Ressource Humaine
                  </a>
                </li>
              </ul>
              <ul class="navbar-nav d-lg-block d-none">
                <li class="nav-item">
                  <a href="#" class="btn btn-sm mb-0 me-1 btn-primary">Page de connexion</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>