@extends('layouts.base')

@section('content')
    <div class="app sidebar-show">
        <div class="app-body">
            <div class="sidebar">
                @include('partials.admin_sidebar')
            </div>
            <main class="main">
                <div class="container pt-2">
                    @yield('main')
                </div>
            </main>
        </div>
    </div>
@endsection
