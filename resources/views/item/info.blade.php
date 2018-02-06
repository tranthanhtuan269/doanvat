@extends('layouts.layout_master')

@section('content')
<script src="{{ url('/') }}/public/sweetalert/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/sweetalert/sweetalert.css">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=212812479241763";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<style type="text/css">
    .header-homepage{
        background: none;
        background-size: cover;
        height: 595px;
        position: relative;
        font-family: Roboto, sans-serif;
    }

    .obj-name:first-letter {
        text-transform: uppercase;
    }

    .single p:first-letter {
        text-transform: uppercase;
    }

</style>
    <div class="container" id="info-page">
        <div class="row" id="images-company">
            @if(isset($company->images) && strlen($company->images) > 0)
            <?php 
                $company->images=rtrim($company->images,";");
                $images = explode(";",$company->images);
                for($i = 0; $i < count($images); $i++){ if($i == 3) break; ?>
                    <div class="col-md-4 col-xs-12">
                        <img src="{{ url('/') }}/public/images/{{ $images[$i] }}" class="img-responsive img-thumbnail" alt="{{ url('/') }}/public/images/{{ $images[$i] }}">
                    </div>
            <?php } ?>
            @endif
        </div>

        <hr>

        <div class="row" id="info-company-job">
            <div class="col-md-4 col-xs-12">
                <div class="logo-company">
                    @if(isset($company->logo) && strlen($company->logo) > 0)
                    <a class="col-md-12 col-xs-12" target="_self" href="{{ url('/') }}/company/{{ $company->id }}/info">
                        <img src="{{ url('/') }}/public/images/{{ $company->logo }}" class="img-responsive" alt="{{ url('/') }}/public/images/{{ $company->logo }}" style="width: 100%;height: 100%;margin-left: -20px;">
                    </a>
                    @endif
                </div>
                <div class="info-company">
                    <div class="col-md-12 col-xs-12">
                        <h1 class="obj-name">{{ $company->name }}</h1>
                    </div>
                    <div class="col-md-12 col-xs-12 star-hold">
                        <img class="star-vote" src="{{ url('/') }}/public/images/star.png" alt="{{ url('/') }}/public/images/star.png">
                        <img class="star-vote" src="{{ url('/') }}/public/images/star.png" alt="{{ url('/') }}/public/images/star.png">
                        <img class="star-vote" src="{{ url('/') }}/public/images/star.png" alt="{{ url('/') }}/public/images/star.png">
                        <img class="star-vote" src="{{ url('/') }}/public/images/star.png" alt="{{ url('/') }}/public/images/star.png">
                        <img class="star-vote" src="{{ url('/') }}/public/images/star.png" alt="{{ url('/') }}/public/images/star.png">
                    </div>
                    <div class="col-md-12 col-xs-12 info-row hidden-xs">
                        <i class="fa fa-street-view"></i>{{ $company->address }}
                    </div>
                    <div class="col-md-12 col-xs-12 info-row">
                        <i class="fa fa-map-marker"></i>{{ $company->district }}, {{ $company->city }}
                    </div>
                    @if(count($branches) > 0)
                        <?php $count = 0; ?>
                        <div class="col-md-12 col-xs-12 info-row"><i class="fa fa-map"></i>
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
                        </div>
                    @endif
                    <?php 
                        if(strlen($company->jobs) > 0){
                            $company->jobs = rtrim($company->jobs,";");
                            $jobs = explode(";",$company->jobs);
                            foreach($jobs as $joba){
                                echo '<div class="col-md-12 col-xs-12 info-row"><i class="fa fa-building"></i>' . $joba . '</div>';
                            }
                        }
                    ?>
                    <div class="col-md-12 col-xs-12 info-row">
                        <i class="fa fa-users"></i>{{ $company->size }} người
                    </div>
                    @if(strlen($company->sologan) > 0)
                    <div class="col-md-12 col-xs-12 info-row">
                        <i class="fa fa-trophy"></i>{{ $company->sologan }}
                    </div>
                    @endif
                    <div class="clearfix"></div>
                    <div class="col-md-12 col-xs-12 info-row link-job">
                        <a target="_self" href="{{ url('/') }}/company/{{ $company->id }}/listjobs"><i class="fa fa-angle-double-right"></i>Trang tuyển dụng</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-xs-12 info-job">
                <div class="row simple-info">
                    <div class="col-md-12 col-xs-12 info-job-row">
                        <h1 class="obj-name">
                            {{ $job->name }}
                            @if(!Auth::check())
                                <a id="join-btn" target="_self" href="javascript:void(0)" data-toggle="modal" data-target="#loginHeader" class="btn btn-sm btn-primary bt-join" data-id="{{ $job->id }}" @if($applied == 0)style="display:inline-block;" @else style="display:none;"@endif>Ứng tuyển ngay</a><a id="joined-btn" target="_self" href="javascript:void(0)" class="btn btn-sm btn-danger bt-joined" data-id="{{ $job->id }}" @if($applied == 0)style="display:none;" @else style="display:inline-block;"@endif>Đã ứng tuyển</a>
                            @elseif(Auth::check() && Auth::user()->hasRole('user'))
                                <a id="join-btn" target="_self" href="javascript:void(0)" class="btn btn-sm btn-primary bt-join" data-id="{{ $job->id }}" @if($applied == 0)style="display:inline-block;" @else style="display:none;"@endif>Ứng tuyển ngay</a><a id="joined-btn" target="_self" href="javascript:void(0)" class="btn btn-sm btn-danger bt-joined" data-id="{{ $job->id }}" @if($applied == 0)style="display:none;" @else style="display:inline-block;"@endif>Đã ứng tuyển</a>
                            @elseif($company->id == $company_id)
                                <a href="{{ url('/') }}/job/{{ $job->id }}/editJob" class="btn btn-sm btn-primary">Sửa Việc</a>
                            @else
                            @endif
                        </h1>
                    </div>
                    <div class="col-md-12 col-xs-12 info-job-row">
                        <i class="fa fa-map-marker"></i>
                        <span style="margin-right: 35px">
                            {{ $company->district }}, {{ $company->city }}
                        </span>
                    </div>
                    @if(strlen($job->branches) > 0)
                        <?php 
                            $job->branches = ltrim($job->branches,";");
                            $branches = explode(";",$job->branches);
                        ?>
                        @for($i = 0; $i < count($branches); $i++)
                            @if($i < 3)
                            <div class="col-md-12 col-xs-12 info-job-row">
                                <i class="fa fa-street-view"></i>
                                {{ $branches[$i] }} 
                                @if($i==2) 
                                    <span class="show-more-btn">...</span>
                                @endif
                            </div>
                            @else
                            <div class="col-md-12 col-xs-12 info-job-row">
                                <i class="fa fa-street-view"></i>
                                {{ $branches[$i] }}
                            </div>
                            @endif
                        @endfor
                    @endif
                    <div class="col-md-12 col-xs-12 info-job-row">
                        <i class="fa fa-money"></i>
                        {{ $job->salary }}
                    </div>
                    <div class="col-md-12 col-xs-12 info-job-row">
                        <i class="fa fa-clock-o"></i>
                        {{ $job->expiration_date }}
                    </div>
                    <div class="col-md-12 col-xs-12 info-job-row">
                        <i class="fa fa-user"></i>
                        {{ $job->number }} người
                    </div>
                    <div class="col-md-12 col-xs-12 info-job-row">
                        <i class="fa fa-intersex"></i>
                        <?php 
                        if($job->gender == 0) { 
                            echo "Không yêu cầu"; 
                        }else if($job->gender == 1) { 
                            echo "Nam"; 
                        }else{ 
                            echo "Nữ"; 
                        } ?>
                    </div>
                    <div class="col-md-12 col-xs-12 link-social">
                        <span class="text hidden-xs hidden-sm">Chi tiết tuyển dụng</span> 
                        <span style="padding:0;" id="share">
                            <a target="_blank" class="icon" href=""><i class="i1"></i></a>
                            <a target="_blank" class="icon" href=""> <i class="i2"></i></a>
                            <a target="_blank" class="icon" href="https://twitter.com/intent/tweet?url={{ $content_share['url'] }}&text={{ $content_share['description'] }}"><i class="i3"></i></a>
                            <a target="_blank" class="icon" href="https://plus.google.com/share?url={{ $content_share['url'] }}"><i class="i4"></i></a>
                            <a target="_blank" class="icon" href="https://www.facebook.com/sharer/sharer.php?u={{ $content_share['url'] }}&display=popup"><i class="i5"></i></a>
                            <span class="hidden-xs hidden-sm">Chia sẻ qua</span>
                        </span>
                    </div>
                </div>
                <div class="row detail-info" id="description">
                    <div class="col-md-12 col-xs-12 title">
                        Việc bạn sẽ làm
                    </div>
                    <div class="col-md-12 col-xs-12 content">
                        <?php echo str_replace("<p>&nbsp;</p>","",$job->description); ?>
                    </div>
                </div>
                <div class="row detail-info" id="required">
                    <div class="col-md-12 col-xs-12 title">
                        CHÚNG TÔI KỲ VỌNG Ở BẠN
                    </div>
                    <div class="col-md-12 col-xs-12 content">
                        <?php echo str_replace("<p>&nbsp;</p>","",$job->requirement); ?>
                    </div>
                </div>
                <div class="row detail-info" id="benefit">
                    <div class="col-md-12 col-xs-12 title">
                        ĐIỀU BẠN MONG MUỐN
                    </div>
                    <div class="col-md-12 col-xs-12 content">
                        <?php echo str_replace("<p>&nbsp;</p>","",$job->benefit); ?>
                    </div>
                </div>
                @if(!Auth::check())
                <div class="row" id="join-now">
                    <div class="col-md-12 col-xs-12">
                        <a id="join-btn" target="_self" href="javascript:void(0)" data-toggle="modal" data-target="#loginHeader" class="btn btn-primary bt-join" data-id="{{ $job->id }}" @if($applied == 0)style="display:inline-block;" @else style="display:none;"@endif>Ứng tuyển ngay</a><a id="joined-btn" target="_self" href="javascript:void(0)" class="btn btn-danger bt-joined" data-id="{{ $job->id }}" @if($applied == 0)style="display:none;" @else style="display:inline-block;"@endif>Đã ứng tuyển</a>
                    </div>
                </div>
                @elseif(Auth::check() && Auth::user()->hasRole('user'))
                <div class="row" id="join-now">
                    <div class="col-md-12 col-xs-12">
                        <a id="join-btn" target="_self" href="javascript:void(0)" class="btn btn-primary bt-join" data-id="{{ $job->id }}" @if($applied == 0)style="display:inline-block;" @else style="display:none;"@endif>Ứng tuyển ngay</a><a id="joined-btn" target="_self" href="javascript:void(0)" class="btn btn-danger bt-joined" data-id="{{ $job->id }}" @if($applied == 0)style="display:none;" @else style="display:inline-block;"@endif>Đã ứng tuyển</a>
                    </div>
                </div>
                @elseif($company->id == $company_id)
                <div class="row" id="join-now">
                    <div class="col-md-12 col-xs-12">
                        <a href="{{ url('/') }}/job/{{ $job->id }}/editJob" class="btn btn-primary">Sửa Việc</a>
                    </div>
                </div>
                @else
                @endif
            </div>
        </div>
        @if(isset($job_relatives) && count($job_relatives) > 0)
        <div class="related-work row">
            <p class="title"><i></i>Thêm cơ hội làm việc cho bạn</p>
            <div class="wrapper" id="wrapper">
                <div class="prev" id="btPrev"><img src="{{ url('/') }}/public/images/prev.png" alt=""></div>
                <div class="next"  id="btNext"><img src="{{ url('/') }}/public/images/next.png" alt=""></div>
                <div style="width: 100%;overflow: hidden;display: inline-block;position: relative;">
                    <div id="contents">
                        @foreach($job_relatives as $related)
                        <div class="item-work" >
                            <div class="border-item">
                                <a target="_self" href="{{ url('/') }}/job/{{ $related->id }}/{{ $related->slug }}">
                                    <p class="work-img"><img src="{{ url('/') }}/public/images/{{ $related->logo }}" alt=""></p>
                                    <div class="details">
                                        <div class="single"><p>{{ $related->name }} tại {{ $related->companyname }}</p></div>
                                        <div class="work-view">
                                            <p class="location"><i></i>{{ $related->district }}, {{ $related->city }}</p>
                                            <p class="salary"><i></i>{{ $related->salary }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <style type="text/css">

        .related-work{margin-top: 20px;}
        .related-work p.title{font-weight: bold;color:#464646;font-size: 15px;margin-bottom: 20px}
        .related-work p.title i{background: url("../../../public/images/bg.png") -37px -38px;width: 25px;height: 25px;float: left;margin-right: 10px;margin-top: -2px;}
        .wrapper{position: relative;margin-top: 10px;width: 100%;}
        .wrapper .next img,.prev img{background: white;padding:8px 10px ;border:1px solid #c9c9c9;border-radius: 50%;height: 30px;width:30px;text-align: center;}
        .wrapper .next{float: right;margin-right: -40px;height: 190px;width: 40px;line-height: 190px;text-align: center;}
        .wrapper .prev{float: left;margin-left: -40px;height: 190px;width: 40px;line-height: 190px;text-align: center;}
        .wrapper .prev button{background-position: -60px -60px;}
        .wrapper .next img:hover,.prev img:hover{background: #c9c9c9;}
        .wrapper #contents{width: 2000px;display: inline-block;}

        .item-work{padding: 0 5px;width: 200px;float: left;}
        .item-work a{width: 100%;border:1px solid #dce7f3;margin:0;overflow: hidden;display: inline-block;border-top: none;color:black;}
        .item-work .details{position: relative;background: white;height: 68px;padding:18px 10%;border-top: 1px solid #c9c9c9;}
        .item-work .single{font-weight: bold;margin: 0;font-size: 12px;}
        .item-work .single{text-align: center;background: white;word-wrap: break-word;overflow: hidden;text-overflow: ellipsis;
        display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;}

        .item-work .work-view{background: white;position: absolute;top:-1px;left: 0;width: 100%;display: none}
        .item-work .work-view i{background-image: url("../../../public/images/bg.png");width: 20px ;height: 15px;display: inline-block;margin-bottom: -3px;margin-right: 15px}
        .item-work .work-view .location i{background-position:-20px -60px}
        .item-work .work-view .salary i{background-position:0 -60px}
        .item-work .work-view .salary,.location{font-size: 12px;height: 33px;background: #2a70b8;padding: 0px 20px;line-height: 33px;color:white;text-overflow:ellipsis;overflow: hidden;white-space: nowrap;}
        .item-work .work-view .location{margin-bottom: 2px;}

        .item-work .work-img-border{border:2px solid #2a70b8;}
        .item-work .work-img img {
            width: 70%;
            height: 70%;
            margin: 10% 0;
            position: relative;
        }

        .item-work .work-img {
            height: 120px;
            width: 100%;
            text-align: center;
            background: white;
            margin: 0px;
            border-top: 3px solid #2a70b8;
        }

        .item-work a:hover{overflow: visible;}
        .item-work a:hover .work-img{border:2px solid #2a70b8;}
        .item-work a:hover .work-view{display:inline-block;}
    </style>
    <script type="text/javascript">
        var url_site = $('base').attr('href');
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

        function onOpenLogin() {
            $("#login").addClass("in active");
            $("#register").removeClass("in active");
            $("li.register a").removeClass("active");
            $("li.login a").addClass("active");
        }
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
                        $('.bt-join').hide();
                        $('.bt-joined').show();
                    swal("Thông báo", "Bạn đã ứng tuyển thành công!", "success");
                }else if(msg.code == 401 && msg.message == "unauthen!"){
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
    </script>
@endsection