<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ url('/') }}" target="_self">
    <title>{{ config('app.name', 'Gmon') }} - {{ $company->name }}</title>
    <meta name="description" content="{{ $company->name }}, {{ $company->address }}, {{ $company->district }}, {{ $company->city }}"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet"> 
    <script src="{{ url('/') }}/public/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/sweetalert/sweetalert.css">
    <script type="text/javascript" src="{{ url('/') }}/public/bower_components/moment/min/moment.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/public/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="{{ url('/') }}/public/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/public/css/fptHomeCss.css">
    <link rel="shortcut icon" href="http://test.gmon.com.vn/?image=favicon.png" type="image/x-icon">
    <link rel="icon" href="http://test.gmon.com.vn/?image=favicon.png" type="image/x-icon">
    
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

	<div class="container" style="margin-top: 15px;">
        <div class="row ads clearfix">
            @if(isset($company->images) && strlen($company->images) > 0)
            <?php 
                $company->images=rtrim($company->images,";");
                $images = explode(";",$company->images);
                for($i = 0; $i < count($images); $i++){ if($i == 3) break; ?>
                    
                    <div class="col-md-4 col-xs-12">
                        <div class="item-ads"><img src="http://test.gmon.com.vn/?image={{ $images[$i] }}" alt=""></div>
                    </div>

                <?php } ?>
            @endif
        </div>
        <div class="contents-job row">
            <div class="col-md-4 info-company col-xs-12">
                <div class="logo"><a target="_self" href="{{ url('/') }}/company/{{ $company->id }}/info"><img src="http://test.gmon.com.vn/?image={{ $company->logo }}" width="250"></a></div>
                <div class="info">
                    <h1 class="obj-name">{{ $job->name }}</h1>
                    <div class="star">
                        <img src="http://test.gmon.com.vn/?image=star.png" alt="">
                        <img src="http://test.gmon.com.vn/?image=star.png" alt="">
                        <img src="http://test.gmon.com.vn/?image=star.png" alt="">
                        <img src="http://test.gmon.com.vn/?image=star.png" alt="">
                        <img src="http://test.gmon.com.vn/?image=star.png" alt="">
                    </div>
                    <p class="time-new-roman"><i class="master-point"></i>{{ $company->address }} </p>
                    <p class="time-new-roman"><i class="branch-point"></i>{{ $company->district }}, {{ $company->city }}</p>
                    @if(count($branches) > 0)
                        <?php $count = 0; ?>
                        <p class="time-new-roman"><i class="city-point"></i>
                        @foreach($branches as $branch)
                            <?php 
                                if($count == 0){
                                    echo $branch->city;
                                }else{
                                    echo ', ' . $branch->city;
                                }
                                $count++; 
                            ?>
                        @endforeach
                        </p>
                    @endif
                    <?php 
                        if(strlen($company->jobs) > 0){
                            $company->jobs = rtrim($company->jobs,";");
                            $jobs = explode(";",$company->jobs);
                            foreach($jobs as $joba){
                                echo '<p class="time-new-roman"><i class="job-point"></i>' . $joba . '</p>';
                            }
                        }
                    ?>
                    <p class="time-new-roman" style="display: inline-block;margin-right: 50px"><i class="size-point"></i>{{ $company->size }} người</p>
                    @if(strlen($company->sologan) > 0)
                    <p class="time-new-roman"><i class="sologan-point"></i>{{ $company->sologan }}</p>
                    @endif
                    @if(strlen($company->site_url)>0)<p class="time-new-roman"><i class="fa fa-link fa-1 icon-plus"></i><a style="word-break: break-all;" href=" {{ $company->site_url }}"> {{ $company->site_url }}</a></p>@endif
                    <div class="link time-new-roman" ><a target="_self" href="{{ url('/') }}/company/{{ $company->id }}/listjobs" class="underline">Trang tuyển dụng <i class="muiten"></i></a></div>
                </div>
            </div>
            <div class="col-md-8  col-xs-12">
                <div class="info-job">
                    <h1 class="obj-name">{{ $job->name }}</h1>
                    <p class="time-new-roman"><i class="master-point"></i><span style="margin-right: 35px">
                    {{ $company->district }}, {{ $company->city }}
                    </span>
                    <a target="_self" href="" style="color:#2a70b8;display: none;" class="underline">Xem bản đồ <i class="muiten"></i></a></p>
                    @if(strlen($job->branches) > 0)
                        <?php 
                            $job->branches = ltrim($job->branches,";");
                            $branches = explode(";",$job->branches);
                        ?>
                        @for($i = 0; $i < count($branches); $i++)
                            @if($i < 3)
                            <p class="time-new-roman"><i class="branch-point"></i>{{ $branches[$i] }} @if($i==2) <span class="show-more-btn">...</span>@endif</p>
                            @else
                            <p class="time-new-roman show-more-branch"><i class="branch-point"></i>{{ $branches[$i] }}</p>
                            @endif
                        @endfor
                    @endif
                    <p class="time-new-roman"><i class="money-point"></i>{{ $job->salary }}</p>
                    <p class="time-new-roman"><i class="time-point"></i>{{ $job->expiration_date }}</p>
                    <p class="time-new-roman"><i class="size-point"></i>{{ $job->number }} người</p>
                    <p class="time-new-roman"><i class="gender-point"></i><?php if($job->gender == 0) { echo "Không yêu cầu"; }else if($job->gender == 1) { echo "Nam"; }else{ echo "Nữ"; } ?></p>
                    <div class="bt clearfix">
                        <span target="_self" class="bt-join2 time-new-roman" href="javascript:void(0)" data-id="{{ $job->id }}">Chi tiết tuyển dụng</span> 
                        <span style="padding:0;" id="share">
                            <a target="_self" class="icon" href=""><i class="i1"></i></a>
                            <a target="_self" class="icon" href=""> <i class="i2"></i></a>
                            <a target="_self" class="icon" href=""><i class="i3"></i></a>
                            <a target="_self" class="icon" href=""><i class="i4"></i></a>
                            <a target="_self" class="icon" href=""><i class="i5"></i></a>
                            <span>Chia sẻ qua</span>
                        </span>
                    </div>
                </div>
                <div class="item">
                    <div class="title">việc bạn sẽ làm</div>
                        <div class="content"><?php echo str_replace("<p>&nbsp;</p>","",$job->description); ?></div>
                </div>
                <div class="item">
                    <div class="title">chúng tôi kỳ vọng ở bạn</div>
                        <div class="content"><?php echo str_replace("<p>&nbsp;</p>","",$job->requirement); ?></div>
                </div>
                <div class="item">
                    <div class="title">điều bạn mong muốn</div>
                        <div class="content"><?php echo str_replace("<p>&nbsp;</p>","",$job->benefit); ?></div>
                </div>
                @if(!Auth::check() || Auth::user()->hasRole('user'))
                <p style="margin-top: 20px;text-align: center;"><a id="join-btn" target="_self" href="javascript:void(0)" class="bt-join" data-id="{{ $job->id }}" @if($applied == 0)style="display:inline-block;" @else style="display:none;"@endif>Ứng tuyển ngay</a><a id="joined-btn" target="_self" href="javascript:void(0)" class="bt-joined" data-id="{{ $job->id }}" @if($applied == 0)style="display:none;" @else style="display:inline-block;"@endif>Đã ứng tuyển</a></p>
                @endif
            </div>
        </div>
        @if(false)
        <div class="related-work row">
            <p class="title"><i></i>Thêm cơ hội làm việc cho bạn</p>
            <div class="wrapper" id="wrapper">
                <div class="prev" id="btPrev"><img src="http://test.gmon.com.vn/?image=prev.png" alt=""></div>
                <div class="next"  id="btNext"><img src="http://test.gmon.com.vn/?image=next.png" alt=""></div>
                <div style="width: 100%;overflow: hidden;display: inline-block;position: relative;">
                    <div id="contents">
                        <div class="item-work" >
                            <div class="border-item">
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <div class="single"><p>Nhân viên pha chế Starbucks Coffee Nhân viên pha chế Starbucks Coffee</p></div>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item-work" >
                            <div class="border-item">
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <div class="single"><p>Nhân viên pha chế Starbucks Coffee </p></div>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item-work" >
                            <div class="border-item">
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <div class="single"><p>Nhân viên pha chế Starbucks Coffee Nhân viên pha chế Starbucks Coffee</p></div>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item-work" >
                            <div class="border-item">
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <div class="single"><p>Nhân viên pha chế Starbucks Coffee </p></div>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item-work" >
                            <div class="border-item">
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <div class="single"><p>Nhân viên pha chế Starbucks </p></div>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item-work" >
                            <div class="border-item">
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <div class="single"><p>Nhân viên pha chế Starbucks </p></div>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item-work" >
                            <div class="border-item">
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <div class="single"><p>Nhân viên pha chế Starbucks Coffee Nhân viên pha chế Starbucks Coffee</p></div>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item-work" >
                            <div class="border-item">
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <div class="single"><p>Nhân viên pha chế Starbucks Coffee Nhân viên pha chế Starbucks Coffee</p></div>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item-work" >
                            <div class="border-item">
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <div class="single"><p>Nhân viên pha chế Starbucks Coffee Nhân viên pha chế Starbucks Coffee</p></div>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item-work" >
                            <div class="border-item">
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <div class="single"><p>Nhân viên pha chế Starbucks Coffee Nhân viên pha chế Starbucks Coffee</p></div>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item-work" >
                            <div class="border-item">
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <div class="single"><p>Nhân viên pha chế Starbucks Coffee Nhân viên pha chế Starbucks Coffee</p></div>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item-work" >
                            <div class="border-item">
                                <a target="_self" href="">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image=nhatuyendung.png" alt=""></p>
                                    <div class="details">
                                        <div class="single"><p>Nhân viên pha chế Starbucks Coffee Nhân viên pha chế Starbucks Coffee</p></div>
                                        <div class="work-view">
                                            <p class="location"><i></i>Cầu Giấy, Ba Đình, Hà Nội</p>
                                            <p class="salary"><i></i>2 - 3 triệu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
	<footer>
		<div class="container">
			<div class="footer-top row">
				<div class="col-md-4 col-xs-6 footer-col">
					<p class="title">về gmon</p>
					<p><a target="_self" href="">Giới thiệu</a></p>
					<p><a target="_self" href="">Việc làm</a></p>
					<p><a target="_self" href="">Nhà tuyển dụng</a></p>
					<p><a target="_self" href="">Hồ sơ ứng viên</a></p>
					<p><a target="_self" href="">Nhà tuyển dụng</a></p>
				</div>
				<div class="col-md-3 col-xs-6 footer-col">
					<p class="title">công cụ</p>
					<p><a target="_self" href="">Hồ sơ</a></p>
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
		var url_site = $('base').attr('href');

		window.onload = function()
		{
            var x=$("#logo").outerHeight();
            var x1=$("#logo").parent().outerHeight();
            $("#logo").css("margin-top",(x1-x)/2+"px");
		    var w=screen.width;
		    var w2=$("#wrapper").outerWidth();
		    var w3;
		    if(w>1000){
		    	w3=w2/5;
		    }else if(w>800){
		    	w3=w2/4;
		    }else if(w>600){
		    	w3=w2/3;
		    }else if(w>400){
		    	w3=w2/2;
		    }else{
		    	w3=w2;
		    }
		    $(".item-work").css("width",w3+"px");
		   	var n=	w3*( $( "#contents .item-work" ).length);
		   	$( "#contents" ).css("width",n+"px");
		 	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		 		$( "#wrapper" ).addClass("mobile");
			}
			setTimeout(function(){onNext(false);});
		};

		$('.bt-join').click(function(){
	        var _sefl = $(this);
	        var job_id = $(this).attr('data-id');
	        var request = $.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: url_site + "/job/join",
	            method: "POST",
	            data: {
	                'job': job_id
	            },
	            dataType: "json"
	        });

	        request.done(function (msg) {
	            if (msg.code == 200) {
	            	$('.bt-join').off('click');
                        $('#join-btn').hide();
                        $('#joined-btn').show();
	               	swal("Thông báo", "Bạn đã ứng tuyển thành công!", "success");
	            }else if(msg.code == 401 && msg.message == "unauthen!"){
                        $('#myModal').modal('toggle');
                        onOpenLogin();
	            }else if(msg.code == 401 && msg.message == "No curriculum vitaes!"){
                        swal("Thông báo", "Bạn chưa có hồ sơ! Hãy tạo mới để ứng tuyển ngay nhé!", "error");
                         // Your application has indicated there's an error
                        window.setTimeout(function(){
                            // Move to a new location or you can do something else
                            window.location.href = url_site + "/curriculumvitae/create";
                        }, 3000);
                }
	        });

	        request.fail(function (jqXHR, textStatus) {
	            alert("Request failed: " + textStatus);
	        });
		});

		var isR=false;
		var action;
		$("#btPrev").click(function(){onPrev(true);});
		$("#btNext").click(function(){onNext(true);});
		function onNext(b){
			if(b)clearTimeout(action);
			if(isR) return;
			isR=true;
			var w=$(".item-work").outerWidth();
			 var n=parseFloat($( "#contents" ).css("margin-left"));
			 var w2=$("#contents").outerWidth();
			 var w3=$("#wrapper").outerWidth();
			 var n2=n-w;
			 if(n2+w2-w3>=0){
			 	$( "#contents" ).animate({marginLeft: n2+'px'},{duration: 300,complete:function(){isR=false;}});
			 	action=setTimeout(function(){onNext(false);},2000);
			 }
			 else{isR=false;action=setTimeout(function(){onPrev(false);},2000);}
		}
		function onPrev(b){
			if(b)clearTimeout(action);
			if(isR) return;
			isR=true;
			var w=$(".item-work").outerWidth();
			 var n=parseFloat($( "#contents" ).css("margin-left"));
			 var w2=$("#contents").outerWidth();
			 var n2=n+w;
			 if(n2<=0){
			 	$( "#contents" ).animate({marginLeft: n2+'px'},{duration: 300,complete:function(){isR=false;}});
			 	action=setTimeout(function(){onPrev(false);},2000);
			 }
			 else{isR=false;action=setTimeout(function(){onNext(false);},2000);}
		}
                
        function onCloseModalLogin(){
            $("#myModal").modal('toggle');
        }
        function onOpenRegister(){
            $("#register").addClass("in active");
            $(".header-tab-login li:nth-child(1)").removeClass("active");
            $(".header-tab-login li:nth-child(2)").addClass("active");
        }
        function onOpenLogin(){
            $("#login").addClass("in active");
            $(".header-tab-login li:nth-child(2)").removeClass("active");
            $(".header-tab-login li:nth-child(1)").addClass("active");
        }
        function onFocusCandidates(event){
            $(event.target).find(".view").animate({top: 0+'px'},300);
        }
        function onDisFocusCandidates(event){
            $(event.target).find(".view").animate({top: 200+'px'});
        }
        
        $(document).ready(function(){
            $('#login-btn').click(function(){
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
                    if(msg.code == 200) {
                        location.reload();
                   }
                });

                request.fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                });
            });

            $('#register-btn').click(function(){
                var username = $('#username').val();
                var registersdt = $('#sdt').val();
                var registerEmail = $('#register-email').val();
                var registerPassword = $('#register-password').val();
                var rPassword = $('#r_password').val();
                var role = $('#areyou').val();
                if(registerPassword != rPassword){
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
                    if(msg.code == 200) {
                        location.reload();
                   }
                });

                request.fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                });
            });
            
            $('.show-more-btn').click(function(){
                $('.show-more-branch').show();
                $(this).hide();
            });
        });
	</script>

</body>
</html>