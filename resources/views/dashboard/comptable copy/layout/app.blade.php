@include('dashboard.include.appTop')

    @include('dashboard.comptable.layout.utils.nav')
        @yield('body')
    @include('dashboard.comptable.layout.utils.footer')

@include('dashboard.include.appBottom')