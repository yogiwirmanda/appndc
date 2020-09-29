<nav class="navbar navbar-expand-lg " color-on-scroll="500">
    <div class="container-fluid">
        <a class="navbar-brand" href="#pablo"> Application </a>
        <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="nav navbar-nav mr-auto">
                {{--<li class="nav-item">--}}
                    {{--<a href="/dashboard" class="nav-link" data-toggle="dropdown">--}}
                        {{--<i class="nc-icon nc-palette"></i>--}}
                        {{--<span class="d-lg-none">Dashboard</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="dropdown nav-item">--}}
                    {{--<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">--}}
                        {{--<i class="nc-icon nc-planet"></i>--}}
                        {{--<span class="notification">5</span>--}}
                        {{--<span class="d-lg-none">Notification</span>--}}
                    {{--</a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<a class="dropdown-item" href="#">Notification 1</a>--}}
                        {{--<a class="dropdown-item" href="#">Notification 2</a>--}}
                        {{--<a class="dropdown-item" href="#">Notification 3</a>--}}
                        {{--<a class="dropdown-item" href="#">Notification 4</a>--}}
                        {{--<a class="dropdown-item" href="#">Another notification</a>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            </ul>
            <?php if (Auth::check() == 1): ?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </li>
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form>
            <?php endif; ?>
        </div>
    </div>
</nav>
