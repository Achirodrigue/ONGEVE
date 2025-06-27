@extends('principale.layout.app')
@section('body')

    @include('include.principale.message')


    <!-- Breadcrumb start -->
    <div class="gi-breadcrumb mb-0 background">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row gi_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="gi-breadcrumb-title">Produits de la boutique : {{ $vendeur->nom_entreprise }}</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- gi-breadcrumb-list start -->
                            <ul class="gi-breadcrumb-list">
                                <li class="gi-breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
                                <li class="gi-breadcrumb-item active">
                                    {{ $vendeur->nom_entreprise }} <sup class="text-white bg-warning" style="border-radius: 2px; padding: 0.1rem 0.3rem;">{{ $vendeur->produits->count() }}</sup>
                                </li>
                            </ul>
                            <!-- gi-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb end -->

    
    <!-- Shop section -->
    <section class="gi-shop padding-tb-40 background">
        <div class="container">
            <!-- Shop Banners Start -->
            <div class="padding-b-40 m-b-40">
                <div class="row">
                    <div class="col-md-6">
                        <div class="gi-ofr-banners">
                            <div class="gi-bnr-body">
                                <div class="gi-bnr-img">
                                    <span class="lbl">70% Off {{ \Carbon\Carbon::now()->translatedFormat('l d F Y') }}</span>
                                    <img src="{{ asset("principale/assets/img/banner/5.jpg") }}" alt="banner">
                                </div>
                                <div class="gi-bnr-detail">
                                    <h5>Fresh Fruits & veggies</h5>
                                    <p>The flavor of something special.</p>
                                    <a href="shop-left-sidebar-col-3.html" class="gi-btn-2">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="gi-ofr-banners m-t-767">
                            <div class="gi-bnr-body">
                                <div class="gi-bnr-img">
                                    <span class="lbl">50% Off</span>
                                    <img src="{{ asset("principale/assets/img/banner/6.jpg") }}" alt="banner">
                                </div>
                                <div class="gi-bnr-detail">
                                    <h5>Tasty Snack & Fastfood</h5>
                                    <p>A healthy meal for every one.</p>
                                    <a href="shop-left-sidebar-col-3.html" class="gi-btn-2">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="gi-shop-rightside col-lg-12 col-md-12 margin-b-30">
                    <!-- Shop Top Start -->
                    <!-- <div class="gi-pro-list-top d-flex">
                        <div class="col-md-6 gi-grid-list">
                            <div class="gi-gl-btn">
                                <button class="grid-btn filter-toggle-icon">
                                    <i class="fi fi-rr-filter"></i>
                                </button>
                                <button class="grid-btn btn-grid-50 active">
                                    <i class="fi fi-rr-apps"></i>
                                </button>
                                <button class="grid-btn btn-list-50">
                                    <i class="fi fi-rr-list"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 gi-sort-select">
                            <div class="gi-select-inner">
                                <select name="gi-select" id="gi-select">
                                    <option selected disabled>Sort by</option>
                                    <option value="1">Position</option>
                                    <option value="2">Relevance</option>
                                    <option value="3">Name, A to Z</option>
                                    <option value="4">Name, Z to A</option>
                                    <option value="5">Price, low to high</option>
                                    <option value="6">Price, high to low</option>
                                </select>
                            </div>
                        </div>
                    </div> -->
                    <!-- Shop Top End -->

                    <!-- Select Bar Start -->
                    <!-- <div class="gi-select-bar d-flex">
                        <span class="gi-select-btn">Clothes<a class="gi-select-cancel"
                                href="javascript:void(0)">×</a></span>
                        <span class="gi-select-btn">Fruits<a class="gi-select-cancel"
                                href="javascript:void(0)">×</a></span>
                        <span class="gi-select-btn">Snacks<a class="gi-select-cancel"
                                href="javascript:void(0)">×</a></span>
                        <span class="gi-select-btn">Dairy<a class="gi-select-cancel"
                                href="javascript:void(0)">×</a></span>
                        <span class="gi-select-btn">perfume<a class="gi-select-cancel"
                                href="javascript:void(0)">×</a></span>
                        <span class="gi-select-btn">jewelry<a class="gi-select-cancel"
                                href="javascript:void(0)">×</a></span>
                        <span class="gi-select-btn gi-select-btn-clear"><a class="gi-select-clear"
                                href="javascript:void(0)">Clear All</a></span>
                    </div> -->
                    <!-- Select Bar End -->

                    <!-- Shop content Start -->
                    <div class="shop-pro-content">
                        <div class="shop-pro-inner">
                            <div class="gi-tab-title">
                                <div class="gi-main-title">
                                    <div class="section-title">
                                        <div class="section-detail">
                                            <h2 class="gi-title">Nous vous proposons des <span class="ravmel-color2 text-underline">produits de qualités</span></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @if($produits->count() > 0)
                                    @foreach($produits as $produit)
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 gi-col-5 gi-product-box pro-gl-content">
                                            <!--
                                            class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-6 gi-product-box pro-gl-content 
                                            <class="col-xl-2 col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-6 gi-product-box pro-gl-content"> 
                                                class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 gi-col-5 gi-product-box pro-gl-content"
                                                class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 gi-col-5 gi-product-box pro-gl-content"-->
                                            <div class="gi-product-content">
                                                <div class="gi-product-inner">
                                                    <div class="gi-pro-image-outer">
                                                        <div class="gi-pro-image">
                                                            <a href="{{ route('detail.produit', $produit) }}" class="image">
                                                                <span class="label veg">
                                                                    <span class="dot"></span>
                                                                </span>
                                                                <img class="main-image" src="{{ asset(Storage::url($produit->image)) }}"
                                                                    alt="Product">
                                                                <img class="hover-image" src="{{ asset(Storage::url($produit->image)) }}"
                                                                    alt="Product">
                                                            </a>
                                                            @if(!$produit->stock || $produit->qtyStock <= 0)
                                                                <span class="flags stock">
                                                                    <span class="sale">epuisé</span>
                                                                </span>
                                                            @endif
                                                            @if(!$produit->etat)
                                                                <span class="flags stock pourcentage">
                                                                    <span class="sale bg-warning">REC</span>
                                                                </span>
                                                            @endif
                                                            @if($produit->promo)
                                                                <span class="flags">
                                                                    <span class="sale">Promo</span>
                                                                </span>
                                                                <span class="flags pourcentage">
                                                                    <span class="sale bg-warning">{{ poucentageReduction($produit) }}%</span>
                                                                </span>
                                                            @endif
                                                            <div class="gi-pro-actions">
                                                                <!-- <a class="gi-btn-group wishlist" title="Wishlist"><i
                                                                        class="fi-rr-heart"></i></a> -->
                                                                <a href="#" class="gi-btn-group quickview"
                                                                    data-link-action="quickview" title="Quick view"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#addProduitPanier{{ $produit->id }}"><i
                                                                        class="fi-rr-eye"></i></a>
                                                                <!-- <a href="{{ route('post.formation', $produit) }}" class="gi-btn-group compare"
                                                                    title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a> -->
                                                                
                                                                @if($produit->stock && $produit->qtyStock >= 1)
                                                                    <form method="post" action="{{ route('ajouter.panier.store', $produit->id) }}">
                                                                    @csrf
                                                                        <button type="submit" title="Ajouter au panier"
                                                                        class="gi-btn-group add-to-cart"><i class="fi-rr-shopping-basket"></i></button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="gi-pro-content">
                                                        <a href="shop-left-sidebar-col-3.html">
                                                            <h6 class="gi-pro-stitle">{{ $produit->nom }}</h6>
                                                        </a>
                                                        <h5 class="gi-pro-title">
                                                            <a href="{{ route('detail.produit', $produit) }}">{{ $produit->description }}</a>
                                                        </h5>
                                                        <div class="gi-pro-rat-price">
                                                            <span class="gi-pro-rating">
                                                                <i class="gicon gi-star fill"></i>
                                                                <i class="gicon gi-star fill"></i>
                                                                <i class="gicon gi-star fill"></i>
                                                                <i class="gicon gi-star fill"></i>
                                                                <i class="gicon gi-star"></i>
                                                            </span>
                                                            <span class="gi-price">
                                                                @if($produit->promo)
                                                                    <span class="new-price">{{ $produit->promo }} Fcfa</span>
                                                                    <span class="old-price">{{ $produit->prix }} F</span>
                                                                @else
                                                                    <span class="new-price">{{ $produit->prix }} Fcfa</span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                        @if($produit->stock && $produit->qtyStock >= 1)
                                                            <div class="gi-single-cart text-center mt-3">
                                                                <form method="post" action="{{ route('ajouter.panier.store', $produit->id) }}">
                                                                @csrf
                                                                    <button type="submit" class="btn btn-primary gi-btn-1 btn-card"><i class="fi-rr-shopping-basket"></i> ajouter</button>
                                                                </form>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @include('include.principale.produit')    
                                    @endforeach
                                @else
                                    <div class="col-lg-12">
                                        <div class="gi-accordion style-1">
                                            <div class="gi-accordion-item">
                                                <h4 class="gi-accordion-header">
                                                    Désolé! Aucun produit n'à été publié pour le moment pour le fournisseur {{ $vendeur->nom_entreprise }} sur la plateforme
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <!-- <div
                                    class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-6 gi-product-box pro-gl-content">
                                    <div class="gi-product-content">
                                        <div class="gi-product-inner">
                                            <div class="gi-pro-image-outer">
                                                <div class="gi-pro-image">
                                                    <a href="product-left-sidebar.html" class="image">
                                                        <span class="label veg">
                                                            <span class="dot"></span>
                                                        </span>
                                                        <img class="main-image" src="{{ asset("principale/assets/img/product-images/1_1.jpg") }}"
                                                            alt="Product">
                                                        <img class="hover-image" src="{{ asset("principale/assets/img/product-images/1_2.jpg") }}"
                                                            alt="Product">
                                                    </a>
                                                    <div class="gi-pro-actions">
                                                        <a class="gi-btn-group wishlist" title="Wishlist"><i
                                                                class="fi-rr-heart"></i></a>
                                                        <a href="#" class="gi-btn-group quickview"
                                                            data-link-action="quickview" title="Quick view"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#gi_quickview_modal"><i
                                                                class="fi-rr-eye"></i></a>
                                                        <a href="javascript:void(0)" class="gi-btn-group compare"
                                                            title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a>
                                                        <a href="javascript:void(0)" title="Add To Cart"
                                                            class="gi-btn-group add-to-cart"><i
                                                                class="fi-rr-shopping-basket"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gi-pro-content">
                                                <a href="shop-left-sidebar-col-3.html">
                                                    <h6 class="gi-pro-stitle">chips & fries</h6>
                                                </a>
                                                <h5 class="gi-pro-title"><a href="product-left-sidebar.html">Crunchy
                                                        Triangle Chips Snacks</a></h5>
                                                <p class="gi-info">Contrary to popular belief, Lorem Ipsum is not simply
                                                    random text. It has roots in a piece of classical Latin literature
                                                    from 45 BC, making it over 2000 years old.</p>

                                                <div class="gi-pro-rat-price">
                                                    <span class="gi-pro-rating">
                                                        <i class="gicon gi-star fill"></i>
                                                        <i class="gicon gi-star fill"></i>
                                                        <i class="gicon gi-star fill"></i>
                                                        <i class="gicon gi-star fill"></i>
                                                        <i class="gicon gi-star"></i>
                                                    </span>
                                                    <span class="gi-price">
                                                        <span class="new-price">$59.00</span>
                                                        <span class="old-price">$87.00</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <!-- Pagination Start -->
                        <!-- @if($produits->count() > 20)@endif -->
                            <div class="gi-pro-pagination" style="justify-content: flex-end;">
                                <ul class="gi-pro-pagination-inner">
                                    <li>{{ $produits->links() }}</li>
                                </ul>
                            </div>
                        
                        <!-- Pagination End -->
                    </div>
                    <!--Shop content End -->

                </div>
                <!-- Sidebar Area Start -->
                <div class="filter-sidebar-overlay"></div>
                <div class="gi-shop-sidebar gi-filter-sidebar col-lg-3 col-md-12">
                    <div class="sidebar-filter-title">
                        <h5>Filters</h5>
                        <a class="filter-close" href="javascript:void(0)">×</a>
                    </div>
                    <div id="shop_sidebar">
                        <div class="gi-sidebar-wrap">
                            <!-- Sidebar Category Block -->
                            <div class="gi-sidebar-block drop">
                                <div class="gi-sb-title">
                                    <h3 class="gi-sidebar-title">Category</h3>
                                </div>
                                <div class="gi-sb-block-content p-t-15">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="gi-sidebar-block-item main drop">clothes</a>
                                            <ul style="display: block;">
                                                <li>
                                                    <div class="gi-sidebar-sub-item"><a href="#">Men
                                                            <span>-25</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="gi-sidebar-sub-item"><a href="#">Women
                                                            <span>-52</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="gi-sidebar-sub-item"><a href="#">Boy
                                                            <span>-40</span></a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="gi-sb-block-content">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="gi-sidebar-block-item main drop">cosmetics</a>
                                            <ul>
                                                <li>
                                                    <div class="gi-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Men
                                                            <span>-25</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="gi-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Women
                                                            <span>-52</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="gi-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Boy
                                                            <span>-40</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="gi-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Girl
                                                            <span>-35</span></a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="gi-sb-block-content">
                                    <ul>
                                        <li>
                                            <a href="shop-left-sidebar-col-3.html" class="gi-sidebar-block-item main">shoes<span>-15</span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="gi-sb-block-content">
                                    <ul>
                                        <li>
                                            <a href="shop-left-sidebar-col-3.html" class="gi-sidebar-block-item main">bag<span>-27</span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="gi-sb-block-content">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="gi-sidebar-block-item main drop">electronics</a>
                                            <ul>
                                                <li>
                                                    <div class="gi-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Men
                                                            <span>-25</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="gi-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Women
                                                            <span>-52</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="gi-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Boy
                                                            <span>-40</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="gi-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Girl
                                                            <span>-35</span></a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar Brand Block -->
                            <div class="gi-sidebar-block">
                                <div class="gi-sb-title">
                                    <h3 class="gi-sidebar-title">Brand</h3>
                                </div>
                                <div class="gi-sb-block-content">
                                    <ul>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox" checked>
                                                <a href="javascript:void(0)">
                                                    <span><i class="fi-rr-cupcake"></i>Zencart Dairy</span>
                                                </a>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox">
                                                <a href="javascript:void(0)">
                                                    <span><i class="fi fi-rs-apple-whole"></i>Xeta Fruits</span>
                                                </a>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox">
                                                <a href="javascript:void(0)">
                                                    <span><i class="fi fi-rr-popcorn"></i>Pili Snack</span>
                                                </a>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox">
                                                <a href="javascript:void(0)">
                                                    <span><i class="fi fi-rr-drink-alt"></i>Indiana Juice</span>
                                                </a>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar Weight Block -->
                            <div class="gi-sidebar-block">
                                <div class="gi-sb-title">
                                    <h3 class="gi-sidebar-title">Weight</h3>
                                </div>
                                <div class="gi-sb-block-content">
                                    <ul>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox" value="" checked>
                                                <a href="#">500gm Pack</a>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <a href="#">1kg Pack</a>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <a href="#">2kg Pack</a>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <a href="#">5kg Pack</a>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar Color item -->
                            <div class="gi-sidebar-block color-block gi-sidebar-block-clr">
                                <div class="gi-sb-title">
                                    <h3 class="gi-sidebar-title">Color</h3>
                                </div>
                                <div class="gi-sb-block-content">
                                    <ul>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="gi-clr-block" style="background-color:#c4d6f9;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="gi-clr-block" style="background-color:#ff748b;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="gi-clr-block" style="background-color:#000000;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li class="active">
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="gi-clr-block" style="background-color:#2bff4a;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="gi-clr-block" style="background-color:#ff7c5e;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="gi-clr-block" style="background-color:#f155ff;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="gi-clr-block" style="background-color:#ffef00;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="gi-clr-block" style="background-color:#c89fff;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="gi-clr-block" style="background-color:#7bfffa;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="gi-clr-block" style="background-color:#56ffc1;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="gi-clr-block" style="background-color:#ffdb9f;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="gi-clr-block" style="background-color:#9f9f9f;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="gi-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="gi-clr-block" style="background-color:#6556ff;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar Price Block -->
                            <div class="gi-sidebar-block">
                                <div class="gi-sb-title">
                                    <h3 class="gi-sidebar-title">Price</h3>
                                </div>
                                <div class="gi-sb-block-content gi-price-range-slider es-price-slider">
                                    <div class="gi-price-filter">
                                        <div class="gi-price-input">
                                            <label class="filter__label">
                                                From<input type="text" class="filter__input">
                                            </label>
                                            <span class="gi-price-divider"></span>
                                            <label class="filter__label">
                                                To<input type="text" class="filter__input">
                                            </label>
                                        </div>
                                        <div id="gi-sliderPrice" class="filter__slider-price" data-min="0"
                                            data-max="250" data-step="10"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sidebar tags -->
                            <div class="gi-sidebar-block">
                                <div class="gi-sb-title">
                                    <h3 class="gi-sidebar-title">Tags</h3>
                                </div>
                                <div class="gi-tag-block gi-sb-block-content">
                                    <a href="shop-left-sidebar-col-3.html" class="gi-btn-2">Clothes</a>
                                    <a href="shop-left-sidebar-col-3.html" class="gi-btn-2">Fruits</a>
                                    <a href="shop-left-sidebar-col-3.html" class="gi-btn-2">Snacks</a>
                                    <a href="shop-left-sidebar-col-3.html" class="gi-btn-2">Dairy</a>
                                    <a href="shop-left-sidebar-col-3.html" class="gi-btn-2">Seafood</a>
                                    <a href="shop-left-sidebar-col-3.html" class="gi-btn-2">Fastfood</a>
                                    <a href="shop-left-sidebar-col-3.html" class="gi-btn-2">Toys</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop section End -->


    <!-- Service Section -->
    <section class="gi-service-section padding-tb-40 background">
        <div class="container">
            <div class="row m-tb-minus-12">
                <div class="gi-ser-content gi-ser-content-1 col-sm-6 col-md-6 col-lg-3 p-tp-12 wow fadeInUp">
                    <div class="gi-ser-inner">
                        <div class="gi-service-image">
                            <i class="fi fi-ts-truck-moving"></i>
                        </div>
                        <div class="gi-service-desc">
                            <h3>Livraison gratuite</h3>
                            <p>
                                Livraison gratuite sur
                                toutes les commandes
                                aux États-Unis ou
                                supérieures à 200 $
                            </p>
                        </div>
                    </div>
                </div>
                <div class="gi-ser-content gi-ser-content-2 col-sm-6 col-md-6 col-lg-3 p-tp-12 wow fadeInUp"
                    data-wow-delay=".4s">
                    <div class="gi-ser-inner">
                        <div class="gi-service-image">
                            <i class="fi fi-ts-hand-holding-seeding"></i>
                        </div>
                        <div class="gi-service-desc">
                            <h3>Assistance 24h/24 et 7j/7</h3>
                            <p>
                                Contactez-nous 24 heures sur 24, 7 jours sur 7
                            </p>
                        </div>
                    </div>
                </div>
                <div class="gi-ser-content gi-ser-content-3 col-sm-6 col-md-6 col-lg-3 p-tp-12 wow fadeInUp"
                    data-wow-delay=".6s">
                    <div class="gi-ser-inner">
                        <div class="gi-service-image">
                            <i class="fi fi-ts-badge-percent"></i>
                        </div>
                        <div class="gi-service-desc">
                            <h3>Retour sous 30 jours</h3>
                            <p>
                                Il suffit de le retourner dans les 30 jours pour un échange
                            </p>
                        </div>
                    </div>
                </div>
                <div class="gi-ser-content gi-ser-content-4 col-sm-6 col-md-6 col-lg-3 p-tp-12 wow fadeInUp"
                    data-wow-delay=".8s">
                    <div class="gi-ser-inner">
                        <div class="gi-service-image">
                            <i class="fi fi-ts-donate"></i>
                        </div>
                        <div class="gi-service-desc">
                            <h3>Paiement à la livraison</h3>
                            <p>
                                Contactez-nous 24 heures sur 24, 7 jours sur 7
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service Section End -->

    <!-- Trending, Top Rated Start -->
    <section class="gi-offer-section padding-tb-40 background">
        <div class="container">
            <div class="row">
                <!-- Banner -->
                <div
                    class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-6 gi-all-product-content gi-new-product-content wow fadeInUp">
                    <div class="gi-banner-inner">
                        <div class="gi-banner-block gi-banner-block-1">
                            <div class="banner-block">
                                <div class="banner-content">
                                    <div class="banner-text">
                                        <span class="gi-banner-title">Our top most products check it now</span>
                                    </div>
                                    <a href="shop-left-sidebar-col-3.html" class="gi-btn-2">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Trending -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-6 gi-all-product-content gi-new-product-content mt-767-40 wow fadeInUp"
                    data-wow-delay=".4s">
                    <div class="col-md-12">
                        <div class="section-title">
                            <div class="section-detail">
                                <h2 class="gi-title">Produit en <span>Promo</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="gi-trending-slider">
                        <div class="col-sm-12 gi-all-product-block">
                            <div class="gi-all-product-inner">
                                <div class="gi-pro-image-outer">
                                    <div class="gi-pro-image">
                                        <a href="product-left-sidebar.html" class="image">
                                            <img class="main-image" src="assets/img/product-images/10_1.jpg"
                                                alt="Product">
                                        </a>
                                    </div>
                                </div>
                                <div class="gi-pro-content">
                                    <h5 class="gi-pro-title"><a href="product-left-sidebar.html"
                                            title="Healthy Nutmix, 200g Pack">Healthy Nutmix, 200g Pack</a></h5>
                                    <h6 class="gi-pro-stitle"><a href="shop-left-sidebar-col-3.html">Driedfruit</a></h6>
                                    <div class="gi-pro-rat-price">
                                        <div class="gi-pro-rat-pri-inner">
                                            <span class="gi-price">
                                                <span class="new-price">$42.00</span>
                                                <span class="old-price">$45.00</span>
                                                <span class="qty">- 5 kg</span>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="add-to-cart" title="Add To Cart">
                                        <i class="fi-rr-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 gi-all-product-block">
                            <div class="gi-all-product-inner">
                                <div class="gi-pro-image-outer">
                                    <div class="gi-pro-image">
                                        <a href="product-left-sidebar.html" class="image">
                                            <img class="main-image" src="assets/img/product-images/11_1.jpg"
                                                alt="Product">
                                        </a>
                                    </div>
                                </div>
                                <div class="gi-pro-content">
                                    <h5 class="gi-pro-title"><a href="product-left-sidebar.html">Organic fresh
                                            tomato</a></h5>
                                    <h6 class="gi-pro-stitle"><a href="shop-left-sidebar-col-3.html">Vegetables</a></h6>
                                    <div class="gi-pro-rat-price">
                                        <div class="gi-pro-rat-pri-inner">
                                            <span class="gi-price">
                                                <span class="new-price">$25.00</span>
                                                <span class="old-price">$30.00</span>
                                                <span class="qty">- 250 g</span>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="add-to-cart" title="Add To Cart">
                                        <i class="fi-rr-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 gi-all-product-block">
                            <div class="gi-all-product-inner">
                                <div class="gi-pro-image-outer">
                                    <div class="gi-pro-image">
                                        <a href="product-left-sidebar.html" class="image">
                                            <img class="main-image" src="assets/img/product-images/19_1.jpg"
                                                alt="Product">
                                        </a>
                                    </div>
                                </div>
                                <div class="gi-pro-content">
                                    <h5 class="gi-pro-title"><a href="product-left-sidebar.html">Coffee with chocolate
                                            cream mix pack</a></h5>
                                    <h6 class="gi-pro-stitle"><a href="shop-left-sidebar-col-3.html">Coffee</a></h6>
                                    <div class="gi-pro-rat-price">
                                        <div class="gi-pro-rat-pri-inner">
                                            <span class="gi-price">
                                                <span class="new-price">$62.00</span>
                                                <span class="old-price">$65.00</span>
                                                <span class="qty">- 1 kg</span>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="add-to-cart" title="Add To Cart">
                                        <i class="fi-rr-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 gi-all-product-block">
                            <div class="gi-all-product-inner">
                                <div class="gi-pro-image-outer">
                                    <div class="gi-pro-image">
                                        <a href="product-left-sidebar.html" class="image">
                                            <img class="main-image" src="assets/img/product-images/25_1.jpg"
                                                alt="Product">
                                        </a>
                                    </div>
                                </div>
                                <div class="gi-pro-content">
                                    <h5 class="gi-pro-title"><a href="product-left-sidebar.html">Fresh Lichi</a></h5>
                                    <h6 class="gi-pro-stitle"><a href="shop-left-sidebar-col-3.html">Fruits</a></h6>
                                    <div class="gi-pro-rat-price">
                                        <div class="gi-pro-rat-pri-inner">
                                            <span class="gi-price">
                                                <span class="new-price">$10.00</span>
                                                <span class="old-price">$11.00</span>
                                                <span class="qty">- 500 g</span>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="add-to-cart" title="Add To Cart">
                                        <i class="fi-rr-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 gi-all-product-block">
                            <div class="gi-all-product-inner">
                                <div class="gi-pro-image-outer">
                                    <div class="gi-pro-image">
                                        <a href="product-left-sidebar.html" class="image">
                                            <img class="main-image" src="assets/img/product-images/5_1.jpg"
                                                alt="Product">
                                        </a>
                                    </div>
                                </div>
                                <div class="gi-pro-content">
                                    <h5 class="gi-pro-title"><a href="product-left-sidebar.html">Berry & Graps Mix
                                            Snack</a></h5>
                                    <h6 class="gi-pro-stitle"><a href="shop-left-sidebar-col-3.html">Driedfruit</a></h6>
                                    <div class="gi-pro-rat-price">
                                        <div class="gi-pro-rat-pri-inner">
                                            <span class="gi-price">
                                                <span class="new-price">$52.00</span>
                                                <span class="old-price">$55.00</span>
                                                <span class="qty">- 1 pcs</span>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="add-to-cart" title="Add To Cart">
                                        <i class="fi-rr-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 gi-all-product-block">
                            <div class="gi-all-product-inner">
                                <div class="gi-pro-image-outer">
                                    <div class="gi-pro-image">
                                        <a href="product-left-sidebar.html" class="image">
                                            <img class="main-image" src="assets/img/product-images/29_1.jpg"
                                                alt="Product">
                                        </a>
                                    </div>
                                </div>
                                <div class="gi-pro-content">
                                    <h5 class="gi-pro-title"><a href="product-left-sidebar.html">Pineapple</a></h5>
                                    <h6 class="gi-pro-stitle"><a href="shop-left-sidebar-col-3.html">Fruits</a></h6>
                                    <div class="gi-pro-rat-price">
                                        <div class="gi-pro-rat-pri-inner">
                                            <span class="gi-price">
                                                <span class="new-price">$20.00</span>
                                                <span class="old-price">$30.00</span>
                                                <span class="qty">- 12 pcs</span>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="add-to-cart" title="Add To Cart">
                                        <i class="fi-rr-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Top Rated -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-6 gi-all-product-content gi-new-product-content mt-1199-40 wow fadeInUp"
                    data-wow-delay=".6s">
                    <div class="col-md-12">
                        <div class="section-title">
                            <div class="section-detail">
                                <h2 class="gi-title">Nouvelle <span>Arrivé</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="gi-rated-slider">
                        <div class="col-sm-12 gi-all-product-block">
                            <div class="gi-all-product-inner">
                                <div class="gi-pro-image-outer">
                                    <div class="gi-pro-image">
                                        <a href="product-left-sidebar.html" class="image">
                                            <img class="main-image" src="assets/img/product-images/17_1.jpg"
                                                alt="Product">
                                        </a>
                                    </div>
                                </div>
                                <div class="gi-pro-content">
                                    <h5 class="gi-pro-title"><a href="product-left-sidebar.html">Ginger - Organic</a>
                                    </h5>
                                    <h6 class="gi-pro-stitle"><a href="shop-left-sidebar-col-3.html">vegetables</a></h6>
                                    <div class="gi-pro-rat-price">
                                        <div class="gi-pro-rat-pri-inner">
                                            <span class="gi-price">
                                                <span class="new-price">$62.00</span>
                                                <span class="old-price">$65.00</span>
                                                <span class="qty">- 1 kg</span>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="add-to-cart" title="Add To Cart">
                                        <i class="fi-rr-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 gi-all-product-block">
                            <div class="gi-all-product-inner">
                                <div class="gi-pro-image-outer">
                                    <div class="gi-pro-image">
                                        <a href="product-left-sidebar.html" class="image">
                                            <img class="main-image" src="assets/img/product-images/2_2.jpg"
                                                alt="Product">
                                        </a>
                                    </div>
                                </div>
                                <div class="gi-pro-content">
                                    <h5 class="gi-pro-title"><a href="product-left-sidebar.html">Dates Value Pouch Dates
                                            Value Pouch</a></h5>
                                    <h6 class="gi-pro-stitle"><a href="shop-left-sidebar-col-3.html">Driedfruit</a></h6>
                                    <div class="gi-pro-rat-price">
                                        <div class="gi-pro-rat-pri-inner">
                                            <span class="gi-price">
                                                <span class="new-price">$56.00</span>
                                                <span class="old-price">$78.00</span>
                                                <span class="qty">- 3 pcs</span>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="add-to-cart" title="Add To Cart">
                                        <i class="fi-rr-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 gi-all-product-block">
                            <div class="gi-all-product-inner">
                                <div class="gi-pro-image-outer">
                                    <div class="gi-pro-image">
                                        <a href="product-left-sidebar.html" class="image">
                                            <img class="main-image" src="assets/img/product-images/23_1.jpg"
                                                alt="Product">
                                        </a>
                                    </div>
                                </div>
                                <div class="gi-pro-content">
                                    <h5 class="gi-pro-title"><a href="product-left-sidebar.html">Blue berry</a></h5>
                                    <h6 class="gi-pro-stitle"><a href="shop-left-sidebar-col-3.html">Fruits</a></h6>
                                    <div class="gi-pro-rat-price">
                                        <div class="gi-pro-rat-pri-inner">
                                            <span class="gi-price">
                                                <span class="new-price">$25.00</span>
                                                <span class="old-price">$30.00</span>
                                                <span class="qty">- 250 g</span>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="add-to-cart" title="Add To Cart">
                                        <i class="fi-rr-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 gi-all-product-block">
                            <div class="gi-all-product-inner">
                                <div class="gi-pro-image-outer">
                                    <div class="gi-pro-image">
                                        <a href="product-left-sidebar.html" class="image">
                                            <img class="main-image" src="assets/img/product-images/13_1.jpg"
                                                alt="Product">
                                        </a>
                                    </div>
                                </div>
                                <div class="gi-pro-content">
                                    <h5 class="gi-pro-title"><a href="product-left-sidebar.html">Onion - Hybrid</a></h5>
                                    <h6 class="gi-pro-stitle"><a href="shop-left-sidebar-col-3.html">vegetables</a></h6>
                                    <div class="gi-pro-rat-price">
                                        <div class="gi-pro-rat-pri-inner">
                                            <span class="gi-price">
                                                <span class="new-price">$20.00</span>
                                                <span class="old-price">$30.00</span>
                                                <span class="qty">- 12 pcs</span>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="add-to-cart" title="Add To Cart">
                                        <i class="fi-rr-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 gi-all-product-block">
                            <div class="gi-all-product-inner">
                                <div class="gi-pro-image-outer">
                                    <div class="gi-pro-image">
                                        <a href="product-left-sidebar.html" class="image">
                                            <img class="main-image" src="assets/img/product-images/12_1.jpg"
                                                alt="Product">
                                        </a>
                                    </div>
                                </div>
                                <div class="gi-pro-content">
                                    <h5 class="gi-pro-title"><a href="product-left-sidebar.html">Potato</a></h5>
                                    <h6 class="gi-pro-stitle"><a href="shop-left-sidebar-col-3.html">Vegetables</a></h6>
                                    <div class="gi-pro-rat-price">
                                        <div class="gi-pro-rat-pri-inner">
                                            <span class="gi-price">
                                                <span class="new-price">$50.00</span>
                                                <span class="old-price">$55.00</span>
                                                <span class="qty">- 2 pack</span>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="add-to-cart" title="Add To Cart">
                                        <i class="fi-rr-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 gi-all-product-block">
                            <div class="gi-all-product-inner">
                                <div class="gi-pro-image-outer">
                                    <div class="gi-pro-image">
                                        <a href="product-left-sidebar.html" class="image">
                                            <img class="main-image" src="assets/img/product-images/28_1.jpg"
                                                alt="Product">
                                        </a>
                                    </div>
                                </div>
                                <div class="gi-pro-content">
                                    <h5 class="gi-pro-title"><a href="product-left-sidebar.html">Mango - Kesar</a></h5>
                                    <h6 class="gi-pro-stitle"><a href="shop-left-sidebar-col-3.html">Fruits</a></h6>
                                    <div class="gi-pro-rat-price">
                                        <div class="gi-pro-rat-pri-inner">
                                            <span class="gi-price">
                                                <span class="new-price">$52.00</span>
                                                <span class="old-price">$55.00</span>
                                                <span class="qty">- 1 pcs</span>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="add-to-cart" title="Add To Cart">
                                        <i class="fi-rr-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Top Selling -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-6 gi-all-product-content gi-new-product-content mt-1199-40 wow fadeInUp"
                    data-wow-delay=".8s">
                    <div class="col-md-12">
                        <div class="section-title">
                            <div class="section-detail">
                                <h2 class="gi-title">Veilleur <span>Vendu</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="gi-trending-slider">
                        <div class="col-sm-12 gi-all-product-block">
                            <div class="gi-all-product-inner">
                                <div class="gi-pro-image-outer">
                                    <div class="gi-pro-image">
                                        <a href="product-left-sidebar.html" class="image">
                                            <img class="main-image" src="assets/img/product-images/18_1.jpg"
                                                alt="Product">
                                        </a>
                                    </div>
                                </div>
                                <div class="gi-pro-content">
                                    <h5 class="gi-pro-title"><a href="product-left-sidebar.html">Lemon - Seedless</a>
                                    </h5>
                                    <h6 class="gi-pro-stitle"><a href="shop-left-sidebar-col-3.html">Vegetables</a></h6>
                                    <div class="gi-pro-rat-price">
                                        <div class="gi-pro-rat-pri-inner">
                                            <span class="gi-price">
                                                <span class="new-price">$42.00</span>
                                                <span class="old-price">$45.00</span>
                                                <span class="qty">- 5 kg</span>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="add-to-cart" title="Add To Cart">
                                        <i class="fi-rr-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 gi-all-product-block">
                            <div class="gi-all-product-inner">
                                <div class="gi-pro-image-outer">
                                    <div class="gi-pro-image">
                                        <a href="product-left-sidebar.html" class="image">
                                            <img class="main-image" src="assets/img/product-images/28_1.jpg"
                                                alt="Product">
                                        </a>
                                    </div>
                                </div>
                                <div class="gi-pro-content">
                                    <h5 class="gi-pro-title"><a href="product-left-sidebar.html">Mango - Kesar</a></h5>
                                    <h6 class="gi-pro-stitle"><a href="shop-left-sidebar-col-3.html">Fruits</a></h6>
                                    <div class="gi-pro-rat-price">
                                        <div class="gi-pro-rat-pri-inner">
                                            <span class="gi-price">
                                                <span class="new-price">$62.00</span>
                                                <span class="old-price">$65.00</span>
                                                <span class="qty">- 1 kg</span>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="add-to-cart" title="Add To Cart">
                                        <i class="fi-rr-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 gi-all-product-block">
                            <div class="gi-all-product-inner">
                                <div class="gi-pro-image-outer">
                                    <div class="gi-pro-image">
                                        <a href="product-left-sidebar.html" class="image">
                                            <img class="main-image" src="assets/img/product-images/7_2.jpg"
                                                alt="Product">
                                        </a>
                                    </div>
                                </div>
                                <div class="gi-pro-content">
                                    <h5 class="gi-pro-title"><a href="product-left-sidebar.html">Mixed Nuts & Almonds
                                            Dry Fruits</a></h5>
                                    <h6 class="gi-pro-stitle"><a href="shop-left-sidebar-col-3.html">Driedfruit</a></h6>
                                    <div class="gi-pro-rat-price">
                                        <div class="gi-pro-rat-pri-inner">
                                            <span class="gi-price">
                                                <span class="new-price">$10.00</span>
                                                <span class="old-price">$11.00</span>
                                                <span class="qty">- 500 g</span>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="add-to-cart" title="Add To Cart">
                                        <i class="fi-rr-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 gi-all-product-block">
                            <div class="gi-all-product-inner">
                                <div class="gi-pro-image-outer">
                                    <div class="gi-pro-image">
                                        <a href="product-left-sidebar.html" class="image">
                                            <img class="main-image" src="assets/img/product-images/3_1.jpg"
                                                alt="Product">
                                        </a>
                                    </div>
                                </div>
                                <div class="gi-pro-content">
                                    <h5 class="gi-pro-title"><a href="product-left-sidebar.html">Californian Almonds
                                            Value Pack</a></h5>
                                    <h6 class="gi-pro-stitle"><a href="shop-left-sidebar-col-3.html">Driedfruit</a></h6>
                                    <div class="gi-pro-rat-price">
                                        <div class="gi-pro-rat-pri-inner">
                                            <span class="gi-price">
                                                <span class="new-price">$25.00</span>
                                                <span class="old-price">$30.00</span>
                                                <span class="qty">- 250 g</span>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="add-to-cart" title="Add To Cart">
                                        <i class="fi-rr-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 gi-all-product-block">
                            <div class="gi-all-product-inner">
                                <div class="gi-pro-image-outer">
                                    <div class="gi-pro-image">
                                        <a href="product-left-sidebar.html" class="image">
                                            <img class="main-image" src="assets/img/product-images/13_1.jpg"
                                                alt="Product">
                                        </a>
                                    </div>
                                </div>
                                <div class="gi-pro-content">
                                    <h5 class="gi-pro-title"><a href="product-left-sidebar.html">Onion - Hybrid</a></h5>
                                    <h6 class="gi-pro-stitle"><a href="shop-left-sidebar-col-3.html">vegetables</a></h6>
                                    <div class="gi-pro-rat-price">
                                        <div class="gi-pro-rat-pri-inner">
                                            <span class="gi-price">
                                                <span class="new-price">$20.00</span>
                                                <span class="old-price">$30.00</span>
                                                <span class="qty">- 12 pcs</span>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="add-to-cart" title="Add To Cart">
                                        <i class="fi-rr-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 gi-all-product-block">
                            <div class="gi-all-product-inner">
                                <div class="gi-pro-image-outer">
                                    <div class="gi-pro-image">
                                        <a href="product-left-sidebar.html" class="image">
                                            <img class="main-image" src="assets/img/product-images/5_1.jpg"
                                                alt="Product">
                                        </a>
                                    </div>
                                </div>
                                <div class="gi-pro-content">
                                    <h5 class="gi-pro-title"><a href="product-left-sidebar.html">Berry & Graps Mix
                                            Snack</a></h5>
                                    <h6 class="gi-pro-stitle"><a href="shop-left-sidebar-col-3.html">Driedfruit</a></h6>
                                    <div class="gi-pro-rat-price">
                                        <div class="gi-pro-rat-pri-inner">
                                            <span class="gi-price">
                                                <span class="new-price">$52.00</span>
                                                <span class="old-price">$55.00</span>
                                                <span class="qty">- 1 pcs</span>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="add-to-cart" title="Add To Cart">
                                        <i class="fi-rr-shopping-basket"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Trending, Top Rated End -->

    <!-- Blog Section Start -->
    <!-- <section class="gi-blog-section padding-tb-40 wow fadeInUp background">
        <div class="container">
            <div class="row m-b-minus-24px">
                <div class="section-title">
                    <div class="section-detail">
                        <h2 class="gi-title">Latest <span>Blog</span></h2>
                        <p>We tackle interesting topics every day in 2023.</p>
                    </div>
                    <span class="title-link">
                        <a href="blog-left-sidebar.html">All Blogs<i class="fi-rr-angle-double-small-right"></i></a>
                    </span>
                </div>
                <div class="gi-blog-carousel owl-carousel">
                    <div class="gi-blog-item">
                        <div class="blog-info">
                            <figure class="blog-img"><a href="#"><img src="assets/img/blog/1.jpg" alt="news imag"></a>
                            </figure>
                            <div class="detail">
                                <label>June 30,2022 - <a href="#">Organic</a></label>
                                <h3><a href="#">Marketing Guide: 5 Steps to Success to way.</a></h3>
                                <div class="more-info">
                                    <a href="blog-detail-left-sidebar.html">Read More<i
                                            class="fi-rr-angle-double-small-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gi-blog-item">
                        <div class="blog-info">
                            <figure class="blog-img"><a href="#"><img src="assets/img/blog/2.jpg" alt="news imag"></a>
                            </figure>
                            <div class="detail">
                                <label>April 02,2022 - <a href="#">Fruits</a></label>
                                <h3><a href="#">Best way to solve business deal issue in market.</a></h3>
                                <div class="more-info">
                                    <a href="blog-detail-left-sidebar.html">Read More<i
                                            class="fi-rr-angle-double-small-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gi-blog-item">
                        <div class="blog-info">
                            <figure class="blog-img"><a href="#"><img src="assets/img/blog/3.jpg" alt="news imag"></a>
                            </figure>
                            <div class="detail">
                                <label>Mar 09,2022 - <a href="#">Vegetables</a></label>
                                <h3><a href="#">31 grocery customer service stats know in 2019.</a></h3>
                                <div class="more-info">
                                    <a href="blog-detail-left-sidebar.html">Read More<i
                                            class="fi-rr-angle-double-small-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gi-blog-item">
                        <div class="blog-info">
                            <figure class="blog-img"><a href="#"><img src="assets/img/blog/4.jpg" alt="news imag"></a>
                            </figure>
                            <div class="detail">
                                <label>January 25,2022 - <a href="#">Fastfood</a></label>
                                <h3><a href="#">Business ideas to grow your business traffic.</a></h3>
                                <div class="more-info">
                                    <a href="blog-detail-left-sidebar.html">Read More<i
                                            class="fi-rr-angle-double-small-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gi-blog-item">
                        <div class="blog-info">
                            <figure class="blog-img"><a href="#"><img src="assets/img/blog/5.jpg" alt="news imag"></a>
                            </figure>
                            <div class="detail">
                                <label>December 10,2021 - <a href="#">Fruits</a></label>
                                <h3><a href="#">Marketing Guide: 5 Steps way to Success.</a></h3>
                                <div class="more-info">
                                    <a href="blog-detail-left-sidebar.html">Read More<i
                                            class="fi-rr-angle-double-small-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gi-blog-item">
                        <div class="blog-info">
                            <figure class="blog-img"><a href="#"><img src="assets/img/blog/6.jpg" alt="news imag"></a>
                            </figure>
                            <div class="detail">
                                <label>August 08,2021 - <a href="#">Vegetables</a></label>
                                <h3><a href="#">15 customer service stats idea know in 2023.</a></h3>
                                <div class="more-info">
                                    <a href="blog-detail-left-sidebar.html">Read More<i
                                            class="fi-rr-angle-double-small-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Blog Section End -->

    

@endsection    