<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-title">{{ config('app.name') }}</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('backup.download') }}">
                <i class="fas fa-download"></i>
                {{ __('sidebar.download_backup') }}
            </a>
        </li>
    </ul>
</nav>