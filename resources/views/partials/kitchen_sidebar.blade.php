<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-title">{{ config('app.name') }}</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('view_order_lists.view', ['kitchen_id' => Auth::user()->id]) }}">
                {{ __('sidebar.order_lists') }}
            </a>
        </li>
    </ul>
</nav>