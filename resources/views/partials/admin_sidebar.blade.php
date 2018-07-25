<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-title">{{ config('app.name') }}</li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon cui-speedometer"></i> Nav item
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon cui-speedometer"></i> With badge
                <span class="badge badge-primary">NEW</span>
            </a>
        </li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon cui-puzzle"></i> Nav dropdown
            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="nav-icon cui-puzzle"></i> Nav dropdown item
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="nav-icon cui-puzzle"></i> Nav dropdown item
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>