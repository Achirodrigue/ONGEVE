@include('dashboard.include.appTop')

    @include('dashboard.commercial.layout.utils.nav')
        @yield('body')
    @include('dashboard.commercial.layout.utils.footer')

@include('dashboard.include.appBottom')