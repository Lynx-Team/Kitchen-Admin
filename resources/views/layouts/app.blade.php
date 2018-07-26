@extends('layouts.base')

@section('content')
    <div class="app header-fixed sidebar-show">
        <header class="app-header navbar">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item px-3">
                    <a class="nav-link" href="{{ route('home') }}">{{ __('header.home') }}</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link" href="{{ route('logout') }}">{{ __('header.logout') }}</a>
                </li>
            </ul>
        </header>
        <div class="app-body">
            <div class="sidebar">
                @if(Auth::user()->is_admin)
                    @include('partials.admin_sidebar')
                @elseif(Auth::user()->is_kitchen)
                    @include('partials.kitchen_sidebar')
                @elseif(Auth::user()->is_manager)
                    @include('partials.manager_sidebar')
                @endif
            </div>
            <main class="main">
                <div class="container pt-2">
                    @yield('main')
                </div>
            </main>
        </div>
    </div>
@endsection
