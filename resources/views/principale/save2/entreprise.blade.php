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
                        <h2 class="gi-breadcrumb-title">A propos de nous</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- gi-breadcrumb-list start -->
                        <ul class="gi-breadcrumb-list">
                            <li class="gi-breadcrumb-item"><a href="index.html">Accueil</a></li>
                            <li class="gi-breadcrumb-item active">Nous concernant</li>
                        </ul>
                        <!-- gi-breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb end -->

<!-- About section -->
<section class="gi-about padding-tb-40 background">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-md-12">
                <div class="gi-about-img">
                    <img src="{{ asset("principale/assets/img/common/about_2.jpg") }}" class="v-img" alt="about">
                    <img src="{{ asset("principale/assets/img/common/about-3_2.png") }}" class="h-img" alt="about">
                    <img src="{{ asset("principale/assets/img/common/about-2_1.png") }}" class="h-img" alt="about">
                </div>
            </div>
            <div class="col-xl-6 col-md-12">
                <div class="gi-about-detail">
                    <div class="section-title">
                        <h2>Qui <span>Sommes nous?</span></h2>
                        <p>
                            RAVMEL Informatique est une entreprise polyvalente qui excelle dans la vente d'une variété d'articles soigneusement sélectionnés pour répondre à tous les besoins.
                        </p>
                    </div>

                    <p>
                    <h6>Nous nous distinguons par une offre variée et complète, conçue pour répondre à tous vos besoins :</h6>
                    <ul>
                        <li>
                            * Vente d’articles divers : Explorez une gamme éclectique de produits, allant des objets vintage aux équipements high-tech, en passant par les indispensables du quotidien.
                        </li>
                        <br>
                        <li>
                            * Conseil personnalisé : Appuyez-vous sur notre expertise pour choisir le matériel informatique parfaitement adapté à vos exigences professionnelles ou personnelles.
                        </li>
                        <br>
                        <li>
                            * Vidéosurveillance sur mesure : Garantissez la sécurité de vos espaces avec nos solutions clés en main, incluant la vente, l’installation et la maintenance d’équipements de vidéosurveillance.
                        </li>
                        <br>
                        <li>
                            * Formations spécialisées : Renforcez vos compétences dans des domaines tels que la bureautique, la 3D, le multimédia, ou le développement web. Nos formateurs qualifiés, nos équipements modernes et nos horaires flexibles assurent une expérience d’apprentissage optimale. Certification incluse pour valoriser vos acquis.
                        </li>
                        <br>
                        <li>
                            * Soutien à l’entrepreneuriat : Accompagnez vos projets entrepreneuriaux grâce à nos conseils stratégiques et nos solutions adaptées aux besoins des startups et entreprises en plein essor.
                        </li>
                    </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About section End -->

<!-- Service Section -->
<section class="gi-service-section padding-tb-40 background">
    <div class="container">
        <div class="section-title-2">
            <h2 class="gi-title">Nos <span>Atouts</span></h2>
            <p>Nos atouts, qu'ils soient issus de notre expertise, notre résilience ou nos relations, nous permettent de relever les défis avec assurance. En les valorisant, nous déployons tout notre potentiel pour exceller, nous épanouir et surpasser les attentes.</p>
        </div>

        <div class="row m-tb-minus-12">
            <!-- Livraison -->
            <div class="gi-ser-content gi-ser-content-2 col-sm-6 col-md-6 col-lg-3 p-tp-12" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="200">
                <div class="gi-ser-inner">
                    <!-- Icône -->
                    <div class="gi-service-image">
                        <i class="fi fi-ts-truck-moving"></i>
                    </div>
                    <!-- Texte -->
                    <div class="gi-service-desc">
                        <h3>Livraison</h3>
                        <p>Profitez d’une livraison rapide, sécurisée et adaptée à vos besoins, avec un suivi en temps réel pour une expérience simple et pratique. Nous mettons tout en œuvre pour garantir votre satisfaction à chaque commande.</p>
                    </div>
                </div>
            </div>

            <!-- SAV dynamique -->
            <div class="gi-ser-content gi-ser-content-2 col-sm-6 col-md-6 col-lg-3 p-tp-12" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                <div class="gi-ser-inner">
                    <!-- Icône -->
                    <div class="gi-service-image">
                        <i class="fi fi-ts-hand-holding-seeding"></i>
                    </div>
                    <!-- Texte -->
                    <div class="gi-service-desc">
                        <h3>SAV dynamique</h3>
                        <p>Nous sommes à votre écoute, même après votre achat. Notre service après-vente garantit votre tranquillité d'esprit.</p>
                    </div>
                </div>
            </div>

            <!-- Satisfait ou Remboursé -->
            <div class="gi-ser-content gi-ser-content-3 col-sm-6 col-md-6 col-lg-3 p-tp-12" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="600">
                <div class="gi-ser-inner">
                    <!-- Icône -->
                    <div class="gi-service-image">
                        <i class="fi fi-ts-badge-percent"></i>
                    </div>
                    <!-- Texte -->
                    <div class="gi-service-desc">
                        <h3>Satisfait ou Remboursé</h3>
                        <p>Si pour une raison quelconque votre achat ne répond pas à vos attentes, retournez-le simplement dans un délai de 30 jours pour un échange. Nous sommes là pour garantir votre satisfaction.</p>
                    </div>
                </div>
            </div>

            <!-- Paiement sécurisé -->
            <div class="gi-ser-content gi-ser-content-4 col-sm-6 col-md-6 col-lg-3 p-tp-12" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="800">
                <div class="gi-ser-inner">
                    <!-- Icône -->
                    <div class="gi-service-image">
                        <i class="fi fi-ts-donate"></i>
                    </div>
                    <!-- Texte -->
                    <div class="gi-service-desc">
                        <h3>Paiement sécurisé</h3>
                        <p>Achetez en toute tranquillité ! Grâce à notre système de paiement entièrement sécurisé, vos informations personnelles et bancaires sont protégées par les technologies les plus avancées. Notre priorité est de garantir la confidentialité de vos transactions pour une expérience d'achat sans souci.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Service Section End -->

