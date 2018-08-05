<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-title">{{ config('app.name') }}</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('kitchens.view') }}">{{ __('sidebar.kitchens_view') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('suppliers_view.view') }}">{{ __('sidebar.suppliers_view') }}</a>
        </li>
    </ul>
</nav>