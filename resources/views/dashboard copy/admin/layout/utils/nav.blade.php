    <!-- START Wrapper -->
    <div class="wrapper">

        <!-- ========== Topbar Start ========== -->
        <header class="topbar">
             <div class="container-fluid">
                  <div class="navbar-header">
                       <div class="d-flex align-items-center">
                            <!-- Menu Toggle Button -->
                            <div class="topbar-item">
                                 <button type="button" class="button-toggle-menu me-2">
                                      <iconify-icon icon="solar:hamburger-menu-broken" class="fs-24 align-middle"></iconify-icon>
                                 </button>
                            </div>

                              <!-- Menu Toggle Button -->
                              <div class="topbar-item">
                                   <h4 class="fw-bold topbar-button pe-none mb-0">
                                        {{ auth()->user()->nom }} {{ auth()->user()->prenom }} 
                                        <span class="text-warning">
                                             @if(auth()->user()->role) 
                                                  (Superviseur) 
                                             @else 
                                                  @if(!auth()->user()->adminsecteur->secteur_id) 
                                                       (Super Admin)
                                                  @else (Admin) @endif 
                                             @endif
                                        </span>
                                   </h4>
                              </div>
                       </div>

                       <div class="d-flex align-items-center gap-1">

                            <!-- App Search-->
                            <form action="{{ route('admin.recherche.produit') }}" method="get" class="app-search d-none d-md-block me-2">
                                 <div class="position-relative">
                                      <input type="search" name="search" deseable placeholder="Rechercher un produit" value="{{ request()->search ?? '' }}" class="form-control" autocomplete="off" value="">
                                      <iconify-icon icon="solar:magnifer-linear" class="search-widget-icon"></iconify-icon>
                                      @error('search') <span class="text-danger color">{{ $message }}</span> @enderror
                                 </div>
                            </form>

                            <!-- Theme Color (Light/Dark) -->
                            <div class="topbar-item">
                                 <button type="button" class="topbar-button" id="light-dark-mode">
                                      <iconify-icon icon="solar:moon-outline" class="fs-24 align-middle"></iconify-icon>
                                 </button>
                            </div>

                            <!-- Notification -->
                            <!-- <div class="dropdown topbar-item">
                                 <button type="button" class="topbar-button position-relative" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <iconify-icon icon="solar:bell-bing-outline" class="fs-24 align-middle"></iconify-icon>
                                      <span class="position-absolute topbar-badge fs-10 translate-middle badge bg-danger rounded-pill">3<span class="visually-hidden">unread messages</span></span>
                                 </button>
                                 <div class="dropdown-menu py-0 dropdown-lg dropdown-menu-end" aria-labelledby="page-header-notifications-dropdown">
                                      <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                                           <div class="row align-items-center">
                                                <div class="col">
                                                     <h6 class="m-0 fs-16 fw-semibold"> Notifications</h6>
                                                </div>
                                                <div class="col-auto">
                                                     <a href="javascript: void(0);" class="text-dark text-decoration-underline">
                                                          <small>Clear All</small>
                                                     </a>
                                                </div>
                                           </div>
                                      </div>
                                      <div data-simplebar style="max-height: 280px;">
                                           <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom text-wrap">
                                                <div class="d-flex">
                                                     <div class="flex-shrink-0">
                                                          <img src="assets/images/users/avatar-1.jpg" class="img-fluid me-2 avatar-sm rounded-circle" alt="avatar-1" />
                                                     </div>
                                                     <div class="flex-grow-1">
                                                          <p class="mb-0"><span class="fw-medium">Josephine Thompson </span>commented on admin panel <span>" Wow 😍! this admin looks good and awesome design"</span></p>
                                                     </div>
                                                </div>
                                           </a>
                                           <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                                <div class="d-flex">
                                                     <div class="flex-shrink-0">
                                                          <div class="avatar-sm me-2">
                                                               <span class="avatar-title bg-soft-info text-info fs-20 rounded-circle">
                                                                    D
                                                               </span>
                                                          </div>
                                                     </div>
                                                     <div class="flex-grow-1">
                                                          <p class="mb-0 fw-semibold">Donoghue Susan</p>
                                                          <p class="mb-0 text-wrap">
                                                               Hi, How are you? What about our next meeting
                                                          </p>
                                                     </div>
                                                </div>
                                           </a>
                                           <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                                <div class="d-flex">
                                                     <div class="flex-shrink-0">
                                                          <img src="assets/images/users/avatar-3.jpg" class="img-fluid me-2 avatar-sm rounded-circle" alt="avatar-3" />
                                                     </div>
                                                     <div class="flex-grow-1">
                                                          <p class="mb-0 fw-semibold">Jacob Gines</p>
                                                          <p class="mb-0 text-wrap">Answered to your comment on the cash flow forecast's graph 🔔.</p>
                                                     </div>
                                                </div>
                                           </a>
                                           <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                                <div class="d-flex">
                                                     <div class="flex-shrink-0">
                                                          <div class="avatar-sm me-2">
                                                               <span class="avatar-title bg-soft-warning text-warning fs-20 rounded-circle">
                                                                    <iconify-icon icon="iconamoon:comment-dots-duotone"></iconify-icon>
                                                               </span>
                                                          </div>
                                                     </div>
                                                     <div class="flex-grow-1">
                                                          <p class="mb-0 fw-semibold text-wrap">You have received <b>20</b> new messages in the
                                                               conversation</p>
                                                     </div>
                                                </div>
                                           </a>
                                           <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                                <div class="d-flex">
                                                     <div class="flex-shrink-0">
                                                          <img src="assets/images/users/avatar-5.jpg" class="img-fluid me-2 avatar-sm rounded-circle" alt="avatar-5" />
                                                     </div>
                                                     <div class="flex-grow-1">
                                                          <p class="mb-0 fw-semibold">Shawn Bunch</p>
                                                          <p class="mb-0 text-wrap">
                                                               Commented on Admin
                                                          </p>
                                                     </div>
                                                </div>
                                           </a>
                                      </div>
                                      <div class="text-center py-3">
                                           <a href="javascript:void(0);" class="btn btn-primary btn-sm">View All Notification <i class="bx bx-right-arrow-alt ms-1"></i></a>
                                      </div>
                                 </div>
                            </div> -->

                            <!-- Theme Setting -->
                            <div class="topbar-item d-none d-md-flex">
                                 <button type="button" class="topbar-button" id="theme-settings-btn" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
                                      <iconify-icon icon="solar:settings-outline" class="fs-24 align-middle"></iconify-icon>
                                 </button>
                            </div>

                            <!-- Activity -->
                            <div class="topbar-item">
                                 <button type="button" class="topbar-button rightbar-toggle-button" data-bs-toggle="offcanvas" data-bs-target="#rightbar-offcanvas" aria-controls="theme-settings-offcanvas">
                                      <iconify-icon icon="solar:clock-circle-outline" class="fs-24 align-middle"></iconify-icon>
                                 </button>
                            </div>

                            <!-- User -->
                            <div class="dropdown topbar-item">
                                <a type="button" class="topbar-button" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="d-flex align-items-center">
                                        @if(auth()->user()->photo)
                                             <img class="rounded-circle img-thumbnail shadow" width="42" src="{{ asset(Storage::url(auth()->user()->photo)) }}" alt="avatar-3">
                                        @else
                                             <img class="rounded-circle img-thumbnail shadow" width="42" src="{{ asset("admin/assets/images/users/avatar-1.jpg") }}" alt="avatar-3">
                                        @endif
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <h6 class="dropdown-header">Bienvenue {{ auth()->user()->nom }}</h6>
                                    <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                        <i class="bx bx-user-circle text-muted fs-18 align-middle me-1"></i><span class="align-middle">Profile</span>
                                    </a>
                                    <!-- <a class="dropdown-item" href="apps-chat.html">
                                        <i class="bx bx-message-dots text-muted fs-18 align-middle me-1"></i><span class="align-middle">Messages</span>
                                    </a>

                                    <a class="dropdown-item" href="pages-pricing.html">
                                        <i class="bx bx-wallet text-muted fs-18 align-middle me-1"></i><span class="align-middle">Pricing</span>
                                    </a>
                                    <a class="dropdown-item" href="pages-faqs.html">
                                        <i class="bx bx-help-circle text-muted fs-18 align-middle me-1"></i><span class="align-middle">Help</span>
                                    </a>
                                    <a class="dropdown-item" href="auth-lock-screen.html">
                                        <i class="bx bx-lock text-muted fs-18 align-middle me-1"></i><span class="align-middle">Lock screen</span>
                                    </a> 
                                    <a class="dropdown-item text-danger" id="admin-logout-form" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                                        <i class="bx bx-log-out fs-18 align-middle me-1"></i><span class="align-middle">Deconnexion</span>
                                    </a>-->

                                    <div class="dropdown-divider my-1"></div>

                                   <form action="{{ route('admin.logout') }}" method="post">
                                   @csrf
                                        <a class="dropdown-item text-danger">
                                             <button type="submit"><i class="bx bx-log-out fs-18 align-middle me-1"></i><span class="align-middle">Deconnexion</span></button>
                                        </a>
                                   </form>

                                </div>
                            </div>
                       </div>
                  </div>
             </div>
        </header>
        <!-- ========== Topbar End ========== -->

        <!-- ========== App Menu Start ========== -->
        <div class="main-nav">
             <!-- Sidebar Logo -->
             <div class="logo-box">

                    <!-- <a href="{{ route('accueil') }}" class="logo-dark d-flex">
                         <img src="{{ asset("principale/assets/img/logo/logo1.jpg") }}" class="logo-sm" alt="logo sm">
                         <span class="text-danger">Ravmel</span>
                    </a> -->

                  <a href="#" class="logo-dark">
                       <img src="{{ asset("principale/assets/img/logo/logo.png") }}" class="logo-sm" alt="logo sm" style="width: 70%; height: auto;">
                       <img src="{{ asset("principale/assets/img/logo/logo.png") }}" class="logo-lg" alt="logo dark" style="width: 70%; height: auto;">
                  </a>

                  <a href="#" class="logo-light" style="align-items: center;">
                       <img src="{{ asset("principale/assets/img/logo/logo.png") }}" class="logo-sm" alt="logo sm" style="width: 70%; height: auto;">
                       <img src="{{ asset("principale/assets/img/logo/logo.png") }}" class="logo-lg" alt="logo light" style="width: 70%; height: auto;">
                  </a>
             </div>

             <!-- Menu Toggle Button (sm-hover) -->
             <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
                  <iconify-icon icon="solar:hamburger-menu-line-duotone" class="button-sm-hover-icon fs-28"></iconify-icon>
             </button>

             <div class="scrollbar" data-simplebar>
                  <ul class="navbar-nav" id="navbar-nav">

                  <li class="menu-title">Menu principal</li>
                         <li class="nav-item active">
                              <a class="nav-link active bg-white" href="{{ route('accueil') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:case-round-outline"></iconify-icon>
                                   </span>
                                   <span class="nav-text">Menu principal </span>
                              </a>
                         </li>

                         <li class="menu-title">Bienvenue</li>
                         <li class="nav-item @if(Route::currentRouteName() === 'admin.home' or Route::currentRouteName() === 'admin.historique.solde') active @endif">
                              <a class="nav-link @if(Route::currentRouteName() === 'admin.home' or Route::currentRouteName() === 'admin.historique.solde') active @endif" href="{{ route('admin.home') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:widget-5-outline"></iconify-icon>
                                   </span>
                                   <span class="nav-text">Accueil </span>
                              </a>
                         </li>

                         <li class="menu-title">Stock des produits</li>
                         <li class="nav-item @if(Route::currentRouteName() === 'admin.stock.global.produit.un' or Route::currentRouteName() === 'admin.stock.global.produit.deux') active @endif">
                              <a class="nav-link @if(Route::currentRouteName() === 'admin.stock.global.produit.un' or Route::currentRouteName() === 'admin.stock.global.produit.deux') active @endif" href="{{ route('admin.stock.global.produit.un') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:widget-5-outline"></iconify-icon>
                                   </span>
                                   <span class="nav-text">Stock des produits </span>
                              </a>
                         </li>
                         <!--
                              <li class="menu-title">Mes Vendeurs</li>
                              <li class="nav-item">
                                   <a class="nav-link menu-arrow @if(Route::currentRouteName() === 'admin.home') active @endif" href="#sidebarEcommerce" data-bs-toggle="collapse" role="button"
                                        aria-expanded="false" aria-controls="sidebarEcommerce">
                                        <span class="nav-icon">
                                             <iconify-icon icon="solar:cart-large-4-outline"></iconify-icon>
                                        </span>
                                        <span class="nav-text"> Vendeurs </span>
                                   </a>
                                   <div class="collapse @if(Route::currentRouteName() === 'admin.home') show @endif" id="sidebarEcommerce">
                                        <ul class="nav sub-navbar-nav">
                                             <li class="sub-nav-item @if(Route::currentRouteName() === 'admin.home') active @endif">
                                                  <a class="sub-nav-link @if(Route::currentRouteName() === 'admin.home') active @endif" href="ecommerce-product-grid.html">Grid</a>
                                             </li>
                                             <li class="sub-nav-item">
                                                  <a class="sub-nav-link" href="ecommerce-product-list.html">List</a>
                                             </li>
                                             <li class="sub-nav-item">
                                                  <a class="sub-nav-link" href="ecommerce-product-details.html">Details</a>
                                             </li>
                                             <li class="sub-nav-item">
                                                  <a class="sub-nav-link" href="ecommerce-product-edit.html">Edit</a>
                                             </li>
                                             <li class="sub-nav-item">
                                                  <a class="sub-nav-link" href="ecommerce-product-add.html">Create</a>
                                             </li>
                                        </ul>
                                   </div>
                              </li>
                         -->

                         <li class="menu-title">Mes Zones de Livraison</li>
                         <li class="nav-item @if(Route::currentRouteName() === 'admin.secteur.index' or Route::currentRouteName() === 'admin.secteur.create' or Route::currentRouteName() === 'admin.secteur.edit') active @endif">
                              <a class="nav-link @if(Route::currentRouteName() === 'admin.secteur.index' or Route::currentRouteName() === 'admin.secteur.create' or Route::currentRouteName() === 'admin.secteur.edit') active @endif" href="{{ route('admin.secteur.index') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:checklist-outline"></iconify-icon>
                                   </span>
                                   <span class="nav-text">Zones de Livraison</span>
                              </a>
                         </li>

                         <li class="menu-title">Les Boutiques</li>
                         <li class="nav-item">
                              <a class="nav-link menu-arrow @if(Route::currentRouteName() === 'admin.vendeur.index' or Route::currentRouteName() === 'admin.vendeur.create' or Route::currentRouteName() === 'admin.vendeur.edit' or Route::currentRouteName() === 'admin.vendeur.produit') active @endif" href="#sidebarPages" data-bs-toggle="collapse" role="button"
                                   aria-expanded="false" aria-controls="sidebarPages">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:user-block-rounded-outline"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Boutiques </span>
                              </a>
                              <div class="collapse @if(Route::currentRouteName() === 'admin.vendeur.index' or Route::currentRouteName() === 'admin.vendeur.create' or Route::currentRouteName() === 'admin.vendeur.edit' or Route::currentRouteName() === 'admin.vendeur.produit') show @endif" id="sidebarPages">
                                   <ul class="nav sub-navbar-nav">
                                        <li class="sub-nav-item @if(Route::currentRouteName() === 'admin.vendeur.index' or Route::currentRouteName() === 'admin.vendeur.edit' or Route::currentRouteName() === 'admin.vendeur.produit') active @endif">
                                             <a class="sub-nav-link @if(Route::currentRouteName() === 'admin.vendeur.index' or Route::currentRouteName() === 'admin.vendeur.edit' or Route::currentRouteName() === 'admin.vendeur.produit') active @endif" href="{{ route('admin.vendeur.index') }}">Mes boutiques</a>
                                        </li>
                                        <li class="sub-nav-item @if(Route::currentRouteName() === 'admin.vendeur.create') active @endif">
                                             <a class="sub-nav-link @if(Route::currentRouteName() === 'admin.vendeur.create') active @endif" href="{{ route('admin.vendeur.create') }}">Ajouter</a>
                                        </li>
                                   </ul>
                              </div>
                         </li>

                         <li class="menu-title">Mes Catégorie de produit</li>
                         <li class="nav-item @if(Route::currentRouteName() === 'admin.categorie.index' or Route::currentRouteName() === 'admin.categorie.create' or Route::currentRouteName() === 'admin.categorie.edit' or Route::currentRouteName() === 'admin.categorie.souscategorie') active @endif">
                              <a class="nav-link @if(Route::currentRouteName() === 'admin.categorie.index' or Route::currentRouteName() === 'admin.categorie.create' or Route::currentRouteName() === 'admin.categorie.edit' or Route::currentRouteName() === 'admin.categorie.souscategorie') active @endif" href="{{ route('admin.categorie.index') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:checklist-outline"></iconify-icon>
                                   </span>
                                   <span class="nav-text">Catégorie </span>
                              </a>
                         </li>

                         <li class="menu-title">Mes Sous Catégorie</li>
                         <li class="nav-item @if(Route::currentRouteName() === 'admin.scategorie.index' or Route::currentRouteName() === 'admin.scategorie.create' or Route::currentRouteName() === 'admin.scategorie.edit') active @endif">
                              <a class="nav-link @if(Route::currentRouteName() === 'admin.scategorie.index' or Route::currentRouteName() === 'admin.scategorie.create' or Route::currentRouteName() === 'admin.scategorie.edit') active @endif" href="{{ route('admin.scategorie.index') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:document-text-outline"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Sous Catégorie </span>
                              </a>
                         </li>
                         
                         <li class="menu-title">Mes Produits</li>
                         <li class="nav-item">
                              <a class="nav-link menu-arrow @if(Route::currentRouteName() === 'admin.produit.index' or Route::currentRouteName() === 'admin.produit.create' or Route::currentRouteName() === 'admin.produit.edit' or Route::currentRouteName() === 'admin.sous.categorie.produit' or Route::currentRouteName() === 'admin.recherche.produit' or Route::currentRouteName() === 'admin.produit.reconditionne') active @endif" href="#sidebarForms" data-bs-toggle="collapse" role="button"
                                   aria-expanded="false" aria-controls="sidebarTables">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:cart-large-4-outline"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Produit </span>
                              </a>
                              <div class="collapse @if(Route::currentRouteName() === 'admin.produit.index' or Route::currentRouteName() === 'admin.produit.create' or Route::currentRouteName() === 'admin.produit.edit' or Route::currentRouteName() === 'admin.sous.categorie.produit' or Route::currentRouteName() === 'admin.recherche.produit' or Route::currentRouteName() === 'admin.produit.reconditionne') show @endif" id="sidebarForms">
                                   <ul class="nav sub-navbar-nav">
                                        <li class="sub-nav-item @if(Route::currentRouteName() === 'admin.produit.index' or Route::currentRouteName() === 'admin.produit.edit' or Route::currentRouteName() === 'admin.sous.categorie.produit' or Route::currentRouteName() === 'admin.recherche.produit') active @endif">
                                             <a class="sub-nav-link @if(Route::currentRouteName() === 'admin.produit.index' or Route::currentRouteName() === 'admin.produit.edit' or Route::currentRouteName() === 'admin.sous.categorie.produit' or Route::currentRouteName() === 'admin.recherche.produit') active @endif" href="{{ route('admin.produit.index') }}">Mes Produits</a>
                                        </li>
                                        <li class="sub-nav-item @if(Route::currentRouteName() === 'admin.produit.reconditionne') active @endif">
                                             <a class="sub-nav-link @if(Route::currentRouteName() === 'admin.produit.reconditionne') active @endif" href="{{ route('admin.produit.reconditionne') }}">Mes Produits Reconditionnés</a>
                                        </li>
                                        <li class="sub-nav-item @if(Route::currentRouteName() === 'admin.produit.create') active @endif">
                                             <a class="sub-nav-link @if(Route::currentRouteName() === 'admin.produit.create') active @endif" href="{{ route('admin.produit.create') }}">Ajouter</a>
                                        </li>
                                   </ul>
                              </div>
                         </li>

                         <li class="menu-title">Mes Commandes reçues</li>
                         <li class="nav-item @if(Route::currentRouteName() === 'admin.nouvelle.commande' or Route::currentRouteName() === 'admin.livraison.effectue' or Route::currentRouteName() === 'admin.commande.produit') active @endif">
                              <a class="nav-link @if(Route::currentRouteName() === 'admin.nouvelle.commande' or Route::currentRouteName() === 'admin.livraison.effectue' or Route::currentRouteName() === 'admin.commande.produit') active @endif" href="{{ route('admin.nouvelle.commande') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:cart-large-4-outline"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Mes Commandes </span>
                              </a>
                         </li>

                         <li class="menu-title">Mes livreurs</li>
                         <li class="nav-item @if(Route::currentRouteName() === 'admin.livreur.index' or Route::currentRouteName() === 'admin.livreur.create' or Route::currentRouteName() === 'admin.livreur.edit') active @endif">
                              <a class="nav-link @if(Route::currentRouteName() === 'admin.livreur.index' or Route::currentRouteName() === 'admin.livreur.create' or Route::currentRouteName() === 'admin.livreur.edit') active @endif" href="{{ route('admin.livreur.index') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:document-text-outline"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Mes livreurs </span>
                              </a>
                         </li>
                         
                         <li class="menu-title">Mes Formations</li>
                         <li class="nav-item">
                              <a class="nav-link menu-arrow @if(Route::currentRouteName() === 'admin.formation.index' or Route::currentRouteName() === 'admin.formation.terminer' or Route::currentRouteName() === 'admin.formation.create' or Route::currentRouteName() === 'admin.formation.edit' or Route::currentRouteName() === 'admin.postulation.formation' or Route::currentRouteName() === 'admin.formation.formateur.encours') active @endif" href="#sidebarCharts" data-bs-toggle="collapse" role="button"
                                   aria-expanded="false" aria-controls="sidebarCharts">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:checklist-outline"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Formations </span>
                              </a>
                              <div class="collapse @if(Route::currentRouteName() === 'admin.formation.index' or Route::currentRouteName() === 'admin.formation.terminer' or Route::currentRouteName() === 'admin.formation.create' or Route::currentRouteName() === 'admin.formation.edit' or Route::currentRouteName() === 'admin.postulation.formation' or Route::currentRouteName() === 'admin.formation.formateur.encours') show @endif" id="sidebarCharts">
                                   <ul class="nav sub-navbar-nav">
                                        <li class="sub-nav-item @if(Route::currentRouteName() === 'admin.formation.index' or Route::currentRouteName() === 'admin.formation.edit' or Route::currentRouteName() === 'admin.postulation.formation' or Route::currentRouteName() === 'admin.formation.formateur.encours') active @endif">
                                             <a class="sub-nav-link @if(Route::currentRouteName() === 'admin.formation.index' or Route::currentRouteName() === 'admin.formation.edit' or Route::currentRouteName() === 'admin.postulation.formation' or Route::currentRouteName() === 'admin.formation.formateur.encours') active @endif" href="{{ route('admin.formation.index') }}">Formations encours</a>
                                        </li>
                                        <li class="sub-nav-item @if(Route::currentRouteName() === 'admin.formation.create') active @endif">
                                             <a class="sub-nav-link @if(Route::currentRouteName() === 'admin.formation.create') active @endif" href="{{ route('admin.formation.create') }}">Ajouter</a>
                                        </li>
                                        <li class="sub-nav-item @if(Route::currentRouteName() === 'admin.formation.terminer') active @endif">
                                             <a class="sub-nav-link @if(Route::currentRouteName() === 'admin.formation.terminer') active @endif" href="{{ route('admin.formation.terminer') }}">Formations terminées</a>
                                        </li>
                                   </ul>
                              </div>
                         </li>

                         <li class="menu-title">Mes formateurs</li>
                         <li class="nav-item @if(Route::currentRouteName() === 'admin.formateur.index' or Route::currentRouteName() === 'admin.formateur.create' or Route::currentRouteName() === 'admin.formateur.edit') active @endif">
                              <a class="nav-link @if(Route::currentRouteName() === 'admin.formateur.index' or Route::currentRouteName() === 'admin.formateur.create' or Route::currentRouteName() === 'admin.formateur.edit') active @endif" href="{{ route('admin.formateur.index') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:document-text-outline"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Mes formateurs </span>
                              </a>
                         </li>

                         <li class="menu-title">Mon équipe</li>
                         <li class="nav-item @if(Route::currentRouteName() === 'admin.equipe.index' or Route::currentRouteName() === 'admin.equipe.create' or Route::currentRouteName() === 'admin.equipe.edit') active @endif">
                              <a class="nav-link @if(Route::currentRouteName() === 'admin.equipe.index' or Route::currentRouteName() === 'admin.equipe.create' or Route::currentRouteName() === 'admin.equipe.edit') active @endif" href="{{ route('admin.equipe.index') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:document-text-outline"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Mon équipe </span>
                              </a>
                         </li>

                         <li class="menu-title">Mes Astuces et Conseils</li>
                         <li class="nav-item @if(Route::currentRouteName() === 'admin.conseilastuce.index' or Route::currentRouteName() === 'admin.conseilastuce.create' or Route::currentRouteName() === 'admin.conseilastuce.edit') active @endif">
                              <a class="nav-link @if(Route::currentRouteName() === 'admin.conseilastuce.index' or Route::currentRouteName() === 'admin.conseilastuce.create' or Route::currentRouteName() === 'admin.conseilastuce.edit') active @endif" href="{{ route('admin.conseilastuce.index') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:document-text-outline"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Astuces et Conseils </span>
                              </a>
                         </li>
                         
                         <li class="menu-title">Mes messages reçus</li>
                         <li class="nav-item @if(Route::currentRouteName() === 'admin.message') active @endif">
                              <a class="nav-link @if(Route::currentRouteName() === 'admin.message') active @endif" href="{{ route('admin.message') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:chat-round-outline"></iconify-icon>
                                   </span>
                                   <span class="nav-text">Message </span>
                              </a>
                         </li>

                         <li class="menu-title">Mon profile</li>
                         <li class="nav-item">
                              <a class="nav-link menu-arrow @if(Route::currentRouteName() === 'admin.admin.index' or Route::currentRouteName() === 'admin.admin.create' or Route::currentRouteName() === 'admin.admin.edit' or Route::currentRouteName() === 'admin.profile') active @endif" href="#sidebarExtendedUI" data-bs-toggle="collapse" role="button"
                                   aria-expanded="false" aria-controls="sidebarExtendedUI">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:checklist-outline"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Profile Admin </span>
                              </a>
                              <div class="collapse @if(Route::currentRouteName() === 'admin.admin.index' or Route::currentRouteName() === 'admin.admin.create' or Route::currentRouteName() === 'admin.admin.edit' or Route::currentRouteName() === 'admin.profile') show @endif" id="sidebarExtendedUI">
                                   <ul class="nav sub-navbar-nav">
                                        <li class="sub-nav-item @if(Route::currentRouteName() === 'admin.profile') active @endif">
                                             <a class="sub-nav-link @if(Route::currentRouteName() === 'admin.profile') active @endif" href="{{ route('admin.profile') }}">Profile</a>
                                        </li>
                                        <li class="sub-nav-item @if(Route::currentRouteName() === 'admin.admin.index' or Route::currentRouteName() === 'admin.admin.create' or Route::currentRouteName() === 'admin.admin.edit') active @endif">
                                             <a class="sub-nav-link @if(Route::currentRouteName() === 'admin.admin.index' or Route::currentRouteName() === 'admin.admin.create' or Route::currentRouteName() === 'admin.admin.edit') active @endif" href="{{ route('admin.admin.index') }}">Administrateur</a>
                                        </li>
                                   </ul>
                              </div>
                         </li>


                         <hr class="mb-5">

                  </ul>
             </div>
        </div>
        <!-- ========== App Menu End ========== -->

        <!-- Rightbar -->
        <div class="rightbar offcanvas-lg offcanvas-end border-0" data-bs-scroll="true"  tabindex="-1"
             id="rightbar-offcanvas">
             <div data-simplebar class="h-100 card rounded-0">
                  <img src="assets/images/rightbar.png" class="img-fluid" alt="">

                  <div class="p-3">

                       <h5 class="mb-3 fs-12 text-muted fw-bold text-uppercase">Recapitulatif des évènements</h5>

                       <div class="position-relative ms-2">
                            <span class="position-absolute start-0 top-0 border border-dashed h-100"></span>
                            <div class="position-relative ps-3">
                                 <div class="mb-4">
                                      <span
                                           class="position-absolute start-0 avatar-xs translate-middle-x text-bg-danger d-inline-flex align-items-center justify-content-center rounded-circle fs-16"><iconify-icon
                                                icon="iconamoon:folder-check-duotone"></iconify-icon></span>
                                      <div class="ms-2">
                                           <h5 class="mb-1 text-dark fw-semibold fs-14 lh-base">
                                                Report-Fix / Update
                                           </h5>
                                           <p class="d-flex align-items-center">
                                                Add 3 files to
                                                <span class="d-flex align-items-center text-primary ms-1"><iconify-icon
                                                          icon="iconamoon:file-light"></iconify-icon>
                                                     Tasks</span>
                                           </p>
                                           <div class="bg-secondary-subtle rounded-2 p-1">
                                                <div class="row">
                                                     <div class="col-lg-6">
                                                          <div class="d-flex align-items-center gap-2">
                                                               <i class="bx bxl-figma fs-20 text-red"></i>
                                                               <a href="#!" class="text-dark fw-medium">Concept.fig</a>
                                                          </div>
                                                     </div>
                                                </div>
                                           </div>
                                           <h6 class="mt-2 text-muted">
                                                Monday , 4:24 PM
                                           </h6>
                                      </div>
                                 </div>
                            </div>

                            <div class="position-relative ps-3">
                                 <div class="mb-4">
                                      <span
                                           class="position-absolute start-0 avatar-xs translate-middle-x text-bg-success d-inline-flex align-items-center justify-content-center rounded-circle fs-16"><iconify-icon
                                                icon="iconamoon:check-circle-1-duotone"></iconify-icon></span>
                                      <div class="ms-2">
                                           <h5 class="mb-1 text-dark fw-semibold fs-14 lh-base">
                                                Project Status
                                           </h5>
                                           <p class="d-flex align-items-center mb-0">
                                                Marked<span class="d-flex align-items-center text-primary mx-1"><iconify-icon
                                                          icon="iconamoon:file-light"></iconify-icon>
                                                     Design
                                                </span>
                                                as
                                                <span class="badge bg-success-subtle text-success px-2 py-1 ms-1">
                                                     Completed</span>
                                           </p>
                                           <div
                                                class="d-flex align-items-center gap-3 mt-1 bg-secondary-subtle p-1 rounded-2 px-2">
                                                <a href="#!" class="fw-medium text-dark">UI/UX Figma Design</a>
                                           </div>
                                           <h6 class="mt-2 text-muted">
                                                Monday , 3:00 PM
                                           </h6>
                                      </div>
                                 </div>
                            </div>
                            <div class="position-relative ps-3">
                                 <div class="mb-4">
                                      <span
                                           class="position-absolute start-0 avatar-xs translate-middle-x text-bg-success d-inline-flex align-items-center justify-content-center rounded-circle fs-14">UI</span>
                                      <div class="ms-2">
                                           <h5 class="mb-1 text-dark fw-semibold fs-14">
                                                Application UI v2.0.0
                                                <span class="badge bg-primary-subtle text-primary px-2 py-1 ms-1">
                                                     Latest</span>
                                           </h5>
                                           <p>
                                                Get access to over 20+ pages including a
                                                dashboard layout, charts, kanban board,
                                                calendar, and pre-order E-commerce &
                                                Marketing pages.
                                           </p>
                                           <div class="mt-2">
                                                <a href="#!" class="btn btn-outline-secondary rounded-pill btn-sm">Download
                                                     File</a>
                                           </div>
                                           <h6 class="mt-2 text-muted">
                                                Monday , 2:10 PM
                                           </h6>
                                      </div>
                                 </div>
                            </div>
                            <div class="position-relative ps-3">
                                 <div class="mb-4">
                                      <span
                                           class="position-absolute start-0 translate-middle-x bg-success bg-gradient d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-16"><img
                                                src="assets/images/users/avatar-7.jpg" alt="avatar-5"
                                                class="avatar-xs rounded-circle" /></span>
                                      <div class="ms-2">
                                           <h5 class="mb-0 text-dark fw-semibold fs-14 lh-base">
                                                Alex Smith Attached Photos
                                           </h5>
                                           <div class="row g-2 mt-1">
                                                <div class="col-lg-4">
                                                     <a href="#!">
                                                          <img src="assets/images/small/img-6.jpg" alt=""
                                                               class="img-fluid rounded" />
                                                     </a>
                                                </div>
                                                <div class="col-lg-4">
                                                     <a href="#!">
                                                          <img src="assets/images/small/img-3.jpg" alt=""
                                                               class="img-fluid rounded" />
                                                     </a>
                                                </div>
                                                <div class="col-lg-4">
                                                     <a href="#!">
                                                          <img src="assets/images/small/img-4.jpg" alt=""
                                                               class="img-fluid rounded" />
                                                     </a>
                                                </div>
                                           </div>
                                           <h6 class="mt-2 text-muted">Monday 1:00 PM</h6>
                                      </div>
                                 </div>
                            </div>
                            <div class="position-relative ps-4">
                                 <div class="mb-4">
                                      <span
                                           class="position-absolute start-0 avatar-xs translate-middle-x text-bg-warning d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-16"><iconify-icon
                                                icon="iconamoon:certificate-badge-duotone"></iconify-icon></span>
                                      <div class="ms-2">
                                           <h5 class="mb-0 text-dark fw-semibold fs-14 lh-base">
                                                Achievements
                                           </h5>
                                           <p class="d-flex align-items-center gap-1 mt-1">
                                                <iconify-icon icon="iconamoon:certificate-badge-duotone"
                                                     class="text-danger fs-20"></iconify-icon>" Best Product Award"
                                           </p>
                                           <h6 class="mt-2 text-muted">Monday 9:30 AM</h6>
                                      </div>
                                 </div>
                            </div>
                       </div>
                       <a href="#!" class="btn btn-dark w-100">View All</a>
                  </div>


             </div>
        </div>

        <!-- Theme Settings -->
        <div>
             <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="theme-settings-offcanvas">
                  <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
                       <h5 class="text-white m-0">Theme Settings</h5>
                       <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>

                  <div class="offcanvas-body p-0">
                       <div data-simplebar class="h-100">
                            <div class="p-3 settings-bar">

                                 <div>
                                      <h5 class="mb-3 font-16 fw-semibold">Color Scheme</h5>

                                      <div class="form-check mb-2">
                                           <input class="form-check-input" type="radio" name="data-bs-theme" id="layout-color-light" value="light">
                                           <label class="form-check-label" for="layout-color-light">Light</label>
                                      </div>

                                      <div class="form-check mb-2">
                                           <input class="form-check-input" type="radio" name="data-bs-theme" id="layout-color-dark" value="dark">
                                           <label class="form-check-label" for="layout-color-dark">Dark</label>
                                      </div>
                                 </div>

                                 <div>
                                      <h5 class="my-3 font-16 fw-semibold">Topbar Color</h5>

                                      <div class="form-check mb-2">
                                           <input class="form-check-input" type="radio" name="data-topbar-color" id="topbar-color-light" value="light">
                                           <label class="form-check-label" for="topbar-color-light">Light</label>
                                      </div>
                                      <div class="form-check mb-2">
                                           <input class="form-check-input" type="radio" name="data-topbar-color" id="topbar-color-dark" value="dark">
                                           <label class="form-check-label" for="topbar-color-dark">Dark</label>
                                      </div>
                                 </div>


                                 <div>
                                      <h5 class="my-3 font-16 fw-semibold">Menu Color</h5>

                                      <div class="form-check mb-2">
                                           <input class="form-check-input" type="radio" name="data-menu-color" id="leftbar-color-light" value="light">
                                           <label class="form-check-label" for="leftbar-color-light">
                                                Light
                                           </label>
                                      </div>

                                      <div class="form-check mb-2">
                                           <input class="form-check-input" type="radio" name="data-menu-color" id="leftbar-color-dark" value="dark">
                                           <label class="form-check-label" for="leftbar-color-dark">
                                                Dark
                                           </label>
                                      </div>
                                 </div>

                                 <div>
                                      <h5 class="my-3 font-16 fw-semibold">Sidebar Size</h5>

                                      <div class="form-check mb-2">
                                           <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-size-default" value="default">
                                           <label class="form-check-label" for="leftbar-size-default">
                                                Default
                                           </label>
                                      </div>

                                      <div class="form-check mb-2">
                                           <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-size-small" value="condensed">
                                           <label class="form-check-label" for="leftbar-size-small">
                                                Condensed
                                           </label>
                                      </div>

                                      <div class="form-check mb-2">
                                           <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-hidden" value="hidden">
                                           <label class="form-check-label" for="leftbar-hidden">
                                                Hidden
                                           </label>
                                      </div>

                                      <div class="form-check mb-2">
                                           <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-size-small-hover-active" value="sm-hover-active">
                                           <label class="form-check-label" for="leftbar-size-small-hover-active">
                                                Small Hover Active
                                           </label>
                                      </div>

                                      <div class="form-check mb-2">
                                           <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-size-small-hover" value="sm-hover">
                                           <label class="form-check-label" for="leftbar-size-small-hover">
                                                Small Hover
                                           </label>
                                      </div>
                                 </div>

                            </div>
                       </div>
                  </div>
                  <div class="offcanvas-footer border-top p-3 text-center">
                       <div class="row">
                            <div class="col">
                                 <button type="button" class="btn btn-danger w-100" id="reset-layout">Reset</button>
                            </div>
                       </div>
                  </div>
             </div>
        </div>

        <!-- ==================================================== -->
        <!-- Start right Content here -->
        <!-- ==================================================== -->
        <div class="page-content">