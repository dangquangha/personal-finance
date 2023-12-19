<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('images/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                {{-- <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index2.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v3</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" data-menu="dashboard">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('wallets') }}" class="nav-link {{ Request::is('wallets*') ? 'active' : '' }}" data-menu="wallets">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>
                            Wallets
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('packages') }}" class="nav-link {{ Request::is('packages*') ? 'active' : '' }}" data-menu="packages">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            Packages
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('transactions') }}" class="nav-link {{ Request::is('transactions*') ? 'active' : '' }}" data-menu="transactions">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>
                            Transactions
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('budgets') }}" class="nav-link {{ Request::is('budgets*') ? 'active' : '' }}" data-menu="transactions">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Budgets
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
