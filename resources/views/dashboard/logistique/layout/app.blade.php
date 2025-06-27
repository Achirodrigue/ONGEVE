@include('dashboard.include.appTop')

    @include('dashboard.logistique.layout.utils.nav')
        @yield('body')
    @include('dashboard.logistique.layout.utils.footer')

@include('dashboard.include.appBottom')