@include('dashboard.include.appTop')

    @include('dashboard.packauto.layout.utils.nav')
        @yield('body')
    @include('dashboard.packauto.layout.utils.footer')

@include('dashboard.include.appBottom')