<!-- Testimonials Section -->
<!-- <section class="gi-testimonials-section padding-tb-40 background">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="testim-bg p-tb-80">
                    <div class="section-title d-none">
                        <h2>Customers <span>Review</span></h2>
                    </div>
                    <span class="gi-testi-shape-1"></span>
                    <div class="gi-test-outer gi-test-section">
                        <ul id="gi-testimonial-slider" class="owl-carousel">
                            <li class="gi-test-item">
                                <img src="assets/img/icons/top-quotes.svg" class="svg_img test_svg top" alt="user">
                                <div class="gi-test-inner">
                                    <div class="gi-test-img">
                                        <img alt="testimonial" title="testimonial" src="assets/img/user/1.jpg">
                                    </div>
                                    <div class="gi-test-content">
                                        <div class="gi-test-desc">Lorem Ipsum is simply dummy text of the printing
                                            and
                                            typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                            text
                                            ever since the 1500s.</div>
                                        <div class="gi-test-name">Mariya Klinton</div>
                                        <div class="gi-test-designation">CEO</div>
                                        <div class="gi-test-rating">
                                            <i class="gicon gi-star fill"></i>
                                            <i class="gicon gi-star fill"></i>
                                            <i class="gicon gi-star fill"></i>
                                            <i class="gicon gi-star fill"></i>
                                            <i class="gicon gi-star fill"></i>
                                        </div>
                                    </div>
                                </div>
                                <img src="assets/img/icons/bottom-quotes.svg" class="svg_img test_svg bottom"
                                    alt="">
                            </li>
                            <li class="gi-test-item ">
                                <img src="assets/img/icons/top-quotes.svg" class="svg_img test_svg top" alt="">
                                <div class="gi-test-inner">
                                    <div class="gi-test-img">
                                        <img alt="testimonial" title="testimonial" src="assets/img/user/2.jpg">
                                    </div>
                                    <div class="gi-test-content">
                                        <div class="gi-test-desc">standard dummy text
                                            ever since the 1500s, when an unknown printer took a galley of type and
                                            scrambled it to make a type specimen</div>
                                        <div class="gi-test-name">John Doe</div>
                                        <div class="gi-test-designation">General Manager</div>
                                        <div class="gi-test-rating">
                                            <i class="gicon gi-star fill"></i>
                                            <i class="gicon gi-star fill"></i>
                                            <i class="gicon gi-star fill"></i>
                                            <i class="gicon gi-star fill"></i>
                                            <i class="gicon gi-star fill"></i>
                                        </div>
                                    </div>
                                </div>
                                <img src="assets/img/icons/bottom-quotes.svg" class="svg_img test_svg bottom"
                                    alt="">
                            </li>
                            <li class="gi-test-item">
                                <img src="assets/img/icons/top-quotes.svg" class="svg_img test_svg top" alt="">
                                <div class="gi-test-inner">
                                    <div class="gi-test-img">
                                        <img alt="testimonial" title="testimonial" src="assets/img/user/3.jpg">
                                    </div>
                                    <div class="gi-test-content">
                                        <div class="gi-test-desc">when an unknown printer took a galley of type and
                                            scrambled it to make a type specimenLorem Ipsum has been the industry's
                                            ever since the 1500s, </div>
                                        <div class="gi-test-name">Nency Lykra</div>
                                        <div class="gi-test-designation">Marketing Manager</div>
                                        <div class="gi-test-rating">
                                            <i class="gicon gi-star fill"></i>
                                            <i class="gicon gi-star fill"></i>
                                            <i class="gicon gi-star fill"></i>
                                            <i class="gicon gi-star fill"></i>
                                            <i class="gicon gi-star fill"></i>
                                        </div>
                                    </div>
                                </div>
                                <img src="assets/img/icons/bottom-quotes.svg" class="svg_img test_svg bottom"
                                    alt="">
                            </li>
                        </ul>
                    </div>
                    <span class="gi-testi-shape-2"></span>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- Testimonials Section End -->

