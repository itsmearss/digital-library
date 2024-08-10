<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">PERPUSTAKAAN DIGITAL</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">PD</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            {{-- <li class="nav-item dropdown {{ $type_menu === 'dashboard' ? 'active' : '' }}"> --}}
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('home') ? 'active' : '' }}'>
                        <a class="nav-link" 
                            href="{{ route('home') }}">General Dashboard</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
            {{-- <li class="nav-item dropdown {{ $type_menu === 'master' ? 'active' : '' }}"> --}}
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-columns"></i><span>Data Master</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('books') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('books.index') }}">Buku</a>
                    </li>
                    <li class='{{ Request::is('categories') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('categories.index') }}">Kategori</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
