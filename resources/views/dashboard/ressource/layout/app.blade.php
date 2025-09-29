@include('dashboard.include.appTop')

    @include('dashboard.ressource.layout.utils.nav')
        @yield('body')
    @include('dashboard.ressource.layout.utils.footer')

    <!-- RH -->
        <!-- presence -->
        <!-- end presence -->
    <!-- End RH -->

@include('dashboard.include.appBottom')