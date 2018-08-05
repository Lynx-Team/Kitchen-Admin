<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-title">{{ config('app.name') }}</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('kitchen.view', ['kitchen_id' => Auth::user()->id]) }}">
                {{ __('sidebar.order_lists') }}
            </a>
        </li>
    </ul>
</nav>