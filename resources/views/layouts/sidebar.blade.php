<ul id="sidebar_nav" class="nav flex-column nav-pills">
    <li class="nav-item">
        <a class="nav-link rounded-0 py-3" href="{{ route('dashboard') }}">Сводка</a>
    </li>
    <li class="nav-item">
        <a class="nav-link rounded-0 py-3" href="{{ route('cms-applications.index') }}">Приложения (CMS)</a>
    </li>
    <li class="nav-item">
        <a class="nav-link rounded-0 py-3" data-toggle="collapse" href="#marketplaceMenu" role="button" aria-expanded="false">Маркетплейс</a>
        <div id="marketplaceMenu" class="collapse overflow-hidden pl-3">
            <ul class="overflow-hidden nav flex-column nav-pills">
                <li class="nav-item">
                    <a class="nav-link rounded-0 py-3" href="{{ route('cms-plugins.index') }}">Плагины</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-0 py-3" href="{{ route('work-in-progress') }}">Темы</a>
                </li>
            </ul>
        </div>
    </li>
</ul>
