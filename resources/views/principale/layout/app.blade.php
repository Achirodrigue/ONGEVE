<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from maraviyainfotech.com/wrapbootstrap/grabit-html/grabit-html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 04 Feb 2025 10:02:04 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Ravmel Informatique</title>
    <meta name="keywords"
        content="Bootstrap 5.x, ecommerce, farming, food market, grocery market, grocery shop, grocery store, grocery supper market, multi vendor, organic food, supermarket, supermarket grocery">
    <meta name="description" content="Multipurpose eCommerce HTML Template">
    <meta name="author" content="Maraviya Infotech">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- site Favicon -->
    <link rel="icon" href="{{ asset("principale/assets/img/logo/logo.png") }}" sizes="32x32">

    <!-- css Icon Font -->
    <link rel="stylesheet" href="{{ asset("principale/assets/css/vendor/gicons.css") }}">

    <!-- css All Plugins Files -->
    <link rel="stylesheet" href="{{ asset("principale/assets/css/plugins/animate.css") }}">
    <link rel="stylesheet" href="{{ asset("principale/assets/css/plugins/swiper-bundle.min.css") }}">
    <link rel="stylesheet" href="{{ asset("principale/assets/css/plugins/bootstrap.css") }}">
    <link rel="stylesheet" href="{{ asset("principale/assets/css/plugins/bootstrap-select.min.css") }}">
    <link rel="stylesheet" href="{{ asset("principale/assets/css/plugins/owl.carousel.min.css") }}">
    <link rel="stylesheet" href="{{ asset("principale/assets/css/plugins/owl.theme.default.min.css") }}">
    <link rel="stylesheet" href="{{ asset("principale/assets/css/plugins/slick.min.css") }}">
    <link rel="stylesheet" href="{{ asset("principale/assets/css/plugins/nouislider.css") }}">

    <!-- Main Style -->
    <link rel="stylesheet" id="main_style" href="{{ asset("principale/assets/css/demo-1.css") }}">
    <link rel="stylesheet" href="{{ asset("principale/assets/css/responsive.css") }}">
    <link rel="stylesheet" href="{{ asset("principale/assets/css/perso.css") }}">
    <link rel="stylesheet" id="main_style" href="{{ asset("principale/assets/css/styles.css") }}">
    <link rel="stylesheet" id="main_style" href="{{ asset("principale/font-awesome-4.7.0/css/font-awesome.css") }}">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">
<!--     
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    
    <!--
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css"/> -->
    
        <style>
    /* Style pour cacher les flèches par défaut */
    .carousel-control-prev,
    .carousel-control-next {
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    /* Quand la souris est sur le carousel, montrer les flèches */
    .gi-pro-image-outer:hover .carousel-control-prev,
    .gi-pro-image-outer:hover .carousel-control-next {
        opacity: 1;
    }
</style>

</head>

<body class="background">

    @include('principale.layout.utils.nav')
        @yield('body')
    @include('principale.layout.utils.footer')

    <script>
        const toastTrigger = document.getElementById('liveToastBtn')
        const toastLiveExample = document.getElementById('liveToast')
        if (toastTrigger) {
          toastTrigger.addEventListener('click', () => {
            const toast = new bootstrap.Toast(toastLiveExample)

            toast.show()
          })
        }
    </script>

    <!-- Plugins JS -->
    <script src="{{ asset("principale/assets/js/plugins/jquery-3.5.1.min.js") }}"></script>
    <script src="{{ asset("principale/assets/js/plugins/popper.min.js") }}"></script>
    <script src="{{ asset("principale/assets/js/plugins/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ asset("principale/assets/js/plugins/bootstrap-select.min.js") }}"></script>
    <script src="{{ asset("principale/assets/js/plugins/swiper-bundle.min.js") }}"></script>
    <script src="{{ asset("principale/assets/js/plugins/fontawesome.js") }}"></script>
    <script src="{{ asset("principale/assets/js/plugins/owl.carousel.min.js") }}"></script>
    <script src="{{ asset("principale/assets/js/plugins/countdownTimer.js") }}"></script>
    <script src="{{ asset("principale/assets/js/plugins/infiniteslidev2.js") }}"></script>
    <script src="{{ asset("principale/assets/js/plugins/jquery.zoom.min.js") }}"></script>
    <script src="{{ asset("principale/assets/js/plugins/slick.min.js") }}"></script>
    <script src="{{ asset("principale/assets/js/plugins/nouislider.js") }}"></script>
    <script src="{{ asset("principale/assets/js/plugins/wow.js") }}"></script>
    <script src="{{ asset("principale/assets/js/plugins/smoothscroll.min.js") }}"></script>

    <!-- Main Js -->
    <script src="{{ asset("principale/assets/js/main.js") }}"></script>
    <script src="{{ asset("principale/assets/js/demo-1.js") }}"></script>
    <script src="{{ asset("principale/assets/js/calcul.js") }}"></script>
    <script src="{{ asset("principale/assets/js/navbar.js") }}"></script>
    <script src="{{ asset("principale/assets/js/perso.js") }}"></script>

    <script type="text/javascript">
        $("document").ready(function()
        {
          setTimeout(function()
          {
            $("div.alert-simple").remove();
          },5000);
        });
    </script>

    <script type="text/javascript">
        $("document").ready(function()
        {
          setTimeout(function()
          {
            $("div.alert-errorP").remove();
          },60000);
        });
    </script>

    <script type="text/javascript">
        $("document").ready(function()
        {
        setTimeout(function()
        {
            $("div.alert-Mfacture").remove();
        },50000);
        });
    </script> 

    <script type="text/javascript">
        $("document").ready(function()
        {
          setTimeout(function()
          {
            $("p.alert").remove();
          },3000);
        });
    </script>

    <!-- <script>
        document.addEventListener("DOMContentLoaded", function () {
            const radios = document.querySelectorAll('input[name="frais_livraison"]');
            const select = document.getElementById("tester");
            const panier = $panier; // récupéré depuis Laravel

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
    </script> -->

    <!-- -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script>
            $(document).ready(function(){
                $(".gi-category-block").owlCarousel({
                    loop: true,              // Fait défiler en boucle
                    margin: 10,              // Espacement entre les éléments
                    nav: true,               // Affiche les boutons de navigation
                    autoplay: true,          // Active le défilement automatique
                    autoplayTimeout: 3000,   // Temps d'attente entre chaque slide (en ms)
                    autoplayHoverPause: true, // Pause au survol
                    responsive: {
                        0: { items: 1 },    
                        600: { items: 2 },  
                        1000: { items: 6 }   
                    }
                });
            });
        </script>  -->
    
    <!-- -->
        <!-- <script>
            $(document).ready(function(){
                $('.deal-slick-carousel').slick({
                    autoplay: true,         // Active le défilement automatique
                    autoplaySpeed: 2000,    // Temps d'affichage de chaque produit (3 secondes)
                    speed: 800,             // Vitesse de transition
                    slidesToShow: 5,        // Nombre de produits visibles
                    slidesToScroll: 1,      // Nombre de produits défilés à chaque transition
                    infinite: true,         // Boucle infinie
                    dots: true,             // Afficher les indicateurs de navigation
                    arrows: false           // Cacher les flèches de navigation (facultatif)
                });
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>
     -->

</body>
</html>
