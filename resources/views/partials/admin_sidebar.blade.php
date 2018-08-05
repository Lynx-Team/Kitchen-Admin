<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-title">{{ config('app.name') }}</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.view') }}">{{ __('sidebar.users') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('kitchens.view') }}">{{ __('sidebar.kitchens_view') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('suppliers_view.view') }}">{{ __('sidebar.suppliers_view') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('suppliers.view') }}">{{ __('sidebar.suppliers') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('item_categories.view') }}">{{ __('sidebar.item_categories') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('items.view') }}">{{ __('sidebar.items') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('order_lists.view') }}">{{ __('sidebar.order_lists') }}</a>
        </li>
    </ul>
</nav>