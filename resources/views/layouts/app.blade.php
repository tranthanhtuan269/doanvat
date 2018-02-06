<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width initial-scale=1.0"/>

    <title>doanvat.vn</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>

    <script src="{{ url('/') }}/public/theme/js/jquery-3.3.1.min.js"></script>
    <script src="{{ url('/') }}/public/theme/js/masonry.pkgd.min.js"></script>
    <script src="{{ url('/') }}/public/theme/js/imagesloaded.pkgd.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/css/styleMainpage.css"/>
</head>
<body>
    <nav id="navbar">
        <div class="menu">
            <ul class="desktop">
                <li class="brand-item"><a href="{{ url('/') }}">DoAnVat.vn</a></li>
                <li><a href="#">Quán ăn nổi tiếng</a>
                    <ul class="submenu">
                        <li><a href="#">Bữa sáng</a></li>
                        <li><a href="#">Bữa trưa</a></li>
                        <li><a href="#">Bữa chiều</a></li>
                        <li><a href="#">Bữa tối</a></li>
                        <li><a href="#">Bữa đêm</a></li>
                    </ul>
                </li>
                <li><a href="#">Quán ăn gần bạn</a>
                    <ul class="submenu">
                        <li><a href="#">Bữa sáng</a></li>
                        <li><a href="#">Bữa trưa</a></li>
                        <li><a href="#">Bữa chiều</a></li>
                        <li><a href="#">Bữa tối</a></li>
                        <li><a href="#">Bữa đêm</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/') }}/cart">Giỏ hàng<span class="number-in-cart">(1)</span></a></li>
                <li><a href="{{ url('/') }}/login">Đăng nhập</a></li>
                <li><a href="{{ url('/') }}/register">Đăng ký</a></li>
            </ul>
            <ul class="mobile">
                <li class="brand-item"><a href="{{ url('/') }}">DoAnVat.vn</a></li>
                <li><a href="#">Quán ăn nổi tiếng</a>
                    <ul class="submenu">
                        <li><a href="#">Bữa sáng</a></li>
                        <li><a href="#">Bữa trưa</a></li>
                        <li><a href="#">Bữa chiều</a></li>
                        <li><a href="#">Bữa tối</a></li>
                        <li><a href="#">Bữa đêm</a></li>
                    </ul>
                </li>
                <li><a href="#">Quán ăn gần bạn</a>
                    <ul class="submenu">
                        <li><a href="#">Bữa sáng</a></li>
                        <li><a href="#">Bữa trưa</a></li>
                        <li><a href="#">Bữa chiều</a></li>
                        <li><a href="#">Bữa tối</a></li>
                        <li><a href="#">Bữa đêm</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/') }}/cart">Giỏ hàng<span class="number-in-cart"> ( 1 ) </span></a></li>
                <li><a href="{{ url('/') }}/login">Đăng nhập</a></li>
                <li><a href="{{ url('/') }}/register">Đăng ký</a></li>
            </ul>
        </div>
        <div id="openMenu">MENU</div>
    </nav>
    <div class="overlay"></div>
    <div class="alert" id="checkLocalStore" style="display: none;">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        Phiên bản trình duyệt của bạn không hỗ trợ mua hàng trên <b>DoAnVat.vn</b>. <br /> Xin hãy cập nhật phiên bản mới để trải nghiệm dịch vụ của chúng tôi!
    </div>

    @yield('content')

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>