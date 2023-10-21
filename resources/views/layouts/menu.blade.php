<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
    <a href="{{ route('events.index') }}" class="nav-link {{ Request::is('events.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>События</p>
    </a>
</li>
