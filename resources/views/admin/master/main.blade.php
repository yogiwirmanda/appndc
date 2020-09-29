<!DOCTYPE html>
<head>
    @include('admin.master.head')
</head>
<body>
<section id="container">
    <div class="wrapper">
        @include('admin.master.sidebar')
        <section id="content">
            <div class="main-panel">
                @include('admin.master.header')
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>
            @include('admin.master.footer')
        </section>
    </div>
</section>
@include('admin.master.script')
</body>
</html>
