<div class="sidebar" data-image="{{asset('light/img/sidebar-5.jpg')}}">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text">
                Application
            </a>
        </div>
        <ul class="nav">
            <?php if (Auth::check() == 1) :?>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/pasiens/" class="nav-link">
                    <i class="nc-icon nc-notes"></i>
                    <p>Pasien</p>
                </a>
            </li>
                <li class="nav-item">
                    <a href="/kehadirans/" class="nav-link">
                        <i class="nc-icon nc-circle-09"></i>
                        <p>Kunjungan</p>
                    </a>
                </li>
            <li class="nav-item">
                <a href="/dokters/" class="nav-link">
                    <i class="nc-icon nc-circle-09"></i>
                    <p>Dokter</p>
                </a>
            </li>
            {{--<li class="nav-item">--}}
                {{--<a href="/tindakans/" class="nav-link">--}}
                    {{--<i class="nc-icon nc-light-3"></i>--}}
                    {{--Tindakan--}}
                {{--</a>--}}
            {{--</li>--}}
            <li class="nav-item">
                <a href="/jadwals/" class="nav-link">
                    <i class="nc-icon nc-paper-2"></i>
                    <p>Jadwal</p>
                </a>
            </li>
            <li class="nav-item" class="sub-menu">
                <a href="/lpendaftarans/" class="nav-link">
                    <i class="nc-icon nc-bullet-list-67"></i>
                    <p>Laporan Pendaftaran</p>
                </a>
            </li>
            <?php endif; ?>

            <?php if(Auth::check() != 1 && !empty(Session::get('login')) && Session::get('role') == 'pasien'):?>
            <li class="nav-item">
                <a href="/fdashboard" class="nav-link">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/fpasiens" class="nav-link">
                    <i class="nc-icon nc-circle-09"></i>
                    <span>Pendaftaran Pasien</span>
                </a>
            </li>
            <li class="nav-item" class="sub-menu">
                <a href="/fpasiens/logout" class="nav-link">
                    <i class="nc-icon nc-key-25"></i>
                    <span>Logout</span>
                </a>
            </li>
            <?php endif; ?>
            <?php if(Auth::check() != 1 && empty(Session::get('login')) && empty(Session::get('role'))): ?>
            <li class="nav-item">
                <a href="/fdashboard" class="nav-link">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/fpasiens" class="nav-link">
                    <i class="nc-icon nc-circle-09"></i>
                    <span>Pendaftaran Pasien</span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</div>
