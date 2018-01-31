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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet"> 
    <script src="{{ url('/') }}/public/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/sweetalert/sweetalert.css">
    <link rel="stylesheet" href="{{ url('/') }}/public/css/home.css">
</head>
<body class="homepage">
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
                                    <a target="_self" href=""><i></i>Việc làm</a>
                                    <a target="_self" href=""><i></i>Nhà tuyển dụng</a>
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
        <div class="header-mid">
            <div class="container" >
                <div class="clearfix row" style="padding-bottom: 30px">
                    <div class="col-md-3">
                        <a target="_self" href="" class="logo row"><img src="{{ url('/') }}/public/images/home.png" alt=""></a>
                    </div>
                    <div class="col-md-9" style="margin-top: 30px">
                        <div class="">
                            <div class="col-md-9">
                                <form class="search">
                                    <input type="text" name="" id="" class="col-md-5" placeholder="Nhập tên công việc">
                                    <span> <i></i>
                                        <select id="tinh">
                                            <option>Hà Nội</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                        </select>
                                    </span>
                                    <span> <i></i>
                                        <select id="quanhuyen">
                                            <option>Quận/Huyện</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                        </select>
                                    </span>
                                    <button type="submit" class="hidden-xs"><i></i></button>
                                    <button type="submit" class="visible-xs" style="width: auto;border:1px solid #EBEAEA;padding:5px 7px;height: auto;margin:auto;margin-top: 10px;background-color: #F5F5F5;color:#A8A8A8;border-radius: 4px">Tìm kiếm</button>
                                </form>
                                <div class="city">
                                    <a target="_self" href="{{ url('/') }}/home?city=1">Hà Nội</a>
                                    <a target="_self" href="{{ url('/') }}/home?city=2">TP HCM</a>
                                    <a target="_self" href="{{ url('/') }}/home?city=3">Đà Nẵng</a>
                                    <a target="_self" href="{{ url('/') }}/home?city=4">Hải Phòng</a>
                                    <a target="_self" href="{{ url('/') }}/home?city=14">Bình Dương</a>
                                </div>
                            </div>
                            <div class="col-md-3 clearfix">
                                <div class="contact row">
                                    <p><i></i>0243.212.1515</p>
                                    <p><i></i>support@gmon.vn</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bot">
            <div class="container clearfix">
                <div class="row">
                    <div class="menu-left">
                        <a target="_self" href=""><i></i>Khách sạn</a>
                        <a target="_self" href=""><i></i>Nhà hàng</a>
                        <a target="_self" href=""><i></i>Cửa hàng</a>
                        <a target="_self" href=""><i></i>Doanh nghiệp</a>
                        <a target="_self" href=""><i></i>Nhân sự tài năng</a>
                    </div>
                    <div class="menu-right">
                        @if (Auth::guest())
                            <a target="_self" data-toggle="modal" data-target="#myModal" onclick="onOpenRegister()"><i></i>Tạo hồ sơ</a>
                            <a target="_self" data-toggle="modal" data-target="#myModal" onclick="onOpenRegister()"><i></i>Trang tuyển dụng</a>
                        @else
                            @if(Auth::user()->hasRole('user'))
                            <a target="_self" href="{{ url('/') }}/curriculumvitae/create"><i></i>Tạo hồ sơ</a>
                            @endif
                            @if(Auth::user()->hasRole('poster'))
                            @if($company_id == -1)
                            <a target="_self" href="{{ url('/') }}/company/create"><i></i>Trang tuyển dụng</a>
                            @else
                            <a target="_self" href="{{ url('/') }}/company/{{ $company_id }}/info"><i></i>Trang tuyển dụng</a>
                            <a target="_self" href="{{ url('/') }}/job/create"><i></i>Đăng tuyển dụng</a>
                            @endif
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
    @yield('content')
    </body>
</html>