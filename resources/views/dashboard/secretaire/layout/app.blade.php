@include('dashboard.include.appTop')

    @include('dashboard.secretaire.layout.utils.nav')
        @yield('body')
    @include('dashboard.secretaire.layout.utils.footer')

@include('dashboard.include.appBottom')