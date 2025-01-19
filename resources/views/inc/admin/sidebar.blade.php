<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand"
                    height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item active">
                    <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <x-admin.subitem href="{{ route('dashboard') }}" label="Dashboard" />
                            <x-admin.subitem href="{{ url('/') }}" label="Go to Home" />
                        </ul>
                    </div>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                @if (auth()->user()->hasRole('admin'))
                    <x-admin.navitem collapseId="routeUserbase" icon="user" title="User">
                        <x-admin.subitem href="{{ route('user.index') }}" label="All user" />
                        <x-admin.subitem href="{{ route('user.indexAdmin') }}" label="Admins" />
                        <x-admin.subitem href="{{ route('user.indexCustomers') }}" label="Customers" />
                        <x-admin.subitem href="{{ route('user.indexSuparAdmin') }}" label="Super Admin" />
                        <x-admin.subitem href="#routeSuppliers" label="Suppliers" />
                    </x-admin.navitem>
                @endif
                <x-admin.navitem collapseId="productscollapse" icon="th-list" title="Products">
                    <x-admin.subitem href="{{ route('products.index') }}" label="Show Products" />
                    <x-admin.subitem href="Low Product" label="Low Product" />
                </x-admin.navitem>
                <x-admin.navitem collapseId="importCollapse" icon="file-import" title="Import Product">
                    <x-admin.subitem href="{{ route('suppliers.index')}}" label="Suppliers" />
                    <x-admin.subitem href="{{ route('ImportsupplyInvoiceCreate')}}" label="Import" />
                    <x-admin.subitem href="{{ route('supplyInvoice.index')}}" label="Invoice" />
                </x-admin.navitem>        
                <x-admin.navitem icon=" icon-settings" title="Setting" color="secondary" badge="4"
                    navlink="setting" />

            </ul>
        </div>
    </div>
</div>
