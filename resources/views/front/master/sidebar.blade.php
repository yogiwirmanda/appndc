<aside>
    <div id="sidebar" class="nav-collapse">
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
              <?php if(Auth::check() != 1 && !empty(Session::get('login')) && Session::get('role') == 'pasien'){ ?>
                <li>
                    <a href="/fdashboard">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/fpasiens">
                        <i class="fa fa-dashboard"></i>
                        <span>Pendaftaran Pasien</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="/fpasiens/logout">
                        <i class="fa fa-th"></i>
                        <span>Logout</span>
                    </a>
                </li>
              <?php } ?>
              <?php if(Auth::check() != 1 && empty(Session::get('login')) && empty(Session::get('role'))){ ?>
                <li>
                    <a href="/fdashboard">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/fpasiens">
                        <i class="fa fa-dashboard"></i>
                        <span>Pendaftaran Pasien</span>
                    </a>
                </li>
              <?php } ?>
            </ul>
          </div>
        <!-- sidebar menu end-->
    </div>
</aside>
