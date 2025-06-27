<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from techzaa.in/velex/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 04 Feb 2025 10:17:17 GMT -->
<head>
    <!-- Title Meta -->
    <meta charset="utf-8" />
    <title>Site Globale Commerce</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully responsive premium admin dashboard template" />
    <meta name="author" content="Techzaa" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset("principale/assets/img/logo/logo1.jpg") }}">

    <!-- Gridjs Plugin css -->
    <link href="{{ asset("admin/assets/vendor/gridjs/theme/mermaid.min.css") }}" rel="stylesheet" type="text/css" />

    <!-- Vendor css (Require in all Page) -->
    <link href="{{ asset("admin/assets/css/vendor.min.css") }}" rel="stylesheet" type="text/css" />

    <!-- Icons css (Require in all Page) -->
    <link href="{{ asset("admin/assets/css/icons.min.css") }}" rel="stylesheet" type="text/css" />

    <!-- App css (Require in all Page) -->
    <link href="{{ asset("admin/assets/css/app.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("admin/assets/css/perso.css") }}" rel="stylesheet" type="text/css" />

    <!--bleu:#08ceed  orange:orangered Theme Config js (Require in all Page) -->
    <script src="{{ asset("admin/assets/js/config.js") }}"></script>
    

</head>

<body class="vh-100">


    @yield('body')

    <!-- Vendor Javascript (Require in all Page) -->
    <script src="{{ asset("admin/assets/js/vendor.js") }}"></script>

    <!-- App Javascript (Require in all Page) -->
    <script src="{{ asset("admin/assets/js/app.js") }}"></script>


    <!-- Vector Map Js -->
    <script src="{{ asset("admin/assets/vendor/jsvectormap/js/jsvectormap.min.js") }}"></script>
    <script src="{{ asset("admin/assets/vendor/jsvectormap/maps/world-merc.js") }}"></script>
    <script src="{{ asset("admin/assets/vendor/jsvectormap/maps/world.js") }}"></script>

    <!-- Dashboard Js -->
    <script src="{{ asset("admin/assets/js/pages/dashboard.js") }}"></script>
    
    <!-- Page Js -->
    <script src="{{ asset("admin/assets/js/pages/ecommerce-product-details.js") }}"></script>

    <!-- Gridjs Plugin js -->
    <script src="{{ asset("admin/assets/vendor/gridjs/gridjs.umd.js") }}"></script>

    <!-- Gridjs Demo js -->
    <script src="{{ asset("admin/assets/js/components/table-gridjs.js") }}"></script>


    <script type="text/javascript">
        $("document").ready(function()
        {
          setTimeout(function()
          {
            $("div.alert").remove();
          },10000);
        });
    </script>
    <script type="text/javascript">
        $("document").ready(function()
        {
          setTimeout(function()
          {
            $("p.alert").remove();
          },10000);
        });
    </script>

</body>

</html>