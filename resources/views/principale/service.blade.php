@extends('principale.layout.app')
@section('body')

@include('include.principale.message')

<!-- Breadcrumb start -->
<div class="gi-breadcrumb m-b-40 background">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row gi_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="gi-breadcrumb-title">Services</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- gi-breadcrumb-list start -->
                        <ul class="gi-breadcrumb-list">
                            <li class="gi-breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
                            <li class="gi-breadcrumb-item active">Service</li>
                        </ul>
                        <!-- gi-breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb end -->

<!-- Hero Slider Start -->
<section class="section gi-hero m-tb-40 background">
    <div class="container">
        <div class="padding-b-40 m-b-40">
            <div class="row">
                <div class="col-md-12">
                    <div class="gi-ofr-banners">
                        <div class="gi-bnr-body">
                            <div class="gi-bnr-img">
                                <!-- <span class="lbl">70% Off</span> -->
                                <img src="{{ asset("principale/assets/img/perso/service005.jpg") }}" alt=" banner">
                            </div>
                            <!-- <div class="gi-bnr-detail">
                                    <h5>Fresh Fruits & veggies</h5>
                                    <p>The flavor of something special.</p>
                                    <a href="shop-left-sidebar-col-3.html" class="gi-btn-2">Shop Now</a>
                                </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Slider End -->