<!-- Facts Section -->
<!-- <section class="gi-facts-section padding-tb-40 background">
    <div class="container">
        <div class="row m-tb-minus-12">
            <div class="gi-facts-content col-sm-12 col-md-6 col-lg-3 p-tp-12">
                <div class="gi-facts-inner">
                    <div class="gi-count">
                        <span class="counter">65K+</span>
                    </div>
                    <div class="gi-facts-desc">
                        <h4>Vendors</h4>
                        <p>Contrary to popular belief, Lorem is not simply random text.</p>
                    </div>
                </div>
            </div>
            <div class="gi-facts-content col-sm-12 col-md-6 col-lg-3 p-tp-12">
                <div class="gi-facts-inner">
                    <div class="gi-count">
                        <span class="counter">$45B+</span>
                    </div>
                    <div class="gi-facts-desc">
                        <h4>Earnings</h4>
                        <p>Contrary to popular belief, Lorem is not simply random text.</p>
                    </div>
                </div>
            </div>
            <div class="gi-facts-content col-sm-12 col-md-6 col-lg-3 p-tp-12">
                <div class="gi-facts-inner">
                    <div class="gi-count">
                        <span class="counter">25M+</span>
                    </div>
                    <div class="gi-facts-desc">
                        <h4>Sold</h4>
                        <p>Contrary to popular belief, Lorem is not simply random text.</p>
                    </div>
                </div>
            </div>
            <div class="gi-facts-content col-sm-12 col-md-6 col-lg-3 p-tp-12">
                <div class="gi-facts-inner">
                    <div class="gi-count">
                        <span class="counter">70K+</span>
                    </div>
                    <div class="gi-facts-desc">
                        <h4>Products</h4>
                        <p>Contrary to popular belief, Lorem is not simply random text.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- Facts Section End -->

<!-- Team Section -->
<section class="gi-team-section padding-tb-40 background">
    <div class="container">
        <div class="section-title-2">
            <h2 class="gi-title">Notre <span>équipe</span></h2>
            <p>Rencontrez les membres de notre équipe d'experts.</p>
        </div>
        <div class="gi-team owl-carousel">
            @foreach($equipes as $equipe)
            <div class="gi-team-box">
                <div class="gi-team-imag">
                    <img src="{{ asset(Storage::url($equipe->photo)) }}" alt="user">
                    <div class="gi-team-socials">
                        <ul class="align-itegi-center">
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-twitter" aria-hidden="true"></i></a>
                            </li>
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-facebook" aria-hidden="true"></i></a>
                            </li>
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-linkedin" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="gi-team-info">
                    <h5 class="text-white">{{ $equipe->nom }} {{ $equipe->prenom }}</h5>
                    <p class="text-warning">{{ $equipe->contact }}</p>
                </div>
            </div>
            @endforeach
            <!-- <div class="gi-team-box">
                <div class="gi-team-imag">
                    <img src="assets/img/user/2.jpg" alt="user">
                    <div class="gi-team-socials">
                        <ul class="align-itegi-center">
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-twitter" aria-hidden="true"></i></a>
                            </li>
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-facebook" aria-hidden="true"></i></a>
                            </li>
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-linkedin" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="gi-team-info">
                    <h5>William Dalin</h5>
                    <p>Co-Founder</p>
                </div>
            </div>
            <div class="gi-team-box">
                <div class="gi-team-imag">
                    <img src="assets/img/user/3.jpg" alt="user">
                    <div class="gi-team-socials">
                        <ul class="align-itegi-center">
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-twitter" aria-hidden="true"></i></a>
                            </li>
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-facebook" aria-hidden="true"></i></a>
                            </li>
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-linkedin" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="gi-team-info">
                    <h5>Emma Welson</h5>
                    <p>Manager</p>
                </div>
            </div>
            <div class="gi-team-box">
                <div class="gi-team-imag">
                    <img src="assets/img/user/4.jpg" alt="user">
                    <div class="gi-team-socials">
                        <ul class="align-itegi-center">
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-twitter" aria-hidden="true"></i></a>
                            </li>
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-facebook" aria-hidden="true"></i></a>
                            </li>
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-linkedin" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="gi-team-info">
                    <h5>Benjamin Martin</h5>
                    <p>Leader</p>
                </div>
            </div>
            <div class="gi-team-box">
                <div class="gi-team-imag">
                    <img src="assets/img/user/5.jpg" alt="user">
                    <div class="gi-team-socials">
                        <ul class="align-itegi-center">
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-twitter" aria-hidden="true"></i></a>
                            </li>
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-facebook" aria-hidden="true"></i></a>
                            </li>
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-linkedin" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="gi-team-info">
                    <h5>Amelia Martin</h5>
                    <p>Leader</p>
                </div>
            </div> -->
        </div>
    </div>
