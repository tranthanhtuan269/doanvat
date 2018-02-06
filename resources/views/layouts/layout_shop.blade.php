<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ url('/') }}" target="_self">
    <title>{{ config('app.name', 'Gmon') }} - {{ $shop->name }}</title>
    <meta name="description" content="{{ $shop->name }}, {{ $shop->address }}, {{ $shop->district }}, {{ $shop->city }}"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet"> 
    <script src="{{ url('/') }}/public/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/sweetalert/sweetalert.css">
    <link rel="stylesheet" href="{{ url('/') }}/public/css/style.css">
    <link rel="stylesheet" href="{{ url('/') }}/public/css/customize.css">
    <link rel="shortcut icon" href="{{ url('/') }}/public/images/favicon.png" type="image/x-icon">
</head>
<body class="homepage">
    <!-- Global Site Tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-106844998-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments)};
    gtag('js', new Date());

    gtag('config', 'UA-106844998-1');
    </script>
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
                                                    @if($shop_id > 0)
                                                    <li><a target="_self" href="{{ url('/') }}/shop/{{ $shop_id }}/info">Trang Cửa Hàng</a></li>
                                                    <li><a target="_self" href="{{ url('/') }}/item/create">Tạo Món Mới</a></li>
                                                    @else
                                                    <li><a target="_self" href="{{ url('/') }}/shop/create">Tạo Cửa Hàng</a></li>
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
                    <p><a target="_self" href="{{ url('/') }}/showmore?shop=new">Nhà tuyển dụng</a></p>
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
                    <p style="margin-top: 72px">&#64; 2016-2017 Gmon.vn,inc. All rights reserved</p>
                </div>
            </div>
        </div>
    </footer>
    <script>
        window.onload = function ()
        {
            var w = screen.width;
            var w2 = $("#wrapper").outerWidth();
            var w3;
            if (w > 768) {
                w3 = w2 / 5;
            } else if (w > 600) {
                w3 = w2 / 3;

            } else {
                w3 = w2;
            }
            $(".item-work").css("width", w3 + "px");
            var n = w3 * ($("#contents .item-work").length);
            $("#contents").css("width", n + "px");
            setTimeout(function () {
                onNext(false);
            }, 2000);

            //------------------------------------------------//

            var w2_big = $("#wrapper-big").outerWidth();
            var w3_big = w2_big;
            $(".item-work-big").css("width", w3_big + "px");
            var n_big = w3_big * ($("#contents-big .item-work-big").length);
            $("#contents-big").css("width", n_big + "px");
            setTimeout(function () {
                onNext_big(false);
            }, 2000);
        };

        var isR = false;
        var action;
        $("#btPrev").click(function () {
            onPrev(true);
        });
        $("#btNext").click(function () {
            onNext(true);
        });
        function onNext(b) {
            if (b)
                clearTimeout(action);
            if (isR)
                return;
            isR = true;
            var w = $(".item-work").outerWidth();
            var n = parseFloat($("#contents").css("margin-left"));
            var w2 = $("#contents").outerWidth();
            var w3 = $("#wrapper").outerWidth();
            var n2 = n - w;
            if (n2 + w2 - w3 >= 0) {
                $("#contents").animate({marginLeft: n2 + 'px'}, {duration: 300, complete: function () {
                        isR = false;
                    }});
                action = setTimeout(function () {
                    onNext(false);
                }, 2000);
            } else {
                isR = false;
                action = setTimeout(function () {
                    onPrev(false);
                }, 2000);
            }
        }
        function onPrev(b) {
            if (b)
                clearTimeout(action);
            if (isR)
                return;
            isR = true;
            var w = $(".item-work").outerWidth();
            var n = parseFloat($("#contents").css("margin-left"));
            var w2 = $("#contents").outerWidth();
            var n2 = n + w;
            if (n2 <= 0) {
                $("#contents").animate({marginLeft: n2 + 'px'}, {duration: 300, complete: function () {
                        isR = false;
                    }});
                action = setTimeout(function () {
                    onPrev(false);
                }, 2000);
            } else {
                isR = false;
                action = setTimeout(function () {
                    onNext(false);
                }, 2000);
            }
        }

        // -----------------------------------------------------
        var isR_big = false;
        var action_big;
        $("#btPrev-big").click(function () {
            onPrev_big(true);
        });
        $("#btNext-big").click(function () {
            onNext_big(true);
        });
        function onNext_big(b_big) {
            if (b_big)
                clearTimeout(action_big);
            if (isR_big)
                return;
            isR_big = true;
            var w_big = $(".item-work-big").outerWidth();
            var n_big = parseFloat($("#contents-big").css("margin-left"));
            var w2_big = $("#contents-big").outerWidth();
            var w3_big = $("#wrapper-big").outerWidth();
            var n2_big = n_big - w_big;
            if (n2_big + w2_big - w3_big >= 0) {
                $("#contents-big").animate({marginLeft: n2_big + 'px'}, {duration: 300, complete: function () {
                        isR_big = false;
                    }});
                action_big = setTimeout(function () {
                    onNext(false);
                }, 2000);
            } else {
                isR_big = false;
                action_big = setTimeout(function () {
                    onPrev(false);
                }, 2000);
            }
        }
        function onPrev_big(b_big) {
            if (b_big)
                clearTimeout(action_big);
            if (isR_big)
                return;
            isR_big = true;
            var w_big = $(".item-work-big").outerWidth();
            var n_big = parseFloat($("#contents-big").css("margin-left"));
            var w2_big = $("#contents-big").outerWidth();
            var n2_big = n_big + w_big;
            if (n2_big <= 0) {
                $("#contents-big").animate({marginLeft: n2_big + 'px'}, {duration: 300, complete: function () {
                        isR_big = false;
                    }});
                action_big = setTimeout(function () {
                    onPrev(false);
                }, 2000);
            } else {
                isR_big = false;
                action_big = setTimeout(function () {
                    onNext(false);
                }, 2000);
            }
        }

        function initMap() {
            <?php if($shop->lat == "" || $shop->lng == ""){ ?>
                var uluru = {lat: 21.027443939911, lng: 105.83038324971};
            <?php }else{ ?>
                var uluru = {lat: {{ $shop->lat }}, lng: {{ $shop->lng }}};
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

        $('#star-vote>img').click(function () {
            switch ($(this).attr('id')) {
                case 'star-vote-1':
                    $('#star-vote-1').removeClass('no-vote').addClass('vote');
                    $('#star-vote-2').removeClass('vote').addClass('no-vote');
                    $('#star-vote-3').removeClass('vote').addClass('no-vote');
                    $('#star-vote-4').removeClass('vote').addClass('no-vote');
                    $('#star-vote-5').removeClass('vote').addClass('no-vote');
                    break;
                case 'star-vote-2':
                    $('#star-vote-1').removeClass('no-vote').addClass('vote');
                    $('#star-vote-2').removeClass('no-vote').addClass('vote');
                    $('#star-vote-3').removeClass('vote').addClass('no-vote');
                    $('#star-vote-4').removeClass('vote').addClass('no-vote');
                    $('#star-vote-5').removeClass('vote').addClass('no-vote');
                    break;
                case 'star-vote-3':
                    $('#star-vote-1').removeClass('no-vote').addClass('vote');
                    $('#star-vote-2').removeClass('no-vote').addClass('vote');
                    $('#star-vote-3').removeClass('no-vote').addClass('vote');
                    $('#star-vote-4').removeClass('vote').addClass('no-vote');
                    $('#star-vote-5').removeClass('vote').addClass('no-vote');
                    break;
                case 'star-vote-4':
                    $('#star-vote-1').removeClass('no-vote').addClass('vote');
                    $('#star-vote-2').removeClass('no-vote').addClass('vote');
                    $('#star-vote-3').removeClass('no-vote').addClass('vote');
                    $('#star-vote-4').removeClass('no-vote').addClass('vote');
                    $('#star-vote-5').removeClass('vote').addClass('no-vote');
                    break;
                case 'star-vote-5':
                    $('#star-vote-1').removeClass('no-vote').addClass('vote');
                    $('#star-vote-2').removeClass('no-vote').addClass('vote');
                    $('#star-vote-3').removeClass('no-vote').addClass('vote');
                    $('#star-vote-4').removeClass('no-vote').addClass('vote');
                    $('#star-vote-5').removeClass('no-vote').addClass('vote');
                    break;
                default:
                    break;
            }
        });
        $('#follow-btn').click(function () {
            var shop = $('input[name=shop-id]').val();
            var request = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('/') }}/follow-shop",
                method: "POST",
                data: {
                    'shop': shop
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
                alert("Request failed: " + textStatus);
            });
        });
        $('#unfollow-btn').click(function () {
            var shop = $('input[name=shop-id]').val();
            var request = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('/') }}/unfollow-shop",
                method: "POST",
                data: {
                    'shop': shop
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
                alert("Request failed: " + textStatus);
            });
        });

        $('#create_job_btn').click(function(){
            window.location.href = "{{ url('/') }}/job/create";
        });

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

            $('.select-template').click(function(){
                var template_id = $(this).attr('data-id');

                var request = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('/') }}/shop/changeTemplate",
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
                    alert("Request failed: " + textStatus);
                });
            });
        });
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhlfeeJco9hP4jLWY1ObD08l9J44v7IIE&callback=initMap">
    </script>
</body>
</html>