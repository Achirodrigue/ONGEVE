@include('dashboard.include.appTop')

    @include('dashboard.ressource.layout.utils.nav')
        @yield('body')
    @include('dashboard.ressource.layout.utils.footer')

@include('dashboard.include.appBottom')