</section>
<!-- Facts Section End -->


<!-- Team Section -->
<!-- <section class="gi-team-section padding-tb-40 background">
    <div class="container">
        <div class="section-title-2">
            <h2 class="gi-title">Notre <span>équipe</span></h2>
            <p>Rencontrez membres de notre équipe d'experts.</p>
        </div>
        <div class="gi-team owl-carousel">
            @foreach(produit() as $produit)
                <div class="gi-team-box">
                    <div class="gi-team-imag">
                        <img src="{{ asset(Storage::url($produit->image)) }}" alt="user">
                        <div class="gi-team-socials">
                            <ul class="align-itegi-center">
                                <li class="gi-social-link">
                                    <a href="#"><i class="gicon gi-twitter" aria-hidden="true"></i></a>
                                </li>
                                <li class="gi-social-link">
                                    <a href="#"><i class="gicon gi-facebook" aria-hidden="true"></i></a>
                                </li>
                                <li class="gi-social-link">
                                    <a href="#"><i class="gicon gi-linkedin" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="gi-team-info">
                        <h5>{{ $produit->nom }}</h5>
                        <p>{{ $produit->description }}</p>
                    </div>
                </div>
            @endforeach
            <div class="gi-team-box">
                <div class="gi-team-imag">
                    <img src="assets/img/user/2.jpg" alt="user">
                    <div class="gi-team-socials">
                        <ul class="align-itegi-center">
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-twitter" aria-hidden="true"></i></a>
                            </li>
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-facebook" aria-hidden="true"></i></a>
                            </li>
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-linkedin" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="gi-team-info">
                    <h5>William Dalin</h5>
                    <p>Co-Founder</p>
                </div>
            </div>
            <div class="gi-team-box">
                <div class="gi-team-imag">
                    <img src="assets/img/user/3.jpg" alt="user">
                    <div class="gi-team-socials">
                        <ul class="align-itegi-center">
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-twitter" aria-hidden="true"></i></a>
                            </li>
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-facebook" aria-hidden="true"></i></a>
                            </li>
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-linkedin" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="gi-team-info">
                    <h5>Emma Welson</h5>
                    <p>Manager</p>
                </div>
            </div>
            <div class="gi-team-box">
                <div class="gi-team-imag">
                    <img src="assets/img/user/4.jpg" alt="user">
                    <div class="gi-team-socials">
                        <ul class="align-itegi-center">
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-twitter" aria-hidden="true"></i></a>
                            </li>
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-facebook" aria-hidden="true"></i></a>
                            </li>
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-linkedin" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="gi-team-info">
                    <h5>Benjamin Martin</h5>
                    <p>Leader</p>
                </div>
            </div>
            <div class="gi-team-box">
                <div class="gi-team-imag">
                    <img src="assets/img/user/5.jpg" alt="user">
                    <div class="gi-team-socials">
                        <ul class="align-itegi-center">
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-twitter" aria-hidden="true"></i></a>
                            </li>
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-facebook" aria-hidden="true"></i></a>
                            </li>
                            <li class="gi-social-link">
                                <a href="#"><i class="gicon gi-linkedin" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="gi-team-info">
                    <h5>Amelia Martin</h5>
                    <p>Leader</p>
                </div>
            </div> 
        </div>
    </div>
</section>-->
<!-- Facts Section End -->



@endsection