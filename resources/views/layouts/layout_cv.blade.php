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
        <script type="text/javascript" src="{{ url('/') }}/public/bower_components/moment/min/moment.min.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/public/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <link rel="stylesheet" href="{{ url('/') }}/public/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
        <script src="//cdn.ckeditor.com/4.7.1/basic/ckeditor.js"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/css/bootstrap-select.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js"></script>
        <link rel="stylesheet" href="{{ url('/') }}/public/css/style.css">
        <link rel="stylesheet" href="{{ url('/') }}/public/css/customize.css">
        <link rel="shortcut icon" href="http://test.gmon.com.vn/?image=favicon.png" type="image/x-icon">
        <link rel="icon" href="http://test.gmon.com.vn/?image=favicon.png" type="image/x-icon">
    </head>
    <body class="homepage">
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
                                        <a target="_self" href=""><i></i>Việc làm</a>
                                        <a target="_self" href=""><i></i>Nhà tuyển dụng</a>
                                    </div>
                                    <div class="login">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        @yield('content')
    </body>
</html>