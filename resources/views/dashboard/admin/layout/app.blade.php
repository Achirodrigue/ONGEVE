@include('dashboard.include.appTop')

    @include('dashboard.admin.layout.utils.nav')
        @yield('body')
    @include('dashboard.admin.layout.utils.footer')

@include('dashboard.include.appBottom')