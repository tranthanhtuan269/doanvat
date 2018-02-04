<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ url('/') }}" target="_self">
    <title>{{ config('app.name', 'Gmon') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <script src="{{ url('/') }}/public/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/sweetalert/sweetalert.css">
    <link rel="stylesheet" href="{{ url('/') }}/public/css/view02.css">
    <link rel="shortcut icon" href="http://test.gmon.com.vn/?image=favicon.png" type="image/x-icon">
    <link rel="icon" href="http://test.gmon.com.vn/?image=favicon.png" type="image/x-icon">
</head>
<body class="homepage">
    <input type="hidden" name="company-id" value="{{ $company->id }}">
    <header>
        <div class="header-top clearfix">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="row">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                                <img src="http://test.gmon.com.vn/?image=menu.png" alt="" width="25px">
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
                                            <button class="exit-login visible-xs" onclick="onCloseModalLogin()" style="margin-bottom: 5px;line-height: 0;background-color: transparent;border:1px solid #C9C9C9;padding: 5px"><img src="http://test.gmon.com.vn/?image=del.png" width="15px" alt=""></button>
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
                                                                <div class="row">
                                                                    <div class="col-md-12 form-group ">
                                                                        <input type="text" class="form-control" id="username" placeholder="Họ & tên" required autofocus><span class="required">*</span>
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
                                                @elseif(Auth::check() && Auth::user()->hasRole('creator'))
                                                <li><a target="_self" href="{{ url('/post/create') }}">Create Post</a></li>
                                                @elseif(Auth::check() && Auth::user()->hasRole('poster'))
                                                    @if($company_id > 0)
                                                    <li><a target="_self" href="{{ url('/') }}/company/{{ $company_id }}/info">Trang tuyển dụng</a></li>
                                                    <li><a target="_self" href="{{ url('/') }}/job/create">Đăng tin tuyển dụng</a></li>
                                                    @else
                                                    <li><a target="_self" href="{{ url('/') }}/company/create">Tạo trang tuyển dụng</a></li>
                                                    @endif
                                                @elseif(Auth::check() && Auth::user()->hasRole('user'))
                                                    @if($cv_id > 0)
                                                    <li><a target="_self" href="{{ url('/') }}/curriculumvitae/view/{{ $cv_id }}">Trang hồ sơ</a></li>
                                                    @else
                                                    <li><a target="_self" href="{{ url('/') }}/curriculumvitae/create">Tạo hồ sơ</a></li>
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
    <div class="wrapper">
        <div class="container">
            <div class="row gmon-details">          
                <div class="col-md-3 col-lg-3">
                    <div class="details-box">
                        <div class="details-logo">
                            <img src="http://test.gmon.com.vn/?image={{ $company->logo }}">
                        </div>
                        <div class="about-us">
                            <div class="sblg-title"><span>{{ $company->name }}</span></div>
                            <div class="sb-body clearfix">
                                <p>
                                    <img src="http://test.gmon.com.vn/?image=sbicon1.png">
                                    <span>{{ $company->address }}, {{ $company->district }}, {{ $company->city }}.</span>
                                </p>
                                <p><img src="http://test.gmon.com.vn/?image=sbicon2.png"><span>{{ $company->district }}, {{ $company->city }}.</span></p>
                                @if(strlen($company->jobs) > 0)
                                <p><img src="http://test.gmon.com.vn/?image=sbicon3.png"><span>{{ rtrim($company->jobs,";") }}.</span></p>
                                @endif
                                <p><img src="http://test.gmon.com.vn/?image=sbicon4.png"><span>{{ $company->size }} người.</span></p>
                                <p><img src="http://test.gmon.com.vn/?image=sbicon5.png"><span>Thứ 2 đến thứ 6.</span></p>
                                <p><img src="http://test.gmon.com.vn/?image=sbicon6.png"><span>Chuyển động không ngừng.</span></p>
                            </div>

                        </div>
                        <div class="rate">
                            <p>Đánh giá chung</br>
                                <img src="http://test.gmon.com.vn/?image=ratestar.png">
                                <img src="http://test.gmon.com.vn/?image=ratestar.png">
                                <img src="http://test.gmon.com.vn/?image=ratestar.png">
                                <img src="http://test.gmon.com.vn/?image=ratestar.png">
                                <img src="http://test.gmon.com.vn/?image=ratestar.png">
                            </p>
                        </div>
                        <div class="comment">
                            <div class="sb-title"><span>MỌI NGƯỜI NÓI VỀ CHÚNG TÔI</span></div>
                            <div class="sb-body">
                                <p>
                                    <img src="http://test.gmon.com.vn/?image=ratestar.png">
                                    <img src="http://test.gmon.com.vn/?image=ratestar.png">
                                    <img src="http://test.gmon.com.vn/?image=ratestar.png">
                                    <img src="http://test.gmon.com.vn/?image=ratestar.png">
                                    <img src="http://test.gmon.com.vn/?image=ratestar.png"></br>
                                    <span>Môi trường chuyên nghiệp, thân thiện.</span>
                                </p>
                                <p>
                                    <img src="http://test.gmon.com.vn/?image=ratestar.png">
                                    <img src="http://test.gmon.com.vn/?image=ratestar.png">
                                    <img src="http://test.gmon.com.vn/?image=ratestar.png">
                                    <img src="http://test.gmon.com.vn/?image=ratestar.png">
                                    <img src="http://test.gmon.com.vn/?image=ratestar.png"></br>
                                    <span>Quản lý tốt bụng, quan tâm.</span>
                                </p>
                                <p>
                                    <img src="http://test.gmon.com.vn/?image=ratestar.png">
                                    <img src="http://test.gmon.com.vn/?image=ratestar.png">
                                    <img src="http://test.gmon.com.vn/?image=ratestar.png">
                                    <img src="http://test.gmon.com.vn/?image=ratestar.png">
                                    <img src="http://test.gmon.com.vn/?image=ratestar.png"></br>
                                    <span>Đồng nghiệp vui vẻ, tốt tính.</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div id="map" class="details-map">
                    </div>
                </div>
                <div class="col-md-9 col-lg-9">
                    <div class="nav nav-tabs btn-tab" role="tablist">
                        <div class="btn-about active" role="presentation">
                            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">VỀ CHÚNG TÔI</a>
                        </div>
                        <div class="btn-about" role="presentation">
                            <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">TIN TUYỂN DỤNG</a>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="wkplace">
                                @if($company_id != $company->id)
                                <img src="http://test.gmon.com.vn/?image={{ $company->banner }}">
                                <button type="button" class="btn btn-primary" id="follow-btn" @if($followed) style="display: none;" @else style="display: block;" @endif><i></i>Theo dõi</button>
                                <button type="button" class="btn btn-default" id="unfollow-btn" @if($followed) style="display: block;" @else style="display: none;" @endif><i></i>Bỏ theo dõi</button>
                                @else
                                <div class="btn-group pull-right" id="select-template">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Thay đổi giao diện <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><div class="select-template" data-id="0">Giao diện mặc định</a></li>
                                        <li><div class="select-template" data-id="1">Giao diện 1</a></li>
                                        <li><div class="select-template" data-id="2">Giao diện 2</a></li>
                                        <li><div class="select-template" data-id="3">Giao diện 3</a></li>
                                    </ul>
                                </div>
                                <img src="http://test.gmon.com.vn/?image={{ $company->banner }}">
                                @endif
                            </div>
                            <div class="wkp-txt">
                                <p><?php echo $company->description; ?></p>
                            </div>
                            <div class="wkp-slider">
                                <?php 
                                    if(strlen($company->images) > 1){
                                        $imageString=rtrim($company->images,";");
                                        $images = explode(";",$imageString);
                                        $count = 0;
                                        foreach ($images as $image) {
                                            if($count > 1) break;

                                ?>
                                <div class="col-md-6 col-lg-6">
                                    <img src="http://test.gmon.com.vn/?image={{ $image }}" width="344" height="198">
                                </div>
                                <?php 
                                        $count++;
                                        }
                                    }
                                ?>
                            </div>
                            @if(strlen($company->youtube_link) > 1)
                            <div class="details-video">
                                <iframe width="574" height="323" src="{{ str_replace('watch?v=','embed/',$company->youtube_link) }}" frameborder="0" allowfullscreen></iframe>
                            </div>
                            @endif
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">
                            @foreach($jobs as $job)
                            <div class="row employ-info">
                                <div class="employ-img col-md-2 col-lg-2">
                                    <img src="http://test.gmon.com.vn/?image={{ $job->logo }}">
                                </div>
                                <div class="col-md-10 col-lg-10 clearfix">
                                    <div class="employ-title">
                                        <a href="{{ url('/') }}/job/view/{{ $job->id }}">{{ $job->name }}</a>
                                    </div>
                                    <div class="employ-content">
                                        <div>
                                            <p>
                                                Mức lương: <span>{{ $job->salary }}</span>
                                            </p>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">
                                                <p>Số lượng: <span>{{ $job->number }}</span></p>
                                            </div>
                                            <div class="col-md-9 col-lg-9">
                                                <img src="http://test.gmon.com.vn/?image=sbicon1.png"> 
                                                <span>{{ $job->district }}, {{ $job->city }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">
                                                <p>Nhận hồ sơ đến hết: </p>
                                            </div>
                                            <div class="col-md-9 col-lg-9">
                                                <img src="http://test.gmon.com.vn/?image=clockicon.png">
                                                <span> {{ $job->expiration_date }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="employ-ft"> 
                                        <div class="employ-txt">
                                            <p>Lượt xem: <img src="http://test.gmon.com.vn/?image=eyeicon.png">
                                                <span>{{ $job->views }}</span>
                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                Hồ sơ ứng tuyển: 
                                                <span>{{ $job->applied }}&nbsp;</span>
                                                <img src="http://test.gmon.com.vn/?image=new-employ.png" style="max-width: 60%;">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="footer-top row">
                <div class="col-md-4 col-xs-6 footer-col">
                    <p class="title">về gmon</p>
                    <p><a href="http://news.gmon.vn/post/10/lich-su-phat-trien-gmon">Giới thiệu</a></p>
                    <p><a href="">Việc làm</a></p>
                    <p><a href="">Nhà tuyển dụng</a></p>
                    <p><a href="">Hồ sơ ứng viên</a></p>
                    <p><a href="">Nhà tuyển dụng</a></p>
                </div>
                <div class="col-md-3 col-xs-6 footer-col">
                    <p class="title">công cụ</p>
                    <p><a href="">Hồ sơ</a></p>
                    <p><a href="">Việc làm của tôi</a></p>
                    <p><a href="">Thông báo việc làm</a></p>
                    <p><a href="">Phản hồi</a></p>
                    <p><a href="">Tư vấn nghề nghiệp</a></p>
                </div>
                <div class="col-md-5 contact col-xs-12 footer-col">
                    <p class="title">kết nối với gmon</p>
                    <p class="mxh">
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
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
    <script>
        function onCloseModalLogin(){
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
        function onFocusCandidates(event){
            $(event.target).find(".view").animate({top: 0+'px'},300);
        }
        function onDisFocusCandidates(event){
            $(event.target).find(".view").animate({top: 200+'px'});
        }
        $('.btn-about').click(function(e){
            $('.btn-about').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
            $(this).tab('show');
        });
        $(document).ready(function () {
            onOpenLogin();
            $('#login-btn').click(function () {
                $('#login-message').hide();
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
                    swal("Cảnh báo", "Đã có lỗi khi thêm đánh giá!", "error");
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
                    swal("Cảnh báo", "Đã có lỗi khi thêm đánh giá!", "error");
                });
            });

            $('.select-template').click(function(){
                var template_id = $(this).attr('data-id');

                var request = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('/') }}/company/changeTemplate",
                    method: "POST",
                    data: {
                        'template': template_id
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
                    swal("Cảnh báo", "Đã có lỗi khi thêm đánh giá!", "error");
                });
            });
        });

        $('#follow-btn').click(function () {
            var company = $('input[name=company-id]').val();
            var request = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('/') }}/follow-company",
                method: "POST",
                data: {
                    'company': company
                },
                dataType: "json"
            });

            request.done(function (msg) {
                if (msg.code == 200) {
                    // thong bao khi follow thanh cong
                    $('#follow-btn').hide();
                    $('#unfollow-btn').show();
                }else if(msg.code == 401 && msg.message == "unauthen!"){
                        $('#myModal').modal('toggle');
                        onOpenLogin();
                }
            });

            request.fail(function (jqXHR, textStatus) {
                swal("Cảnh báo", "Đã có lỗi khi thêm đánh giá!", "error");
            });
        });
        $('#unfollow-btn').click(function () {
            var company = $('input[name=company-id]').val();
            var request = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('/') }}/unfollow-company",
                method: "POST",
                data: {
                    'company': company
                },
                dataType: "json"
            });

            request.done(function (msg) {
                if (msg.code == 200) {
                    // thong bao khi unfollow thanh cong
                    $('#follow-btn').show();
                    $('#unfollow-btn').hide();
                }else if(msg.code == 401 && msg.message == "unauthen!"){
                        $('#myModal').modal('toggle');
                        onOpenLogin();
                }
            });

            request.fail(function (jqXHR, textStatus) {
                swal("Cảnh báo", "Đã có lỗi khi thêm đánh giá!", "error");
            });
        });

        function initMap() {
            <?php if($company->lat == "" || $company->lng == ""){ ?>
                var uluru = {lat: 21.027443939911, lng: 105.83038324971};
            <?php }else{ ?>
                var uluru = {lat: {{ $company->lat }}, lng: {{ $company->lng }}};
            <?php } ?>
            
            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 15,
              center: uluru
            });
            var marker = new google.maps.Marker({
              position: uluru,
              map: map
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhlfeeJco9hP4jLWY1ObD08l9J44v7IIE&callback=initMap">
        </script>
</body>
</html>

