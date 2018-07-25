<div class="app sidebar-show">
    <div class="app-body">
        <div class="sidebar">
            @include('partials.admin_sidebar')
        </div>
        <main class="main">
            @section('content')
                @yield('main')
            @endsection
        </main>
    </div>
</div>
