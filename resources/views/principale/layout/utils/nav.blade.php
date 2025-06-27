
    <!-- Loader -->
    <!-- <div id="gi-overlay">
        <div class="loader"></div>
    </div> -->
    
    @php $texte = "produit"; if(Cart::content()->count() > 1){ $texte = "produits"; } @endphp
    <div class="prec"></div>
    <!-- Header start  -->
    <header class="gi-header background top-nav" id="navbar">
        <!-- Header Top Start -->
        <div class="header-top background header-top top-nav" id="navbar1" style="background: orangered;">
            <div class="container">
                <div class="row align-itegi-center">
                    <div class="col header-top-res d-lg-none">
                        <div class="gi-header-buttons">
                            <div class="right-icons">
                                <!-- Header User Start -->
                                <a href="login.html" class="gi-header-btn gi-header-user">
                                    <div class="header-icon"><i class="fi-rr-user"></i></div>
                                </a>
                                <!-- Header User End -->
                                <!-- Header Wishlist Start -->
                                <a href="wishlist.html" class="gi-header-btn gi-wish-toggle">
                                    <div class="header-icon"><i class="fi-rr-heart"></i></div>
                                    <span class="gi-header-count gi-wishlist-count">0</span>
                                </a>
                                <!-- Header Wishlist End -->
                                <!-- Header Cart Start -->
                                <a href="javascript:void(0)" class="gi-header-btn gi-cart-toggle">
                                    <div class="header-icon">
                                        @if(Cart::content()->count() > 0)
                                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px;" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                                            </svg>
                                        @else
                                            <i class="fi-rr-shopping-bag"></i>
                                        @endif
                                        <span class="main-label-note-new"></span>
                                    </div>
                                    <span class="gi-header-count gi-cart-count">{{ Cart::count() }}</span>
                                </a>
                                <!-- Header Cart End -->
                                <!-- Header menu Start -->
                                <a href="javascript:void(0)" class="gi-header-btn gi-site-menu-icon d-lg-none">
                                    <i class="fi-rr-menu-burger"></i>
                                </a>
                                <!-- Header menu End -->
                            </div>
                        </div>
                    </div>
                    <!-- Header Top responsive Action -->
                </div>
            </div>
        </div>
        <!-- Header Top  End -->

        <!-- Header Bottom  Start -->
        <div class="gi-header-bottom d-lg-block" style="background: #282f36; padding: 5px 0; border-radius: 7px">
            <div class="container position-relative">
                <div class="row">
                    <div class="gi-flex">
                        <!-- Header Logo Start -->
                        <div class="align-self-center gi-header-logo">
                            <div class="header-logo ">
                                <a href="{{ route('accueil') }}"><img src="{{ asset("principale/assets/img/logo/logo3.png") }}" class="text-center" alt="Site Logo"></a>
                            </div>
                        </div>
                        <!-- Header Logo End -->
                        <!-- Header Search Start -->
                        <div class="align-self-center gi-header-search">
                            <div class="header-search">
                                <form class="gi-search-group-form" action="{{ route('recherche.produit') }}" method="get">
                                    @if(categories()->count() > 0)  
                                        <div class="ms-search-select-inner">
                                            <select name="choix" class="gi-search-cat selectpicker color" data-live-search="true"
                                                data-live-search-placeholder="👇🏾 Voir la liste ici 👇🏾" data-actions-box="true" required>
                                                @if(request()->choix)
                                                
                                                    @php  $souscateg = souscategories()->where('id', request()->choix)->first();  @endphp
                                                    @if($souscateg)
                                                    <option value="{{ $souscateg->id }}">{{ $souscateg->nom }}</option>
                                                    @endif
                                                @endif
                                                <option value="0">Voir tous les produits</option>

                                                @foreach(categories() as $categorie)   
                                                    @php 
                                                        $ss = $categorie->souscategories->count();
                                                        $total = 0;
                                                        if($ss > 0)
                                                        {
                                                            foreach($categorie->souscategories as $souscategorie)
                                                            {
                                                                if($souscategorie->produits->where('isvalide', 1)->count() > 0)
                                                                {
                                                                    $total++;
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    @if($categorie->souscategories->count() > 0 && $total > 0)
                                                        @foreach($categorie->souscategories as $souscategorie)  
                                                            @if($souscategorie->produits->where('isvalide', 1)->count() > 0)  
                                                               
                                                                    <option value="{{ $souscategorie->id }}">{{ $souscategorie->nom }}</option>
                                                                
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <input class="form-control ms-search-bar color input-text" name="search" placeholder="Rechercher un produit" value="{{ request()->search ?? '' }}" type="search" type="text" required>
                                    @error('search') <span class="text-danger color">{{ $message }}</span> @enderror

                                    <button class="search_submit" type="submit"><i class="fi-rr-search color"></i></button>
                                </form>
                                <!-- <form class="gi-search-group-form" action="{{ route('recherche.produit') }}" method="get">
                                    <input class="form-control gi-search-bar" name="search" placeholder="Rechercher un produit" value="{{ request()->search ?? '' }}" type="search"
                                        type="text">
                                    <button class="search_submit" type="submit"><i class="fi-rr-search"></i></button>
                                </form> -->
                            </div>
                        </div>
                        <!-- Header Search End -->
                        <!-- Header Button Start -->
                        <div class="gi-header-action align-self-center">
                            <div class="gi-header-buttons">
                                <!-- Header Cart Start gi-cart-toggle-->
                                <a class="gi-header-btn color" title="Cart" @if(Cart::count() > 0) href="{{ route('mon.panier') }}" @else href="#" @endif>
                                    <div class="header-icon mb-2">
                                        @if(Cart::content()->count() > 0)
                                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px;" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                                            </svg>
                                        @else
                                            <i class="fi-rr-shopping-bag"></i>
                                        @endif
                                        <span class="main-label-note-new"></span>
                                        <span class="gi-header-count gi-cart-count" style="background-color: orangered !important;">{{ Cart::count() }}</span>
                                    </div>
                                    <div class="gi-btn-desc">
                                        <span class="gi-btn-title color">{{ getprice(Cart::total()) }}</span>
                                        <span class="gi-btn-stitle ravmel-color1"><b class="gi-cart-count">{{ Cart::count() }}</b> {{ $texte }}</span>
                                    </div>
                                </a>
                                <!-- Header Cart End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Button End -->

        <!-- Header menu -->
        <div class="gi-header-cat d-none d-lg-block background" style="border: none;">
            <div class="container position-relative">
                <div class="gi-nav-bar">
                    <!-- Category Toggle -->
                    <div class="gi-category-icon-block">
                        <div class="gi-category-menu">
                            <div class="gi-category-toggle back-ravmel-color3">
                                <!-- <i class="fi fi-rr-apps"></i> -->
                                <i class="fi fi-rr-list"></i>
                                <span class="text">Liste categories</span>
                                <i class="fi-rr-angle-small-down d-1199 gi-angle" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="gi-cat-dropdown">
                            <div class="gi-cat-block">
                                <div class="gi-cat-tab">
                                    <div class="gi-tab-list nav flex-column nav-pills me-3" id="v-pills-tab"
                                        role="tablist" aria-orientation="vertical">
                                        <!-- <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-home" type="button" role="tab"
                                            aria-controls="v-pills-home" aria-selected="true"><i
                                                class="fi-rr-cupcake"></i>Dairy & Bakery</button> -->
                                         
                                        @if(categories()->count() > 0)   
                                            @php $n = 1; @endphp

                                            @foreach(categories() as $categorie)   
                                                @php 
                                                    $ss = $categorie->souscategories->count();
                                                    $total = 0;
                                                    if($ss > 0)
                                                    {
                                                        foreach($categorie->souscategories as $souscategorie)
                                                        {
                                                            if($souscategorie->produits->where('isvalide', 1)->count() > 0)
                                                            {
                                                                $total++;
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                @if($categorie->souscategories->count() > 0 && $total > 0)
                                                    <button class="nav-link @if($n <= 1) active @endif" id="v-pills-profile-tab" data-bs-toggle="pill"
                                                        data-bs-target="#Categorie{{ $categorie->id }}" type="button" role="tab"
                                                        aria-controls="Categorie{{ $categorie->id }}" @if($n <= 1) aria-selected="true" @else aria-selected="false" @endif>
                                                        <i class="fi fi-rr-cart-shopping-fast"></i> {{ $categorie->nom }}
                                                    </button>
                                                    @php $n++; @endphp
                                                @endif
                                            @endforeach
                                        @else
                                            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                                data-bs-target="#AucuneCategorie" type="button" role="tab"
                                                aria-controls="AucuneCategorie" aria-selected="false"><i class="fi fi-rr-cart-shopping-fast"></i> Aucune Categorie</button>
                                        @endif
                                        <!-- <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-messages" type="button" role="tab"
                                            aria-controls="v-pills-messages" aria-selected="false"><i
                                                class="fi fi-rr-popcorn"></i>Snack & Spice</button>
                                        <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-settings" type="button" role="tab"
                                            aria-controls="v-pills-settings" aria-selected="false"><i
                                                class="fi fi-rr-drink-alt"></i>Juice & Drinks </button> -->
                                    </div>
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <!-- <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab">
                                            <div class="tab-list row">
                                                <div class="col">
                                                    <h6 class="gi-col-title">Dairy</h6>
                                                    <ul class="cat-list">
                                                        <li><a href="shop-left-sidebar-col-3.html">Milk</a></li>
                                                        <li><a href="shop-left-sidebar-col-3.html">Ice cream</a></li>
                                                        <li><a href="shop-left-sidebar-col-3.html">Cheese</a></li>
                                                        <li><a href="shop-left-sidebar-col-3.html">Frozen custard</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar-col-3.html">Frozen yogurt</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col">
                                                    <h6 class="gi-col-title">Bakery</h6>
                                                    <ul class="cat-list">
                                                        <li><a href="shop-left-sidebar-col-3.html">Cake and Pastry</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar-col-3.html">Rusk Toast</a></li>
                                                        <li><a href="shop-left-sidebar-col-3.html">Bread & Buns</a></li>
                                                        <li><a href="shop-left-sidebar-col-3.html">Chocolate Brownie</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar-col-3.html">Cream Roll</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> -->

                                        @if(categories()->count() > 0)   
                                            @php $n = 1; @endphp

                                            @foreach(categories() as $categorie)   
                                                @php 
                                                    $ss = $categorie->souscategories->count();
                                                    $total = 0;
                                                    if($ss > 0)
                                                    {
                                                        foreach($categorie->souscategories as $souscategorie)
                                                        {
                                                            if($souscategorie->produits->where('isvalide', 1)->count() > 0)
                                                            {
                                                                $total++;
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                @if($categorie->souscategories->count() > 0 && $total > 0)
                                                    <div class="tab-pane fade  @if($n <= 1) show active @endif" id="Categorie{{ $categorie->id }}" role="tabpanel"
                                                        aria-labelledby="Categorie{{ $categorie->id }}">
                                                        <div class="tab-list row">
                                                            <div class="col">
                                                                <a href="{{ route('categorie.produit', $categorie) }}">
                                                                    <h6 class="gi-col-title">Categories : {{ $categorie->nom }}</h6>
                                                                </a>
                                                                <ul class="cat-list">
                                                                    @foreach($categorie->souscategories as $souscategorie)  
                                                                        @if($souscategorie->produits->where('isvalide', 1)->count() > 0)  
                                                                            <li><a href="{{ route('scategorie.produit', $souscategorie) }}">{{ $souscategorie->nom }}</a></li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    @php $n++; @endphp
                                                @endif
                                            @endforeach
                                        @else
                                            <div class="tab-pane fade" id="AucuneCategorie" role="tabpanel"
                                                aria-labelledby="AucuneCategorie">
                                                <div class="tab-list row">
                                                    <div class="col">
                                                        <h6 class="gi-col-title">Sous categories</h6>
                                                        <ul class="cat-list">
                                                            <li><a href="#">Désolé! Aucune sous categorie disponible</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Menu Start -->
                    <div id="gi-main-menu-desk" class="d-none d-lg-block sticky-nav navbar">
                        <div class="nav-desk">
                            <div class="row">
                                <div class="col-md-12 align-self-center">
                                    <div class="gi-main-menu">
                                        <ul>
                                            <li class="non-drop">
                                                <a href="{{ route('accueil') }}" class="@if(Route::currentRouteName() === 'accueil') ravmel-color3 @else color @endif">
                                                    Accueil
                                                </a>
                                            </li>
                                            <li class="dropdown drop-list position-static">
                                                <a href="javascript:void(0)" class="dropdown-arrow color @if(Route::currentRouteName() === 'scategorie.produit' or Route::currentRouteName() === 'categorie.produit') text-warning @endif">Catalogue<i
                                                        class="fi-rr-angle-small-right"></i></a>
                                                @if(categories()->count() > 0)  
                                                    <ul class="mega-menu d-block">
                                                        <li class="d-flex" style="flex-wrap: wrap;">
                                                            <span class="bg"></span> 
                                                                @foreach(categories() as $categorie)   
                                                                    @php 
                                                                        $ss = $categorie->souscategories->count();
                                                                        $total = 0;
                                                                        if($ss > 0)
                                                                        {
                                                                            foreach($categorie->souscategories as $souscategorie)
                                                                            {
                                                                                if($souscategorie->produits->where('isvalide', 1)->count() > 0)
                                                                                {
                                                                                    $total++;
                                                                                }
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    @if($categorie->souscategories->count() > 0 && $total > 0)
                                                                        <ul class="d-block mega-block">
                                                                            <li class="menu_title"><a href="javascript:void(0)" class="ravmel-color1">{{ $categorie->nom }}</a></li>
                                                                            @foreach($categorie->souscategories as $souscategorie) 
                                                                                @if($souscategorie->produits->where('isvalide', 1)->count() > 0)  
                                                                                    <li><a href="{{ route('scategorie.produit', $souscategorie) }}">{{ $souscategorie->nom }}</a></li>
                                                                                @endif  
                                                                            @endforeach
                                                                        </ul>
                                                                    @endif
                                                                @endforeach
                                                        </li>
                                                    </ul>
                                                @else
                                                    <ul class="mega-menu d-block">
                                                        <li class="menu_title"><a href="javascript:void(0)">Désolé! Aucune categorie disponible</a></li>
                                                    </ul>
                                                @endif
                                            </li>
                                            <li class="dropdown drop-list">
                                                <a href="{{ route('all.produit.promo') }}" class="dropdown-arrow @if(Route::currentRouteName() === 'all.produit.promo') ravmel-color3 @else color @endif">
                                                    Promotion en cours<i class="fi-rr-angle-small-right"></i>
                                                </a>
                                                <ul class="sub-menu show p-0 m-0" style="width: 228px; border: none;">
                                                    @if(produitpromo()->count() > 0)
                                                        @php 
                                                            $i = 1;
                                                        @endphp
                                                        @foreach(produitpromo()->take(3) as $produit)
                                                            @if($i >= 2)
                                                                <hr class="m-0 p-0">
                                                            @endif
                                                            <li class="background hover-nav">
                                                                <a href="{{ route('all.produit.promo') }}" class="ravmel-color2">
                                                                    <span class="text-white">{{ $produit->nom }}</span>
                                                                    <img src="{{ asset(Storage::url($produit->image)) }}" class="img-btt" alt="Site Logo">
                                                                </a> 
                                                            </li>
                                                        @endforeach
                                                    @else
                                                        <li><a href="#" class="text-danger">Aucun produit en promo</a></li>
                                                    @endif
                                                </ul>
                                            </li>
                                            <li class="non-drop">
                                                <a href="{{ route('all.produit') }}" class="@if(Route::currentRouteName() === 'all.produit') ravmel-color3 @else color @endif">
                                                    Offres du Moment
                                                </a>
                                            </li>
                                            <li class="non-drop">
                                                <a href="{{ route('all.formation') }}" class="@if(Route::currentRouteName() === 'all.formation') ravmel-color3 @else color @endif">
                                                    Formations Disponibles
                                                </a>
                                            </li>
                                            <li class="dropdown drop-list">
                                                <a href="javascript:void(0)" class="dropdown-arrow @if(Route::currentRouteName() === 'contact' or Route::currentRouteName() === 'entreprise' or Route::currentRouteName() === 'service' or Route::currentRouteName() === 'conseil.astuce' or Route::currentRouteName() === 'all.produit.reconditionne') ravmel-color3 @else color @endif">
                                                    À Propos De Nous<i class="fi-rr-angle-small-right"></i>
                                                </a>
                                                <ul class="sub-menu">
                                                    <li><a href="{{ route('entreprise') }}" class="@if(Route::currentRouteName() === 'entreprise') ravmel-color2 @endif">A propos de nous</a></li>
                                                    <li><a href="{{ route('service') }}" class="@if(Route::currentRouteName() === 'service') ravmel-color2 @endif">Service</a></li>
                                                    <li><a href="{{ route('contact') }}" class="@if(Route::currentRouteName() === 'contact') ravmel-color2 @endif">Contact</a></li>
                                                    <li><a href="{{ route('conseil.astuce') }}" class="@if(Route::currentRouteName() === 'conseil.astuce') ravmel-color2 @endif">Conseils et astuces</a></li>
                                                    <li><a href="{{ route('all.produit.reconditionne') }}" class="@if(Route::currentRouteName() === 'all.produit.reconditionne') ravmel-color2 @endif">Articles reconditionnés</a></li>
                                                </ul>
                                            </li>
                                            <!-- <li class="non-drop @if(Route::currentRouteName() === 'entreprise') active @endif"">
                                                <a href="{{ route('entreprise') }}">
                                                    Entreprise
                                                </a>
                                            </li>
                                            <li class="non-drop @if(Route::currentRouteName() === 'contact') active @endif">
                                                <a href="{{ route('contact') }}">
                                                    Contact
                                                </a>
                                            </li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Main Menu End -->

                    <div class="gi-location-block">
                        <div class="gi-location-menu">
                            <div class="gi-location-toggle back-ravmel-color3" style="justify-content:center;">
                            <i class="fi fi-rr-phone-call"></i>
                            <a href="{{ route('contact') }}"><span class="gi-location-title d-1199 gi-location">Nous contacter</span></a>
                                <!-- <i class="fi-rr-angle-small-down d-1199 gi-angle" aria-hidden="true"></i> -->
                            </div>
                            <!-- <div class="gi-location-content">
                                <div class="gi-location-dropdown">
                                    <div class="row gi-location-wrapper">
                                        <ul class="loc-grid">
                                            <li class="loc-list current">
                                                <i class="fi fi-rr-map-marker-plus"></i>
                                                <span class="gi-detail-current">current Location</span>
                                            </li>
                                            <li class="loc-list">
                                                <i class="fi fi-rr-map-marker-plus"></i>
                                                <span class="gi-detail">Los Angeles</span>
                                            </li>
                                            <li class="loc-list">
                                                <i class="fi fi-rr-map-marker-plus"></i>
                                                <span class="gi-detail">Chicago</span>
                                            </li>
                                            <li class="loc-list">
                                                <i class="fi fi-rr-map-marker-plus"></i>
                                                <span class="gi-detail">Houston</span>
                                            </li>
                                            <li class="loc-list">
                                                <i class="fi fi-rr-map-marker-plus"></i>
                                                <span class="gi-detail">Phoenix</span>
                                            </li>
                                            <li class="loc-list">
                                                <i class="fi fi-rr-map-marker-plus"></i>
                                                <span class="gi-detail">San Diego</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Header menu End -->

        <!-- Mobile Menu sidebar Start -->
        <div class="gi-mobile-menu-overlay"></div>
        <div id="gi-mobile-menu" class="gi-mobile-menu background">
            <div class="gi-menu-title">
                <span class="menu_title">Mon Menu</span>
                <button class="gi-close-menu">×</button>
            </div>
            <div class="gi-menu-inner">
                <div class="gi-menu-content">
                    <ul>
                        <li class="dropdown drop-list">
                            <a class="dropdown-arrow @if(Route::currentRouteName() === 'accueil') text-warning @endif" href="{{ route('accueil') }}">Accueil</a>
                        </li>
                        <!-- <li class="dropdown drop-list @if(Route::currentRouteName() === 'entreprise') active @endif">
                            <a class="dropdown-arrow" href="{{ route('entreprise') }}">Entreprise</a>
                        </li> -->
                        <li><a href="{{ route('all.produit.promo') }}" class="@if(Route::currentRouteName() === 'scategorie.produit' or Route::currentRouteName() === 'categorie.produit') text-warning @endif">Catalogue</a>
                            <ul class="sub-menu">
                                @if(categories()->count() > 0)  
                                    @foreach(categories() as $categorie)  
                                        @php 
                                            $ss = $categorie->souscategories->count();
                                            $total = 0;
                                            if($ss > 0)
                                            {
                                                foreach($categorie->souscategories as $souscategorie)
                                                {
                                                    if($souscategorie->produits->where('isvalide', 1)->count() > 0)
                                                    {
                                                        $total++;
                                                    }
                                                }
                                            }
                                        @endphp
                                        @if($categorie->souscategories->count() > 0 && $total > 0)
                                            <li>
                                                <a href="{{ route('categorie.produit', $categorie) }}">{{ $categorie->nom }}</a>
                                                
                                                <ul class="sub-menu">
                                                    @foreach($categorie->souscategories as $souscategorie) 
                                                        @if($souscategorie->produits->where('isvalide', 1)->count() > 0)  
                                                            <li><a href="{{ route('scategorie.produit', $souscategorie) }}">{{ $souscategorie->nom }}</a></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                @else
                                    <li><a href="#">Désolé! Aucune categorie disponible</a></li>
                                @endif
                                <!-- <li>
                                    <a href="javascript:void(0)">Classic Variation</a>
                                    <ul class="sub-menu">
                                        <li><a href="shop-banner-left-sidebar-col-3.html">Banner left sidebar 3
                                                column</a></li>
                                        <li><a href="shop-banner-left-sidebar-col-4.html">Banner left sidebar 4
                                                column</a></li>
                                        <li><a href="shop-banner-right-sidebar-col-3.html">Banner right sidebar 3
                                                column</a></li>
                                        <li><a href="shop-banner-right-sidebar-col-4.html">Banner right sidebar 4
                                                column</a></li>
                                        <li><a href="shop-banner-full-width.html">Banner Full width 4 column</a></li>
                                    </ul>
                                </li> -->
                            </ul>
                        </li>
                        <!-- <li class="dropdown drop-list">
                            <a href="{{ route('all.produit.promo') }}" class="dropdown-arrow @if(Route::currentRouteName() === 'all.produit.promo') text-warning @endif">
                                En Promo<i class="fi-rr-angle-small-right"></i>
                            </a>
                        </li> -->
                        <li class="dropdown drop-list">
                            <a href="javascript:void(0)" class="dropdown-arrow @if(Route::currentRouteName() === 'all.produit.promo') text-warning @endif">
                                ProduitPromo en cours
                            </a>
                            <ul class="sub-menu p-0 m-0 mb-2">
                                @if(produitpromo()->count() > 0)
                                    @foreach(produitpromo()->take(3) as $produit)
                                        <li class="background hover-nav">
                                            <a href="{{ route('all.produit.promo') }}" class="ravmel-color2 mobile-nav">
                                                <span class="text-white">{{ $produit->nom }}</span>
                                                <img src="{{ asset(Storage::url($produit->image)) }}" class="img-btt" alt="Site Logo">
                                            </a>
                                        </li>
                                        <hr class="m-0 p-0">
                                    @endforeach
                                @else
                                    <li><a href="#" class="text-danger">Aucun produit en promo</a></li>
                                @endif
                            </ul>
                        </li>
                        <li class="non-drop drop-list">
                            <a class="dropdown-arrow @if(Route::currentRouteName() === 'all.produit') text-warning @endif" href="{{ route('all.produit') }}">
                            Offres du moment
                            </a>
                        </li>
                        <li class="dropdown drop-list">
                            <a class="dropdown-arrow @if(Route::currentRouteName() === 'all.formation') text-warning @endif" href="{{ route('all.formation') }}">
                                Formations Disponibles
                            </a>
                        </li>
                        <li class="dropdown drop-list">
                            <a href="javascript:void(0)" class="dropdown-arrow @if(Route::currentRouteName() === 'contact' or Route::currentRouteName() === 'entreprise' or Route::currentRouteName() === 'service' or Route::currentRouteName() === 'conseil.astuce' or Route::currentRouteName() === 'all.produit.reconditionne') text-warning @endif">
                                À propos de nous
                            </a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('entreprise') }}">Qui sommes nous ?</a></li>
                                <li><a href="{{ route('service') }}">Service</a></li>
                                <li><a href="{{ route('contact') }}">Contact</a></li>
                                <li><a href="{{ route('conseil.astuce') }}">Conseils et astuces</a></li>
                                <li><a href="{{ route('all.produit.reconditionne') }}">Articles reconditionnés</a></li>
                            </ul>
                        </li>
                        <!-- <li class="dropdown drop-list @if(Route::currentRouteName() === 'contact') active @endif">
                            <a class="dropdown-arrow" href="{{ route('contact') }}">Contact</a>
                        </li> -->
                    
                    </ul>
                </div>
                <div class="header-res-lan-curr">
                    <!-- Social Start -->
                    <div class="header-res-social">
                        <div class="header-top-social">
                            <ul class="mb-0">
                                <li class="list-inline-item"><a href="#"><i class="gicon gi-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="gicon gi-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="gicon gi-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="gicon gi-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Social End -->
                </div>
            </div>
        </div>
        <!-- Mobile Menu sidebar End -->
    </header>
    <!-- Header End  -->

    <!-- Cart sidebar Start -->
    <div class="gi-side-cart-overlay"></div>
    <div id="gi-side-cart" class="gi-side-cart">
        <div class="gi-cart-inner">
            @if ( Cart::count() > 0 )
                <div class="gi-cart-top">
                    <div class="gi-cart-title">
                        <span class="cart_title">Mon panier : {{ Cart::count() }} Article(s)</span>
                        <a href="javascript:void(0)" class="gi-cart-close">
                            <i class="fi-rr-cross-small"></i>
                        </a>
                    </div>
                            
                    <ul class="gi-cart-pro-items">
                        @foreach (Cart::content() as $produit)
                            <li>
                                <a href="product-left-sidebar.html" class="gi-pro-img"><img
                                        src="{{ asset(Storage::url($produit->model->image)) }}" alt="product"></a>
                                <div class="gi-pro-content">
                                    <a href="product-left-sidebar.html" class="cart-pro-title">{{ $produit->model->nom }}</a>
                                    <span class="cart-price"><span>{{ $produit->price }}</span> x 1 kg</span>
                                    <div class="qty-plus-minus">
                                        <input class="qty-input" type="text" name="gi-qtybtn" value="{{ $produit->qty }}" readonly>
                                    </div>
                                    <a href="{{ route('retirer.produit.panier', $produit->rowId) }}" class="remove">×</a>
                                </div>
                            </li>
                        @endforeach
                        <!-- 
                            <li>
                                <a href="product-left-sidebar.html" class="gi-pro-img"><img
                                        src="assets/img/product-images/25_1.jpg" alt="product"></a>
                                <div class="gi-pro-content">
                                    <a href="product-left-sidebar.html" class="cart-pro-title">Fresh Lichi</a>
                                    <span class="cart-price"><span>$25.00</span> x 1 kg</span>
                                    <div class="qty-plus-minus">
                                        <input class="qty-input" type="text" name="gi-qtybtn" value="1">
                                    </div>
                                    <a href="javascript:void(0)" class="remove">×</a>
                                </div>
                            </li>
                            <li>
                                <a href="product-left-sidebar.html" class="gi-pro-img"><img
                                        src="assets/img/product-images/17_1.jpg" alt="product"></a>
                                <div class="gi-pro-content">
                                    <a href="product-left-sidebar.html" class="cart-pro-title">Ginger - Organic</a>
                                    <span class="cart-price"><span>$5.00</span> x 1 250g</span>
                                    <div class="qty-plus-minus">
                                        <input class="qty-input" type="text" name="gi-qtybtn" value="1">
                                    </div>
                                    <a href="javascript:void(0)" class="remove">×</a>
                                </div>
                            </li>
                            <li>
                            <a href="product-left-sidebar.html" class="gi-pro-img"><img
                                    src="assets/img/product-images/2_1.jpg" alt="product"></a>
                            <div class="gi-pro-content">
                                <a href="product-left-sidebar.html" class="cart-pro-title">Dates Value Pack Pouch</a>
                                <span class="cart-price"><span>$59.00</span> x 1 pack</span>
                                <div class="qty-plus-minus">
                                    <input class="qty-input" type="text" name="gi-qtybtn" value="1">
                                </div>
                                <a href="javascript:void(0)" class="remove">×</a>
                            </div>
                            </li> 
                        -->
                    </ul>
                </div>
                <div class="gi-cart-bottom">
                    <div class="cart-sub-total">
                        <table class="table cart-table">
                            <tbody>
                                <tr>
                                    <td class="text-left">Sub-Total :</td>
                                    <td class="text-right">{{ getprice(Cart::total()) }} </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Frais (0%) :</td>
                                    <td class="text-right">0F</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Total :</td>
                                    <td class="text-right primary-color">{{ getprice(Cart::total()) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="cart_btn">
                        <a href="{{ route('mon.panier') }}" class="gi-btn-1">Voir Panier</a>
                        <a href="{{ route('facturation') }}" class="gi-btn-2">Facture</a>
                    </div>
                </div>
            @else
                <div class="gi-cart-top">
                    <div class="gi-cart-title">
                        <span class="cart_title">Votre panier est vide</span>
                        <a href="javascript:void(0)" class="gi-cart-close">
                            <i class="fi-rr-cross-small"></i>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- Cart sidebar End -->