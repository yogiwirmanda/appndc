<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login </title>
    <!-- Meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords"
          content="Allied Login Form Responsive Widget, Audio and Video players, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design"
    />
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Meta tags -->
    <!-- font-awesome icons -->
    <link href="{{asset('allied/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!--stylesheets-->
    <link href="{{asset('allied/css/style.css')}}" rel='stylesheet' type='text/css' media="all">
    <script src={{asset('light/js/jquery2.0.3.min.js')}}></script>
    <!--//style sheet end here-->
    <link href="//fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
</head>

<body>
<h1 class="error">Application Login</h1>
<div class="w3layouts-two-grids">
    <div class="mid-class">
        <div class="txt-left-side">
            <h2> Login Here </h2>
            <p>Selamat Datang di Aplikasi silahkan login untuk memulai aplikasi</p>
            <div class="form-left-to-w3l">
                <span class="fa fa-envelope-o" aria-hidden="true"></span>
                <input type="text" name="username" id="username" placeholder="Username" required="" style="width: 100%">
                <div class="clear"></div>
            </div>
            <div class="form-left-to-w3l">
                <span class="fa fa-lock" aria-hidden="true"></span>
                <input type="text" name="password" id="password" placeholder="Password" required="" style="width: 100%">
                <div class="clear"></div>
            </div>
            <div class="btnn">
                <button type="submit" id="btnLogin">Login</button>
                <button type="submit" id="btnBack">Dashboard</button>
            </div>
        </div>
        <div class="img-right-side">
            <h3>Alur Pendaftaran</h3>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget</p>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget</p>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget</p>
            <img src="images/b11.png" class="img-fluid" alt="">
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    $('#btnLogin').click(function (e) {
        e.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();
        window.location.href = '/fpasiens/loginPasien/' + username + '/' + password;
    });
    $('#btnBack').click(function (e) {
        e.preventDefault();
        window.location.href = '/';
    });
</script>
