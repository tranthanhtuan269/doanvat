<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Gmon') }}</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <base href="{{ url('/') }}" target="_self">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet"> 
        <script src="{{ url('/') }}/public/sweetalert/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/sweetalert/sweetalert.css">
        <script src="{{ url('/') }}/public/js/jquery.cookie.js"></script>
        <link rel="stylesheet" href="{{ url('/') }}/public/css/home.css">
        <link href="{{ url('/') }}/public/css/customize.css" rel="stylesheet">
        <link rel="shortcut icon" href="http://test.gmon.com.vn/?image=favicon.png" type="image/x-icon">
        <link rel="icon" href="http://test.gmon.com.vn/?image=favicon.png" type="image/x-icon">
    </head>
    <body class="homepage">
        <div class="header-homepage">
           <div class="top-menu">
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-xl-6 col-lg-8 left-menu">
                           <div class="row">
                               <div class="col-md-4">
                                   <div class="logo">
                                       <a href="#"><img src="assets/images/logo-2.png" alt="logo"/></a>
                                   </div>
                               </div>
                               <ul class="homepage-menu col-md-8">
                                   <li class="active"><a href="#">Việc làm</a></li>
                                   <li><a href="#">Nhà tuyển dụng</a></li>
                                   <li><a href="#">Tư vấn nghề nghiệp</a></li>
                               </ul>
                           </div>
                       </div>
                       <div class="col-xl-6 col-lg-4 right-menu">
                           <ul class="homepage-menu">
                               <li><a href="#"><i class="fa fa-sign-in" aria-hidden="true"></i> Đăng nhập</a></li>
                               <li><a href="#">Đăng ký</a></li>
                               <li class="info">
                                   <h5>dành cho nhà tuyển dụng</h5>
                                   <h6 >Đăng tuyển dụng ứng viên & Tìm kiếm nhân tài</h6>
                               </li>
                           </ul>
                       </div>
                   </div>
               </div>
           </div>
            <div class="top-menu-mobile">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-6 left">
                            <a href="#"><img src="assets/images/logo-2.png" alt="logo"/></a>
                        </div>
                        <div class="col-sm-6 col-6 right">
                            <a href="#menu" class="fa fa-bars"></a>
                            <nav id="menu">
                                <ul>
                                    <li><a href="#">Việc làm</a></li>
                                    <li><a href="#">Nhà tuyển dụng</a></li>
                                    <li><a href="#">Tư vấn nghề nghiệp</a></li>
                                    <li><a href="#">Đăng nhập</a></li>
                                    <li><a href="#">Đăng ký</a></li>
                                </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <header>
            <div class="header-top clearfix">
                <nav class="navbar navbar-default">
                    <div class="container">
                        <div class="row">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                                    <img src="{{ url('/') }}/public/images/menu.png" alt="" width="25px">
                                </button>
                            </div>
                            <div class="collapse navbar-collapse" id="navbar-collapse">
                                <div class="row">
                                    <div class="link-left">
                                        <a target="_self" href="{{ url('/') }}"><i></i>Trang chủ</a>
                                        <a target="_self" href="{{ url('/') }}/showmore?job=new"><i></i>Việc làm</a>
                                        <a target="_self" href="{{ url('/') }}/showmore?company=new"><i></i>Nhà tuyển dụng</a>
                                    </div>
                                    <div class="login">
                                        @if (Auth::guest())
                                        <a target="_self" data-toggle="modal" data-target="#myModal" onclick="onOpenLogin()"><i></i>Đăng nhập</a>
                                        <a target="_self" data-toggle="modal" data-target="#myModal" onclick="onOpenRegister()">Đăng ký</a>
                                        <!-- Modal -->
                                        <div id="myModal" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <button class="exit-login visible-xs" onclick="onCloseModalLogin()" style="margin-bottom: 5px;line-height: 0;background-color: transparent;border:1px solid #C9C9C9;padding: 5px"><img src="{{ url('/') }}/public/images/del.png" width="15px" alt=""></button>
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div style="margin:-15px -15px 0 -15px!important;">
                                                            <ul class="nav nav-justified header-tab-login">
                                                                <li class=""><a target="_self" data-toggle="tab" href="#login">Đăng nhập</a></li>
                                                                <li class=""><a target="_self" data-toggle="tab" href="#register">Đăng ký</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-content">
                                                            <div id="register" class="tab-pane fade">
                                                                <h3>ĐĂNG KÝ TÀI KHOẢN GMON NGAY !</h3>
                                                                <form method="post">
                                                                    <!-- <div class="row text-center">
                                                                        <p>Tiếp tục với</p>
                                                                        <a target="_self" href="#" class="facebook"><i></i> Facebook</a>
                                                                        <a target="_self" href="#" class="google"><i></i> Google</a>
                                                                        <span class="col-md-12" style="display: inline-block;margin-bottom: 30px"><hr style="float: left;width: 40%;margin-top: 25px">Hoặc<hr style="float: right;width: 40%;margin-top: 25px"></span>
                                                                    </div> -->
                                                                    <div class="row">
                                                                        <div class="col-md-6 form-group ">
                                                                            <input type="text" class="form-control" id="firstname" placeholder="Họ" required autofocus><span class="required">*</span>
                                                                        </div>
                                                                        <div class="col-md-6 form-group ">
                                                                            <input type="text" class="form-control" id="lastname" placeholder="Tên" required><span class="required">*</span>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-12">
                                                                            <input type="number" class="form-control" id="sdt" placeholder="Số điện thoại" required><span class="required">*</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-12">
                                                                            <input type="email" class="form-control" id="register-email" placeholder="Email" required><span class="required">*</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6 form-group ">
                                                                            <input type="password" class="form-control" id="register-password" placeholder="Mật khẩu" required><span class="required">*</span>
                                                                        </div>
                                                                        <div class="col-md-6 form-group ">
                                                                            <input type="password" class="form-control" id="r_password" placeholder="Xác nhận mật khẩu" required><span class="required">*</span>
                                                                        </div>
                                                                    </div>
                                                                    <div style="margin-top: -5px;margin-bottom: 20px">
                                                                        <label for="">Bạn là:</label>
                                                                        <select name="areyou" id="areyou">
                                                                            <option value="1">Ứng viên</option>
                                                                            <option value="2">Nhà tuyển dụng</option>
                                                                        </select>
                                                                    </div>
                                                                    <p class="text-center text-danger" id="register-message" style="display: none;">Đăng ký không thành công!</p>
                                                                    <div class="text-center">
                                                                        <div id="register-btn" class="btn btn-primary">ĐĂNG KÝ NGAY</div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div id="login" class="tab-pane fade">
                                                                <!-- <h3>ĐĂNG NHẬP</h3> -->
                                                                <form>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-12">
                                                                            <input type="email" class="form-control" id="login-email" placeholder="Email" required autofocus>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-12">
                                                                            <input type="password" class="form-control" id="login-password" placeholder="Mật khẩu" required>
                                                                        </div>
                                                                    </div>
                                                                    <p class="text-center text-danger" id="login-message" style="display: none;">Tài khoản không chính xác!</p>
                                                                    <div class="text-center">
                                                                        <div id="login-btn" class="btn btn-primary">ĐĂNG NHẬP</div>
                                                                    </div>
                                                                    <hr>
                                                                    <p class="text-center">Hoặc đăng nhập nhanh bằng</p>
                                                                    <div class="row text-center">
                                                                        <a target="_self" href="{{ url('/auth/facebook') }}" class="facebook"><i></i> Facebook</a>
                                                                        <a target="_self" href="{{ url('/auth/google') }}" class="google"><i></i> Google</a>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end -->
                                        </div>
                                        @else
                                        <ul class="nav navbar-nav navbar-right">
                                            <li class="dropdown">
                                                <a target="_self" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                    {{ Auth::user()->name }} <span class="caret"></span>
                                                </a>

                                                <ul class="dropdown-menu" role="menu">
                                                    @if(Auth::check() && Auth::user()->hasRole('admin'))
                                                    <li><a target="_self" href="{{ url('/admin') }}">Administrator</a></li>
                                                    @elseif(Auth::check() && Auth::user()->hasRole('master'))
                                                    <li><a target="_self" href="{{ url('/city/admin') }}">Administrator</a></li>
                                                    @elseif(Auth::check() && Auth::user()->hasRole('user'))
                                                    @if($cv_id > 0)
                                                    <li><a target="_self" href="{{ url('/') }}/curriculumvitae/view/{{ $cv_id }}">Trang hồ sơ</a></li>
                                                    @endif
                                                    @else 

                                                    @endif
                                                    <li>
                                                        <a target="_self" href="{{ url('/logout') }}"
                                                           onclick="event.preventDefault();
                                                                   document.getElementById('logout-form').submit();">
                                                            Đăng Xuất
                                                        </a>

                                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                            {{ csrf_field() }}
                                                        </form>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        @yield('content')
        
        <footer>
            <div class="container">
                <div class="footer-top row">
                    <div class="col-md-4 col-xs-6 footer-col">
                        <p class="title">về gmon</p>
                        <p><a target="_self" href="http://news.gmon.vn/post/10/lich-su-phat-trien-gmon">Giới thiệu</a></p>
                        <p><a target="_self" href="{{ url('/') }}/showmore?job=new">Việc làm</a></p>
                        <p><a target="_self" href="{{ url('/') }}/showmore?company=new">Nhà tuyển dụng</a></p>
                        <p><a target="_self" href="{{ url('/') }}/showmore?cv=vip">Hồ sơ ứng viên</a></p>
                    </div>
                    <div class="col-md-3 col-xs-6 footer-col">
                        <p class="title">công cụ</p>
                        <p><a target="_self" href="">Việc làm của tôi</a></p>
                        <p><a target="_self" href="">Thông báo việc làm</a></p>
                        <p><a target="_self" href="">Phản hồi</a></p>
                        <p><a target="_self" href="">Tư vấn nghề nghiệp</a></p>
                    </div>
                    <div class="col-md-5 contact col-xs-12 footer-col">
                        <p class="title">kết nối với gmon</p>
                        <p class="mxh">
                            <a target="_self" href=""></a>
                            <a target="_self" href=""></a>
                            <a target="_self" href=""></a>
                        </p>
                    </div>
                </div>

                <div class="footer-bot row">
                    <div class="col-md-8">
                        <p><b>Công ty cổ phần giải pháp và công nghệ Gmon</b></p>
                        <p><b>Trụ sở chính:</b> Tầng 8, Tòa nhà Trần Phú, Dương Đình Nghệ, Cầu Giấy, Hà Nội</p>
                        <p><b>Điện thoại:</b> 0243.212.1515</p>
                        <p><b>VPĐD:</b> Số 31, Trần Phú, Hải Châu I, Hải Châu, Đà Nẵng</p>
                        <p><b>Điện thoại:</b> 0961 545 115</p>
                        <p><b>Email:</b> support@gmon.vn</p>
                    </div>
                    <div class="col-md-4">
                        <p style="margin-top: 15px">&#64; 2016-2017 Gmon.vn,inc. All rights reserved</p>
                    </div>
                </div>
            </div>
        </footer>

        <script type="text/javascript">

            function onCloseModalLogin() {
                $("#myModal").modal('toggle');
            }
            function onOpenRegister() {
                $("#register").addClass("in active");
                $("#login").removeClass("in active");
                $(".header-tab-login li:nth-child(1)").removeClass("active");
                $(".header-tab-login li:nth-child(2)").addClass("active");
            }
            function onOpenLogin() {
                $("#login").addClass("in active");
                $("#register").removeClass("in active");
                $(".header-tab-login li:nth-child(2)").removeClass("active");
                $(".header-tab-login li:nth-child(1)").addClass("active");
            }
            function onFocusCandidates(event) {
                $(event.target).find(".view").animate({top: 0 + 'px'}, 300);
            }
            function onDisFocusCandidates(event) {
                $(event.target).find(".view").animate({top: 200 + 'px'});
            }
            $(document).ready(function () {
                onOpenLogin();
                $('#login-btn').click(function () {
                    var loginEmail = $('#login-email').val();
                    var loginPassword = $('#login-password').val();
                    var request = $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('/') }}/auth/login",
                        method: "POST",
                        data: {
                            'email': loginEmail,
                            'password': loginPassword
                        },
                        dataType: "json"
                    });

                    request.done(function (msg) {
                        if (msg.code == 200) {
                            location.reload();
                        }else{
                            $('#login-message').show();
                        }
                    });

                    request.fail(function (jqXHR, textStatus) {
                        alert("Request failed: " + textStatus);
                    });
                });

                $('#register-btn').click(function () {
                    $('#register-message').hide();
                    var registerFirstname = $('#firstname').val();
                    var registerLastname = $('#lastname').val();
                    var username = registerFirstname + ' ' + registerLastname;
                    var registersdt = $('#sdt').val();
                    var registerEmail = $('#register-email').val();
                    var registerPassword = $('#register-password').val();
                    var rPassword = $('#r_password').val();
                    var role = $('#areyou').val();
                    if (registerPassword != rPassword) {
                        return false;
                    }

                    var request = $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('/') }}/auth/register",
                        method: "POST",
                        data: {
                            'username': username,
                            'password': registerPassword,
                            'email': registerEmail,
                            'phone': registersdt,
                            'role': role
                        },
                        dataType: "json"
                    });

                    request.done(function (msg) {
                        if (msg.code == 200) {
                            location.reload();
                        }else{
                            $('#register-message').show();
                        }
                    });

                    request.fail(function (jqXHR, textStatus) {
                        alert("Request failed: " + textStatus);
                    });
                });
            });
        </script>
        <style type="text/css">
            header {
                border-bottom: 3px solid #3f7fba
            }

            header .logo {
                overflow: hidden;
                padding: 23px
            }

            header .logo img {
                width: 135px;
                height: 44px
            }

            header .header-info {
                padding-top: 40px;
                padding-bottom: 26px;
                text-align: right
            }

            header .header-info .item-header {
                margin-right: 25px;
                display: inline-block
            }

            header .header-info .item-header a {
                font-size: 15px;
                font-weight: 600;
                color: #000
            }

            header .header-info .item-header a .fa {
                color: #00a451;
                padding-right: 5px
            }

            header .header-info .item-header a:hover {
                color: #3f7fba;
                text-decoration: none
            }

            header .header-info .item-header a:hover .fa {
                color: #3f7fba
            }

            .header-homepage {
                background: url(../images/bg-header.jpg) no-repeat 50% fixed;
                background-size: cover;
                height: 595px;
                position: relative;
                font-family: Roboto, sans-serif
            }

            .header-homepage .top-menu {
                opacity: .8;
                background: #4160a1;
                border-bottom: 1px solid #ccc;
                font-size: 16px
            }

            .header-homepage .top-menu .left-menu .logo {
                background: #254893;
                text-align: center;
                overflow: hidden;
                padding: 20px 30px;
                position: absolute;
                box-shadow: #ccc
            }

            .header-homepage .top-menu .left-menu .logo img {
                width: 110px;
                height: 40px
            }

            .header-homepage .top-menu .left-menu .homepage-menu {
                margin: 0
            }

            .header-homepage .top-menu .left-menu .homepage-menu li {
                display: inline-block;
                padding: 21px 0;
                margin: 0 14px
            }

            .header-homepage .top-menu .left-menu .homepage-menu li.active,
            .header-homepage .top-menu .left-menu .homepage-menu li:hover {
                border-bottom: 2px solid #fff
            }

            .header-homepage .top-menu .left-menu .homepage-menu li a {
                color: #fff;
                font-size: 16px
            }

            .header-homepage .top-menu .left-menu .homepage-menu li a:hover {
                text-decoration: none
            }

            .header-homepage .top-menu .right-menu {
                text-align: right
            }

            .header-homepage .top-menu .right-menu .homepage-menu {
                margin: 0
            }

            .header-homepage .top-menu .right-menu .homepage-menu li {
                display: inline-block;
                padding: 14px 0;
                margin: 0 15px
            }

            .header-homepage .top-menu .right-menu .homepage-menu li.active,
            .header-homepage .top-menu .right-menu .homepage-menu li:hover {
                border-bottom: 2px solid #fff
            }

            .header-homepage .top-menu .right-menu .homepage-menu li a {
                color: #fff;
                font-size: 16px
            }

            .header-homepage .top-menu .right-menu .homepage-menu li a:hover {
                text-decoration: none
            }

            .header-homepage .top-menu .right-menu .homepage-menu .info {
                background: #fff;
                padding: 12px;
                color: #6a82b5
            }

            .header-homepage .top-menu .right-menu .homepage-menu .info h5 {
                font-size: 15px;
                font-weight: 700;
                text-align: center;
                text-transform: uppercase
            }

            .header-homepage .top-menu .right-menu .homepage-menu .info h6 {
                text-align: center;
                font-size: 10.34px
            }

            .header-homepage .top-menu-mobile {
                display: none;
                padding-top: 20px
            }

            .header-homepage .top-menu-mobile .right {
                color: #fff;
                text-align: right
            }

            .header-homepage .top-menu-mobile .right a:hover {
                text-decoration: none
            }

            .header-homepage .top-menu-mobile .right .fa {
                font-size: 24px;
                color: #fff
            }

            .header-homepage .top-search {
                position: absolute;
                left: calc(50% - 375px);
                bottom: 40px
            }

            .header-homepage .top-search .wrapper-header h3 {
                color: #fff;
                font-size: 36px
            }

            .header-homepage .top-search .wrapper-header h3 span {
                text-transform: uppercase;
                font-weight: 600
            }
        </style>
    </body>
</html>