<!-- Blog section -->
<section class="gi-blog padding-tb-40 background">
    <div class="container">
        <div class="row">
            <div class="gi-blogs-rightside col-lg-8 order-lg-last col-md-12 order-md-first">

                <!-- Blog content Start -->
                <div class="gi-blogs-content">
                    <div class="gi-blogs-inner">
                        <div class="gi-single-blog-item">
                            <div class="single-blog-info">
                                <figure class="blog-img"><a href="#"><img src="{{ asset("principale/assets/img/perso/80.jpg") }}" alt="news imag"></a>
                                </figure>

                                <div class="single-blog-detail">
                                    <label>Articles tendance <a href="#">+</a></label>
                                    <h3 service-color>Rejoignez notre communauté dès maintenant et accédez à des offres exclusives</h3>
                                    <p class="gi-text service-color">
                                        Ne manquez pas l'occasion de faire partie de notre cercle privilégié.
                                        En vous inscrivant, vous accédez à des offres exclusives, des promotions réservées, et bien plus encore, directement sur notre site <a href="#">ravmelinformatique.com</a>
                                        <br>
                                        Ne manquez pas l'opportunité de transformer vos achats en véritables expériences uniques. Cliquez dès maintenant et commencez à explorer un monde de privilèges !.
                                    </p>
                                    <p class="gi-text-highlight service-color">
                                        <a href="#"> Inscrivez-vous aujourd'hui et profitez de réductions inédites rien que pour vous !</a>
                                    </p>

                                    <div class=" sub-img">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="{{ asset("principale/assets/img/perso/cosmos_100.jpg") }}" alt="Cosmos">
                                            </div>
                                            <div class="col-md-6">
                                                <img src="{{ asset("principale/assets/img/perso/caipro_001.jpg") }}" alt="caipro">
                                            </div>
                                        </div>
                                    </div>
                                    <p>
                                    <h5>
                                        <strong>Nos partenaires : les piliers de notre réussite.</strong>
                                    </h5>
                                    </p>

                                    <p class="service-color">
                                        Nous avons une conviction :
                                        la réussite n'est jamais le fruit d'une seule main, mais le résultat d'une collaboration harmonieuse.
                                        C'est pourquoi nous sommes fiers de mettre en lumière nos précieux partenaires,
                                        véritables artisans de notre succès.

                                        <br>
                                        <br>

                                        Grâce à leur expertise, leur engagement et leur confiance,
                                        nous avons pu construire cette une plateforme de, ou l'innovation et satisfaction client sont au rendez-vous.
                                        Chaque produit que nous proposons est le reflet de leur savoir-faire, leur créativité et leur passion.
                                        Ensemble, nous donnons vie à des solutions adaptées à vos besoins, pour une expérience d'achat incomparable.

                                        <br>
                                        <br>

                                        À nos partenaires, nous disons <strong>un grand merci</strong>. Vous êtes au cœur de notre aventure,
                                        et nous sommes honorés de partager avec vous cette vision d'excellence et de progrès.

                                        <br>
                                        <br>

                                        Votre soutien inspire tout ce que nous faisons, et ensemble, nous continuerons à surpasser les attentes,
                                        à innover et à écrire une histoire commune qui témoigne de la puissance de l'unité.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination Start --
                    <div class="gi-pro-pagination">
                        <span>Showing 1-6 of 20 items</span>
                        <ul class="gi-pro-pagination-inner">
                            <li><a class="active" href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><span>...</span></li>
                            <li><a href="#">8</a></li>
                            <li><a class="next" href="#">Next <i class="gicon gi-angle-right"></i></a></li>
                        </ul>
                    </div>
                    !-- Pagination End -->

                    <!-- Comments Start -->
                    <div class="gi-blog-comments m-t-80">
                        <div class="gi-blog-cmt-preview">
                            <div class="gi-blog-comment-wrapper">
                                <h4 class="gi-blog-dgi-title">Nos Vendeurs</h4>
                                <div class="gi-single-comment-wrapper mt-35">
                                    <div class="gi-blog-user-img">
                                        <img src="{{ asset("principale/assets/img/user/1.jpg") }}" alt="blog image">
                                    </div>
                                    <div class="gi-blog-comment-content">
                                        <h5>
                                            Melagne Meliane Marie Ariane
                                        </h5>
                                        <span class="service-color">
                                            06 mois d'expèriance à Ravmel Informatique
                                        </span>
                                        <p class="service-color">
                                            Depuis son arrivée il y a six (06) mois,
                                            Melagne Meliane Marie Ariane s'est imposée comme une pièce maîtresse de notre équipe.
                                            Malgré son expérience encore récente,
                                            elle fait preuve d'un talent exceptionnel pour accompagner et conseiller nos clientes et clients.
                                            Toujours à l'écoute,
                                            elle réussit à transformer chaque interaction en une expérience positive et mémorable pour les acheteurs.
                                            Sa capacité à gérer les situations avec calme et efficacité est admirable,
                                            et il est évident qu'elle possède une aptitude naturelle pour le commerce.
                                            Grâce à son attitude proactive,
                                            elle a déjà contribué de manière significative à la satisfaction de la clientèle et au développement de notre site.
                                            Nous sommes fiers de l'avoir dans notre équipe et convaincus qu'elle continuera à briller dans son rôle.
                                        </p>
                                        <div class="gi-blog-details-btn">
                                            <a href="javascript:void(0)">Voir les avis</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="gi-single-comment-wrapper sub-cmt">
                                    <div class="gi-blog-user-img">
                                        <img src="{{ asset("principale/assets/img/user/2.jpg") }}" alt="blog image">
                                    </div>
                                    <div class="gi-blog-comment-content">
                                        <h5>
                                            Achi Rodrigue
                                        </h5>
                                        <span class="service-color">
                                            01 an d'expèreriance à ravmel Informatique
                                        </span>
                                        <p class="service-color">
                                            En seulement un (01) an ,
                                            Achie Rodrigue a su démontrer une expertise et un engagement remarquables.
                                            Avec une expérience désormais bien ancrée,
                                            il maîtrise l'art de conseiller et d'accompagner nos clients avec professionnalisme et empathie.
                                            Sa capacité à comprendre les besoins spécifiques de chaque client,
                                            combinée à son dynamisme, en fait un acteur clé de notre équipe.
                                            Toujours proactif,
                                            il n'hésite pas à partager ses idées pour améliorer les processus et optimiser l'expérience client.
                                            Grâce à son travail acharné et à son attitude positive,
                                            il a contribué à fidéliser notre clientèle tout en renforçant l'image de notre site.
                                            Nous sommes convaincus qu'il continuera à exceller et à inspirer autour de lui.
                                        </p>
                                        <div class="gi-blog-details-btn">
                                            <a href="javascript:void(0)">Voir les avis</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gi-blog-cmt-form">
                            <div class="gi-blog-reply-wrapper mt-50">
                                <h4 class="gi-blog-dgi-title">Laisser un commentaire</h4>
                                
                                <form action="{{ route('message.store') }}" method="POST" class="gi-blog-form mb-5">
                                @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="gi-leave-form">
                                                <!-- <label for="nom_prenom">Nom et Prenom *</label> -->
                                                <input type="text" name="nom_prenom" placeholder="Entrez votre nom et prenom" value="{{ old('nom_prenom') }}" required>
                                                @error('nom') <span class="text-danger mt-0">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">  
                                            <div class="gi-leave-form">
                                                <!-- <label for="password-contact">Contact *</label> -->
                                                <input type="number" name="contact" placeholder="Entrez votre numero" value="{{ old('contact') }}" required>
                                                @error('contact') <span class="text-danger mt-0">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="gi-leave-form">
                                                <!-- <label for="subject-contact">Email</label> -->
                                                <input type="email" name="email" placeholder="Entrez votre email" value="{{ old('email') }}" required>
                                                @error('email') <span class="text-danger mt-0">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="gi-leave-form">
                                                <!-- <label for="nom_prenom">Objet *</label> -->
                                                <input type="text" name="objet" placeholder="Entrez l'objet de votre message" value="{{ old('objet') }}" required>
                                                @error('objet') <span class="text-danger mt-0">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="gi-text-leave">
                                                <!-- <label for="comment-contact">Message *</label> -->
                                                <textarea name="message" value="{{ old('message') }}" required></textarea>
                                                @error('message') <span class="text-danger mt-0">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="gi-btn-2">Envoyer le message</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Comments End -->
                </div>
                <!--Blog content End -->
            </div>

            <!-- Sidebar Area Start -->
            <div class="gi-blogs-sidebar gi-blogs-leftside col-lg-4 order-lg-first col-md-12 order-md-last m-t-991">
                <div class="gi-blog-search">
                    <form class="gi-blog-search-form" action="#">
                        <input class="form-control" placeholder="Rechercher un article" type="text">
                        <button class="submit" type="submit"><i class="gicon gi-search"></i></button>
                    </form>
                </div>
                <div class="gi-blog-sidebar-wrap">
                    <!-- Sidebar Recent Blog Block -->
                    <div class="gi-sidebar-block gi-sidebar-recent-blog">
                        <div class="gi-sb-title">
                            <h3 class="gi-sidebar-title">Nos services</h3>
                        </div>

                        <div class="gi-blog-block-content gi-sidebar-dropdown">
                            <div class="gi-sidebar-block-item">
                                <div class="gi-sidebar-block-img">
                                    <img src="{{ asset("principale/assets/img/perso/60.png") }}" alt="livraison">
                                </div>
                                <div class="gi-sidebar-block-detial">
                                    <h5 class="gi-blog-title"><a href="blog-detail-left-sidebar.html">Livraison rapide et sécurisée.</a></h5>
                                    <div class="gi-blog-date service-color">
                                        Recevez vos articles où vous voulez,
                                        <br>
                                        quand vous voulez.
                                        <br>
                                        - Livraison standard;
                                        <br>
                                        - Livraison express;
                                        <br>
                                        - Point relais.
                                        <br>
                                        Vous choisissez ce qui vous arrange.
                                    </div>
                                    <a href="#">- + -</a>
                                </div>
                            </div>

                            <div class="gi-sidebar-block-item">
                                <div class="gi-sidebar-block-img">
                                    <img src="{{ asset("principale/assets/img/perso/50.jpg") }}" alt="Support client">
                                </div>
                                <div class="gi-sidebar-block-detial">
                                    <h5 class="gi-blog-title"><a href="blog-detail-left-sidebar.html">Support client à votre écoute:</a></h5>
                                    <div class="gi-blog-date service-color">
                                        - Une question ?
                                        <br>
                                        - Un souci ?
                                        <br>
                                        Notre équipe est disponible par téléphone ou mail pour vous aider avec efficacité et réactivité.
                                    </div>
                                    <a href="#">- + -</a>
                                </div>
                            </div>

                            <div class="gi-sidebar-block-item">
                                <div class="gi-sidebar-block-img">
                                    <img src="{{ asset("principale/assets/img/blog/4.jpg") }}" alt="blog imag">
                                </div>
                                <div class="gi-sidebar-block-detial">
                                    <h5 class="gi-blog-title"><a href="blog-detail-left-sidebar.html">Produits variés, services adaptés</a></h5>
                                    <div class="gi-blog-date service-color">Quel que soit votre achat:
                                        <br>
                                        – un câble USB;
                                        <br>
                                        - un mug design;
                                        <br>
                                        - une lampe de salon;
                                        <br>
                                        - etc.
                                        <br>
                                        Nos services s’adaptent à vos besoins.
                                    </div>
                                    <a href="#">- + -</a>
                                </div>
                            </div>

                            <div class="gi-sidebar-block-item">
                                <div class="gi-sidebar-block-img">
                                    <img src="{{ asset("principale/assets/img/blog/3.jpg") }}" alt="blog imag">
                                </div>
                                <div class="gi-sidebar-block-detial">
                                    <h5 class="gi-blog-title"><a href="blog-detail-left-sidebar.html">Programme et fidélité.</a></h5>
                                    <div class="gi-blog-date service-color">
                                        Rejoignez notre communauté dès maintenant et accédez à des offres exclusives :
                                        <br>
                                        - Promotions imbattables;
                                        <br>
                                        - Ventes privées réservées et un programme de fidélité conçu spécialement pour vous remercier de votre confiance.
                                        <br>
                                        Profiter!
                                    </div>
                                    <a href="#">- + -</a>
                                </div>
                            </div>

                            <div class="gi-sidebar-block-item">
                                <div class="gi-sidebar-block-img">
                                    <img src="{{ asset("principale/assets/img/blog/2.jpg") }}" alt="blog imag">
                                </div>
                                <div class="gi-sidebar-block-detial">
                                    <h5 class="gi-blog-title"><a href="blog-detail-left-sidebar.html">Paiements sécurisés.</a></h5>
                                    <div class="gi-blog-date service-color">Toutes vos transactions sont protégées grâce aux dernières technologies de sécurité. Achetez l’esprit tranquille.</div>
                                    <a href="#">- + -</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Recent Blog Block -->
                    <!-- Sidebar Category Block -->
                    <div class="gi-sidebar-block">
                        <div class="gi-sb-title">
                            <h3 class="gi-sidebar-title">Categories</h3>
                        </div>
                        <div class="gi-blog-block-content gi-sidebar-dropdown">
                            <ul>

                                @if(categories()->count() > 0)   
                                    @php $n = 1; @endphp

                                    @foreach(categories() as $categorie)   
                                        @if($categorie->souscategories->count() > 0 && CategScateg($categorie) > 0)
                                            <li>
                                                <div class="gi-sidebar-block-item">
                                                    <!-- <input type="checkbox">  -->
                                                    <a href="{{ route('categorie.produit', $categorie) }}" class="p-0 service-color">
                                                        {{ $categorie->nom }}<span title="Products" style="color: #ff4500;">+ {{ $categorie->souscategories->count() }}</span>
                                                    </a>
                                                    <!-- <span class="checked"></span> -->
                                                </div>
                                            </li>
                                                    
                                            @php $n++; @endphp
                                        @endif
                                    @endforeach
                                @else
                                    <li>
                                        <div class="gi-sidebar-block-item">
                                            <!-- <input type="checkbox" checked>  -->
                                            <a href="javascript:void(0)" class="p-0 service-color">
                                                Désolé! Aucune categorie disponible<span title="Products">- 68</span>
                                            </a>
                                            <!-- <span class="checked"></span> -->
                                        </div>
                                    </li>
                                @endif

                                <!-- <li>
                                    <div class="gi-sidebar-block-item">
                                        <input type="checkbox" checked> <a href="javascript:void(0)">Dairy &
                                            Milk<span title="Products">- 68</span></a><span class="checked"></span>
                                    </div>
                                </li>

                                <li>
                                    <div class="gi-sidebar-block-item">
                                        <input type="checkbox"> <a href="javascript:void(0)">Seafood<span
                                                title="Products">- 58</span></a><span class="checked"></span>
                                    </div>
                                </li>

                                <li>
                                    <div class="gi-sidebar-block-item">
                                        <input type="checkbox"> <a href="javascript:void(0)">Bakery<span
                                                title="Products">- 84</span></a><span class="checked"></span>
                                    </div>
                                </li>

                                <li>
                                    <div class="gi-sidebar-block-item">
                                        <input type="checkbox"> <a href="javascript:void(0)">cosmetics<span
                                                title="Products">- 63</span></a><span class="checked"></span>
                                    </div>
                                </li>

                                <li>
                                    <div class="gi-sidebar-block-item">
                                        <input type="checkbox"> <a href="javascript:void(0)">electrics<span
                                                title="Products">- 75</span></a><span class="checked"></span>
                                    </div>
                                </li>

                                <li>
                                    <div class="gi-sidebar-block-item">
                                        <input type="checkbox"> <a href="javascript:void(0)">phones<span
                                                title="Products">- 26</span></a><span class="checked"></span>
                                    </div>
                                </li>

                                <li>
                                    <div class="gi-sidebar-block-item">
                                        <input type="checkbox"> <a href="javascript:void(0)">Clothes<span
                                                title="Products">- 39</span></a><span class="checked"></span>
                                    </div>
                                </li>

                                <li>
                                    <div class="gi-sidebar-block-item">
                                        <input type="checkbox"> <a href="javascript:void(0)">Watch<span
                                                title="Products">- 48</span></a><span class="checked"></span>
                                    </div>
                                </li> -->

                            </ul>
                        </div>
                    </div>
                    <!-- Sidebar Category Block -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog section End -->



@endsection