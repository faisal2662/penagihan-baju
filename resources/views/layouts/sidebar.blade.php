<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? '' : ' collapsed' }}" href="/">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link  {{ Request::is('billing') ? '' : ' collapsed' }}" href="/billing">
                <i class="bi bi-clipboard"></i>
                <span>Penagihan</span>
            </a>
        </li><!-- End Profile Page Nav -->


        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link  {{ Request::is('customer') ? '' : ' collapsed' }}" href="/customer">
                <i class="bi bi-file-earmark-person"></i>
                <span>Pelanggan</span>
            </a>
        </li><!-- End Profile Page Nav -->
        @can('isAdmin')
            <li class="nav-item">
                <a class="nav-link  {{ Request::is('down-payment') ? '' : ' collapsed' }}" href="/down-payment">
                    <i class="bi bi-cloud-upload"></i>
                    <span>Setoran</span>
                </a>
            </li><!-- End Profile Page Nav -->


            <li class="nav-item">
                <a class="nav-link @if (request()->route()->uri == 'price-list' ||
                        request()->route()->uri == 'color' ||
                        request()->route()->uri == 'category' ||
                        request()->route()->uri == 'session') ''
                @else 
                collapsed @endif"
                    data-bs-target="#masters-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Data Master</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="masters-nav" class="nav-content collapse @if (request()->route()->uri == 'price-list' ||
                        request()->route()->uri == 'color' ||
                        request()->route()->uri == 'category' ||
                        request()->route()->uri == 'session') show @endif"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/price-list" class="{{ Request::is('price-list') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Daftar Harga</span>
                        </a>
                    </li>
                    <li>
                        <a href="/color" class="{{ Request::is('color') ? 'active' : '' }} ">
                            <i class="bi bi-circle"></i><span>Warna</span>
                        </a>
                    </li>
                    <li>
                        <a href="/category" class="{{ Request::is('category') ? 'active' : '' }} ">
                            <i class="bi bi-circle"></i><span>Category</span>
                        </a>
                    </li>
                    <li>
                        <a href="/session" class="{{ Request::is('session') ? 'active' : '' }} ">
                            <i class="bi bi-circle"></i><span>Sesi</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Tables Nav -->
            <li class="nav-item">
                <a class="nav-link @if (request()->route()->uri == 'report-day' ||
                        request()->route()->uri == 'report-finance' ||
                        request()->route()->uri == 'report-shirt') ''
                @else 
                collapsed @endif"
                    data-bs-target="#reports-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Laporan</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="reports-nav" class="nav-content collapse @if (request()->route()->uri == 'report-day' ||
                        request()->route()->uri == 'report-finance' ||
                        request()->route()->uri == 'report-shirt') show @endif"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/report-day" class="{{ Request::is('report-day') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Laporan Harian</span>
                        </a>
                    </li>
                    <li>
                        <a href="/report-finance" class="{{ Request::is('report-finance') ? 'active' : '' }} ">
                            <i class="bi bi-circle"></i><span>Laporan Keuangan</span>
                        </a>
                    </li>
                    <li>
                        <a href="/report-shirt" class="{{ Request::is('report-shirt') ? 'active' : '' }} ">
                            <i class="bi bi-circle"></i><span>Laporan Baju</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Tables Nav -->

            <li class="nav-item ">
                <a class="nav-link   {{ Request::is('user') ? '' : ' collapsed' }}" href="/user">
                    <i class="bi bi-person"></i>
                    <span>User</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item ">
                <a class="nav-link bg-danger-subtle  {{ Request::is('reset') ? '' : ' collapsed' }}" href="/reset">
                    <i class="bi bi-x-octagon"></i>
                    <span>Reset</span>
                </a>
            </li><!-- End Profile Page Nav -->
        @endcan


    </ul>

</aside><!-- End Sidebar-->
