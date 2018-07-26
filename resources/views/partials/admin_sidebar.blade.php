<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-title">{{ config('app.name') }}</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.view') }}">{{ __('sidebar.users') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('suppliers.view') }}">{{ __('sidebar.suppliers') }}</a>
        </li>
    </ul>
</nav>