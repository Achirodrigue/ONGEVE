@extends('principale.layout.app')
@section('body')

    @include('include.principale.message')

    @php 
        $panier = getpriceSF(Cart::subtotal()) ;
    @endphp

    <!-- Breadcrumb start -->
    <div class="gi-breadcrumb m-b-40 background">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row gi_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="gi-breadcrumb-title">Facturation</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- gi-breadcrumb-list start -->
                            <ul class="gi-breadcrumb-list">
                                <li class="gi-breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
                                <li class="gi-breadcrumb-item active">Facture</li>
                            </ul>
                            <!-- gi-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb end -->

    <!-- Checkout section -->
    <section class="gi-checkout-section padding-tb-40 background">
        <h2 class="d-none">Checkout Page</h2>
        <div class="container">
            <div class="row">
                <!-- @if(session()->has('client') && session()->has('commande'))
                    @php
                        $client = session('client');
                        $commande = session('commande');
                    @endphp
                    <div class="col-12">
                        <a href="{{ route('pdf.commande', ['client' => $client, 'commande' => $commande]) }}" target="_blank">
                            <span class="gi-check-order-btn">
                                <button type="submit" class="gi-btn-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0"/>
                                    </svg>
                                    Télécharger la facture
                                </button>
                            </span>
                        </a>
                    </div>
                @endif -->
                <!-- Sidebar Area Start -->
                <div class="gi-checkout-rightside col-lg-4 col-md-12">
                    <div class="gi-sidebar-wrap p-3">
                        <!-- Sidebar Summary Block -->
                        <div class="gi-sidebar-block">
                            <div class="gi-sb-title">
                                <h3 class="gi-sidebar-title">Recapitulatif</h3>
                            </div>
                            <div class="gi-sb-block-content">
                                <div class="gi-checkout-pro">
                                    @foreach (Cart::content() as $produit)
                                        <div class="col-sm-12 mb-6">
                                            <div class="gi-product-inner">
                                                <div class="gi-pro-image-outer">
                                                    <div class="gi-pro-image">
                                                        <a href="product-left-sidebar.html" class="image">
                                                            <img class="main-image" src="{{ asset(Storage::url($produit->model->image)) }}"
                                                                alt="Product">
                                                            <img class="hover-image" src="{{ asset(Storage::url($produit->model->image)) }}"
                                                                alt="Product">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="gi-pro-content">
                                                    <h5 class="gi-pro-title"><a href="#" class="text-dark">{{ $produit->model->nom }}</a></h5>
                                                    <div class="gi-pro-rating">
                                                        <i class="gicon gi-star fill"></i>
                                                        <i class="gicon gi-star fill"></i>
                                                        <i class="gicon gi-star fill"></i>
                                                        <i class="gicon gi-star fill"></i>
                                                        <i class="gicon gi-star"></i>
                                                    </div>
                                                    <span class="gi-price">
                                                        <span class="new-price text-dark">{{ $produit->price }}F X {{ $produit->qty }}</span>
                                                    </span>
                                                    <span class="gi-price">
                                                        <span class="new-price text-dark">{{ getprice($produit->subtotal()) }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="gi-checkout-summary mt-5">
                                    <div>
                                        <a href="{{ route('accueil') }}"><span class="text-left">Sous Total</span></a>
                                        <span class="text-right">{{ getprice(Cart::subtotal()) }}</span>
                                    </div>
                                    <div>
                                        <span class="text-left"><i class="bi bi-truck" style="font-size: 2em;"></i> Frais de livraison</span>
                                        <span class="text-right" id="FT">{{ $Psecteur->frais_livraison }} F</span>
                                    </div>
                                    <!-- <div>
                                        <span class="text-left">Coupan Discount</span>
                                        <span class="text-right"><a class="gi-checkout-coupan">Apply Coupan</a></span>
                                    </div> -->
                                    <!-- <div class="gi-checkout-coupan-content">
                                        <form class="gi-checkout-coupan-form" name="gi-checkout-coupan-form"
                                            method="post" action="#">
                                            <input class="gi-coupan" type="text" required=""
                                                placeholder="Enter Your Coupan Code" name="gi-coupan" value="">
                                            <button class="gi-coupan-btn gi-btn-2" type="submit" name="subscribe"
                                                value="">Apply</button>
                                        </form>
                                    </div> -->
                                    <div class="gi-checkout-summary-total">
                                        <span class="text-left">Total à payer</span>
                                        <span class="text-right" id="TP">{{ getprice($panier + $Psecteur->frais_livraison) }}</span>
                                        <!-- <span class="text-right" id="test"></span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block {{ getprice(Cart::subtotal()) }}-->
                    </div>
                    <div class="gi-sidebar-wrap gi-check-pay-img-wrap">
                        <!-- Sidebar Payment Block -->
                        <div class="gi-sidebar-block">
                            <div class="gi-sb-title">
                                <h3 class="gi-sidebar-title">Methode de Paiement</h3>
                            </div>
                            <div class="gi-sb-block-content">
                                <div class="gi-check-pay-img-inner">
                                    <div class="gi-check-pay-img">
                                        <img src="assets/img/hero-bg/payment.png" alt="payment">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Payment Block -->
                    </div>
                </div>
                <div class="gi-checkout-leftside col-lg-8 col-md-12 m-t-991">
                    <!-- checkout content Start -->
                    <div class="gi-checkout-content">
                        <form action="{{ route('commande.store') }}" method="post">
                        @csrf
                            <div class="gi-checkout-inner">
                                <div class="gi-checkout-wrap m-b-40">
                                    <div class="gi-checkout-block gi-check-new mb-0">
                                        <h3 class="gi-checkout-title">Tarif de l'expédition (Frais de livraison)</h3>
                                        <div class="gi-check-block-content">
                                            <div class="gi-check-subtitle">Veillez cocher une case s'il vous plait!</div>
                                                @php $n=1; @endphp
                                                @foreach($secteurs as $secteur)
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="{{ $secteur->nom }}-{{ $secteur->frais_livraison }}" name="frais_livraison" id="frais" @if($n==1) checked @endif>

                                                        <!-- <input class="form-check-input" type="radio" value="{{ $secteur->nom }}-{{ $secteur->frais_livraison }}" name="frais_livraison" id="frais"
                                                            oninput="calculerFrais({{ $secteur->nom }}-{{ $secteur->frais_livraison }}, {{ $panier }})" checked> -->
                                                        <label class="form-check-label" for="exampleRadios2">
                                                        {{ $secteur->nom }} : {{ $secteur->frais_livraison }} Fcfa
                                                        </label>
                                                        @error('frais_livraison') <span class="text-danger mt-0">{{ $message }}</span> @enderror
                                                    </div>

                                                    @php $n++; @endphp
                                                @endforeach
                                                
                                                <!-- <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="1500" name="frais_livraison" id="frais1"
                                                        oninput="calculerFrais(1500, {{ $panier }})" checked>
                                                    <label class="form-check-label" for="exampleRadios2">
                                                        A l'interieur d'abidjan : 1500 Fcfa
                                                    </label>
                                                    @error('frais_livraison') <span class="text-danger mt-0">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="2000" name="frais_livraison" id="frais2"
                                                        oninput="calculerFrais(2000, {{ $panier }})">
                                                    <label class="form-check-label" for="exampleRadios2">
                                                        Bassam : 2000 Fcfa
                                                    </label>
                                                    @error('frais_livraison') <span class="text-danger mt-0">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="frais_livraison" value="5000" id="frais3"
                                                        oninput="calculerFrais(5000, {{ $panier }})">
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        Autre : 5000 Fcfa
                                                    </label>
                                                    @error('frais_livraison') <span class="text-danger mt-0">{{ $message }}</span> @enderror
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="gi-checkout-wrap m-b-40 padding-bottom-3">
                                    <div class="gi-checkout-block gi-check-bill">
                                        <h3 class="gi-checkout-title">Facturation et Expédition</h3>
                                        <div class="gi-bl-block-content">
                                            <div class="gi-check-bill-form">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span class="gi-bill-wrap gi-bill-half">
                                                            <label>Nom *</label>
                                                            <input type="text" name="nom" value="{{ old('nom') }}" placeholder="Entrer votre nom" required>
                                                            @error('nom') <span class="text-danger position-error mt-0">{{ $message }}</span> @enderror
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span class="gi-bill-wrap gi-bill-half">
                                                            <label>Prenom *</label>
                                                            <input type="text" name="prenom" value="{{ old('prenom') }}" placeholder="Entrer votre prenom" required>
                                                            @error('prenom') <span class="text-danger position-error">{{ $message }}</span> @enderror
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span class="gi-bill-wrap gi-bill-half">
                                                            <label>Email (facultatif)</label>
                                                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Entrer votre email">
                                                            @error('email') <span class="text-danger position-error">{{ $message }}</span> @enderror
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span class="gi-bill-wrap gi-bill-half">
                                                            <label>Contact *</label>
                                                            <input type="number" minlength="8" maxlength="10" name="contact" value="{{ old('contact') }}" placeholder="Entrer votre contact" required>
                                                            @error('contact') <span class="text-danger position-error">{{ $message }}</span> @enderror
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span class="gi-bill-wrap gi-bill-half">
                                                            <label>Commune ou ville *</label>
                                                            <select name="secteur" id="tester" required onchange="calculerFraisTest({{ $panier }})">
                                                                @foreach($secteurs as $secteur)
                                                                    <option value="{{ $secteur->nom }}-{{ $secteur->frais_livraison }}">{{ $secteur->nom }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('secteur') <span class="text-danger position-error">{{ $message }}</span> @enderror
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6"> 
                                                        <span class="gi-bill-wrap gi-bill-half">
                                                            <label>Adresse de livraison *</label>
                                                            <input type="text" name="adresse_livraison" value="{{ old('adresse_livraison') }}" placeholder="Entrer votre adresse de livraison" required>
                                                            @error('quartier') <span class="text-danger position-error">{{ $message }}</span> @enderror
                                                        </span>
                                                    </div>
                                                    <div class="col-md-12"> 
                                                        <span class="gi-bill-wrap gi-bill-half">
                                                            <label>Lieu d'habitation *</label>
                                                            <input type="text" name="adresse" value="{{ old('adresse') }}" placeholder="Entrer votre lieu d'habitation" required>
                                                            @error('adresse') <span class="text-danger position-error">{{ $message }}</span> @enderror
                                                        </span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <span class="gi-bill-wrap">
                                                            <label>Note de commande</label>
                                                            <textarea name="note_commande" rows="5" class="pt-2" placeholder="Un petit mot pour plus d'information sur la commande."></textarea>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <span class="gi-check-order-btn">
                                        <button type="submit" class="gi-btn-2">Envoyer la commande</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--cart content End -->
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout section End -->


    <!-- Team Section -->
    <section class="gi-team-section padding-tb-40 background">
        <div class="container">
            @if(produit()->count() > 0)
                <div class="section-title-2">
                    <h2 class="gi-title">Nouveau <span>Arrivés</span></h2>
                    <p>Decouvrez des produits exellents et de bonnes qualité.</p>
                </div>
                <div class="gi-team owl-carousel">  
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
                            @foreach($categorie->souscategories as $souscategories)
                                @if($souscategories->produits->where('isvalide', 1)->count() > 0)
                                    @php 
                                        $produitC = $souscategories->produits()->where('isvalide', 1)->orderBy('updated_at','desc')->get()->take(2)
                                    @endphp
                                    @foreach($produitC as $produit)   
                                        <div class="gi-team-box">
                                            <div class="gi-product-content">
                                                <div class="gi-product-inner">
                                                    <div class="gi-pro-image-outer">
                                                        <div class="gi-pro-image">
                                                            <a href="{{ route('detail.produit', $produit) }}" class="image">
                                                                <span class="label veg">
                                                                    <span class="dot"></span>
                                                                </span>
                                                                <div id="carou{{ $produit->id }}Interval" class="carousel slide" data-bs-ride="carousel">
                                                                    <div class="carousel-inner">
                                                                        <div class="carousel-item active" data-bs-interval="5000">
                                                                                <img src="{{ asset(Storage::url($produit->produitimg->image1)) }}" class="d-block w-100" alt="...">
                                                                        </div>
                                                                        @if($produit->produitimg->image2)
                                                                                <div class="carousel-item" data-bs-interval="5000">
                                                                                    <img src="{{ asset(Storage::url($produit->produitimg->image2)) }}" class="d-block w-100" alt="...">
                                                                                </div>
                                                                        @endif
                                                                        @if($produit->produitimg->image3)
                                                                                <div class="carousel-item" data-bs-interval="5000">
                                                                                    <img src="{{ asset(Storage::url($produit->produitimg->image3)) }}" class="d-block w-100" alt="...">
                                                                                </div>
                                                                        @endif
                                                                        @if($produit->produitimg->image4)
                                                                                <div class="carousel-item">
                                                                                    <img src="{{ asset(Storage::url($produit->produitimg->image4)) }}" class="d-block w-100" alt="...">
                                                                                </div>
                                                                        @endif
                                                                    </div>
                                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carou{{ $produit->id }}Interval" data-bs-slide="prev">
                                                                        <span class="carousel-control-prev-icon left-icon" aria-hidden="true"></span>
                                                                        <span class="visually-hidden">Previous</span>
                                                                    </button>
                                                                    <button class="carousel-control-next" type="button" data-bs-target="#carou{{ $produit->id }}Interval" data-bs-slide="next">
                                                                        <span class="carousel-control-next-icon right-icon" aria-hidden="true"></span>
                                                                        <span class="visually-hidden">Next</span>
                                                                    </button>
                                                                </div>
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
                                                                <!-- <a href="#" class="gi-btn-group quickview"
                                                                    data-link-action="quickview" title="Quick view"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#addProduitPanier{{ $produit->id }}"><i
                                                                        class="fi-rr-eye"></i></a> -->
                                                                @if($produit->stock && $produit->qtyStock >= 1)
                                                                    <form method="post" action="{{ route('ajouter.panier.store', $produit->id) }}">
                                                                    @csrf
                                                                        <button type="submit" title="Ajouter au panier"
                                                                        class="gi-btn-group add-to-cart"><i
                                                                            class="fi-rr-shopping-basket"></i></button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="gi-pro-content">
                                                        <a href="#">
                                                            <h6 class="gi-pro-stitle">{{ $produit->nom }}</h6>
                                                        </a>
                                                        <h5 class="gi-pro-title">
                                                            <a href="#">{{ $produit->description }}</a>
                                                        </h5>
                                                        <div class="gi-pro-rat-price">
                                                            <span class="gi-pro-rating">
                                                                @for($i=1; $i <= etoileProduit($produit) ; $i++)
                                                                    <i class="gicon gi-star fill"></i>
                                                                @endfor
                                                                @for($i=1; $i <= (5 - etoileProduit($produit)); $i++)
                                                                    <i class="gicon gi-star"></i>
                                                                @endfor
                                                            </span>
                                                            <span class="gi-price">
                                                                @if($produit->promo)
                                                                    <span class="new-price">{{ getprice($produit->promo) }}</span>
                                                                    <span class="old-price">{{ getprice($produit->prix) }}</span>
                                                                @else
                                                                    <span class="new-price">{{ getprice($produit->prix) }}</span>
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
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>
            @else
                <div class="section-title-2">
                    <h2 class="gi-title">Nouveau <span>Arrivés</span></h2>
                    <p>Decouvrez des produits exellents et de bonnes qualité.</p>
                </div>
            @endif
        </div>
    </section>
    <!-- Facts Section End -->


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const radios = document.querySelectorAll('input[name="frais_livraison"]');
            const select = document.getElementById("tester");
            const panier = {{ $panier }}; // récupéré depuis Laravel

            // Fonction de calcul
            function calculerFrais(value, panier) {
                const parts = value.split("-");
                const frais = parseInt(parts[1]);

                // Mettre à jour l'affichage
                const FT = frais.toLocaleString('fr-FR') + " F";
                const TP = (frais + panier).toLocaleString('fr-FR') + " F";

                document.getElementById('FT').textContent = FT;
                document.getElementById('TP').textContent = TP;
            }

            // Quand on change le select → on coche la radio correspondante
            select.addEventListener("change", function () {
                radios.forEach(radio => {
                    if (radio.value === select.value) {
                        radio.checked = true;
                        calculerFrais(radio.value, panier);
                    }
                });
            });

            // Quand on coche une radio → on met à jour le select
            radios.forEach(radio => {
                radio.addEventListener("change", function () {
                    if (radio.checked) {
                        select.value = radio.value;
                        calculerFrais(radio.value, panier);
                    }
                });
            });

            // Optionnel : lancer la fonction une fois au chargement si besoin
            const checkedRadio = document.querySelector('input[name="frais_livraison"]:checked');
            if (checkedRadio) {
                calculerFrais(checkedRadio.value, panier);
            }
        });
    </script>


@endsection