@include('dashboard.include.appTop')

    @include('dashboard.geststock.layout.utils.nav')
        @yield('body')
    @include('dashboard.geststock.layout.utils.footer')

@include('dashboard.include.appBottom')