@extends('layouts.layout')

@section('content')
<?php $jobstype = \App\JobType::select('id', 'name')->get(); ?>
    <header>
        <div class="header-mid">
            <div class="container" >
                <div class="clearfix row" style="padding-bottom: 30px">
                    <div class="col-md-3">
                        <a target="_self" href="" class="logo row"><img src="http://test.gmon.com.vn/?image=home.png" alt=""></a>
                    </div>
                    <div class="col-md-9" style="margin-top: 30px">
                        <div class="">
                            <div class="col-md-9">
                                <form class="search">
                                    <select class="col-md-4" id="job-select">
                                        <option value="0">Chọn ngành nghề</option>
                                        @foreach($jobstype as $jobtype)
                                        <option value="{{ $jobtype->id }}">{{ $jobtype->name }}</option>
                                        @endforeach
                                    </select>
                                    <select id="tinh-select" class="col-md-3">
                                        <option value="0">Thành phố</option>
                                        <option value="1">Hà Nội</option>
                                        <option value="2">Hồ Chí Minh</option>
                                        <option value="3">Đà Nẵng</option>
                                        <option value="4">Hải Phòng</option>
                                    </select>
                                    <select id="quanhuyen-select" class="col-md-3">
                                        <option value="0">Quận/Huyện</option>
                                    </select>
                                    <button class="submit hidden-xs search-btn"><i></i></button>
                                    <button class="submit visible-xs search-btn" style="width: auto;border:1px solid #EBEAEA;padding:5px 7px;height: auto;margin:auto;margin-top: 10px;background-color: #F5F5F5;color:#A8A8A8;border-radius: 4px">Tìm kiếm</button>
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
                        <a target="_self" href="http://spa.gmon.com.vn"><i></i>Spa</a>
                        <a target="_self" href="{{ url('/') }}/home?field=1"><i></i>Khách sạn</a>
                        <a target="_self" href="{{ url('/') }}/home?field=2"><i></i>Nhà hàng</a>
                        <a target="_self" href="{{ url('/') }}/home?field=4"><i></i>Doanh nghiệp</a>
                        <a target="_self" href="{{ url('/') }}/home?field=5"><i></i>Nhân sự tài năng</a>
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
    <div class="container ads">
        <div class="row">
            <div class="col-md-9 col-xs-12">
                <div class="banner row">
                    <a width="50%" target="_self" href="http://gmon.vn/company/323/info"><img src="http://test.gmon.com.vn/?image=Banner-Web-Gmon-11.jpg" alt=""></a><a width="50%" target="_self" href="http://gmon.vn/company/278/info"><img src="http://test.gmon.com.vn/?image=Banner-Web-Gmon-12.jpg" alt=""></a>
                </div>
                <div class="row news">
                    <div class="col-md-6" style="margin-right: -1px">
                        <div class="top row">
                            <div class="col-md-4 col-xs-4"><a target="_self" href="{{ url('/') }}/home?city=1" @if($city == 1) class="active" @endif>Hà Nội</a></div>
                            <div class="col-md-4 col-xs-4"><a target="_self" href="{{ url('/') }}/home?city=3" @if($city == 3) class="active" @endif>Đà Nẵng</a></div>
                            <div class="col-md-4 col-xs-4"><a target="_self" href="{{ url('/') }}/home?city=2" @if($city == 2) class="active" @endif>TP.HCM</a></div>
                        </div>
                        <div class="row title">
                            Tìm kiếm việc làm theo các quận
                        </div>
                        <div class="row contentsLeft" id="list-districts">
                            @foreach($districts as $district)
                                <a target="_self" href="{{ url('/') }}/showmore?district={{ $district->id }}">{{ $district->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6 " >
                        <div class="row top">
                            <span>VIỆC LÀM HẲNG NGÀY</span> 
                        </div>
                        <div class="row title">
                            Tìm kiếm việc làm hằng ngày
                        </div>
                        <div class="contentsRight">
                            <div class="row">
                                <div class="col-md-3 col-xs-3">
                                    <p>Hôm nay</p>
                                </div>
                                <div class="col-md-3 col-xs-3">
                                </div>
                                <div class="col-md-3 col-xs-3">
                                </div>
                                <div class="col-md-3 col-xs-3">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-xs-3">
                                    <div class="point"><a target="_self"  class="active"></a><hr class="right"></div>
                                </div>
                                <div class="col-md-3 col-xs-3">
                                    <div class="point"><a target="_self"  class=""></a><hr></div>
                                </div>
                                <div class="col-md-3 col-xs-3">
                                    <div class="point"><a target="_self"  class=""></a><hr></div>
                                </div>
                                <div class="col-md-3 col-xs-3">
                                    <div class="point"><a target="_self" class=""></a><hr class="left"></div>
                                </div>
                            </div>
                            <?php 
                                $this_day = date('Y-m-d H:i:s');
                                $today = date('d/m');
                                $tomorow = date("d/m", strtotime($this_day . ' +1 day'));
                                $tomorow1 = date("d/m", strtotime($this_day . ' +2 day'));
                                $tomorow2 = date("d/m", strtotime($this_day . ' +3 day'));
                            ?>
                            <div class="row">
                                <div class="col-md-3 col-xs-3">
                                    <p>{{ $today }}</p>
                                    <p>{{ $jobcount0 + 200 }} jobs</p>
                                </div>
                                <div class="col-md-3 col-xs-3">
                                    <p>{{ $tomorow }}</p>
                                    <p>{{ $jobcount1 + 200 }} jobs</p>
                                </div>
                                <div class="col-md-3 col-xs-3">
                                    <p>{{ $tomorow1 }}</p>
                                    <p>{{ $jobcount2 + 200 }} jobs</p>
                                </div>
                                <div class="col-md-3 col-xs-3">
                                    <p>{{ $tomorow2 }}</p>
                                    <p>{{ $jobcount3 + 200 }} jobs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-12">
                <div class="ads-top"><a target="_self" href=""><img src="http://test.gmon.com.vn/?image=ads.png" alt=""></a></div>
                <div class="ads-bot">
                    <a target="_self" href="http://gmon.vn/company/27/info"><img src="http://test.gmon.com.vn/?image=Banner-Web-Gmon-13.gif" alt=""></a>
                </div>
            </div>
        </div>
    </div>
    <div class="list-logo clearfix">
        <div class="container" style="position: relative;">
            <span id="btPrev" class="btPrev"></span>
            <span id="btNext" class="btNext"></span>
            <div class="wrapper row" id="wrapper-logo">
                <div class="contents clearfix" id="contents-logo">
                    <ul>
                        <?php $i = 0;?>
                        @foreach($companies as $company)
                        <?php if($i == 0){?>
                        <li class="item-logo"><a target="_self" href="{{ url('/') }}/company/{{ $company->id }}/info"><img src="http://test.gmon.com.vn/?image={{ $company->logo }}" alt=""></a></li>
                        <?php 
                        $i++;
                        }else{ ?>
                        <li><a target="_self" href="{{ url('/') }}/company/{{ $company->id }}/info"><img src="http://test.gmon.com.vn/?image={{ $company->logo }}" alt=""></a></li>
                        <?php 
                        $i++;
                        } 
                        ?>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container list-info">
        @if(count($cvs) > 0)
        <div class="vip-candidates row">
            <div class="title clearfix"><span>Ứng viên VIP <i class="hot"></i></span><a target="_self" href="{{ url('/') }}/showmore?cv=vip">Xem thêm ứng viên VIP <i></i></a></div>
            <div class="clearfix wrapper" id="wrapper-candidates">
                @foreach($cvs as $cv)
                <div class="item-u" >
                    <a target="_self" href="{{ url('/') }}/curriculumvitae/view/{{ $cv->id }}" onmouseenter="onFocusCandidates(event)" onmouseleave ="onDisFocusCandidates(event)">
                        @if(strlen($cv->avatar) > 0)
                        <div class="img"><img src="http://test.gmon.com.vn/?image={{ $cv->avatar }}" alt=""></div>
                        @else
                        <div class="img"><img src="http://test.gmon.com.vn/?image=avatar.png" alt=""></div>
                        @endif
                        <p class="name text-center">{{ $cv->username }}</p>
                        <p class="university text-center">{{ $cv->school }}</p>
                        <div class="view">
                            <div class="info">
                                <div class="sub-img"><div class="border">
                                        @if(strlen($cv->avatar) > 0)
                                        <img src="http://test.gmon.com.vn/?image={{ $cv->avatar }}" alt="">
                                        @else
                                        <img src="http://test.gmon.com.vn/?image=avatar.png" alt="">
                                        @endif
                                    </div></div>
                                <p>{{ $cv->username }}</p>
                                <p>{{ $cv->birthday }}</p>
                                <!-- <p>CLB AIESEC Hà Nội</p> -->
                            </div>
                            <div class="link">
                                Xem hồ sơ của tôi &rsaquo;
                            </div>
                        </div>
                    </a>
                </div>  
                @endforeach
            </div>
        </div>
        @endif
        @if(count($jobsvip1) > 0)
        <div class="hot-jobs row">
            <div class="title clearfix"><span>Việc làm HOT <i class="hot"></i></span><a target="_self" href="{{ url('/') }}/showmore?job=vip1">Xem thêm việc làm HOT <i></i></a></div>
            <div class="wrapper" id="wrapper4">
                <div style="width: 100%;overflow: visible;display: inline-block;position: relative;">
                    <div class="contents">
                        @foreach($jobsvip1 as $job)
                        <div class="item-work" >
                            <div class="border-item">
                                <a target="_self" href="{{ url('/') }}/job/view/{{ $job->id }}">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image={{ $job->logo }}" alt=""></p>
                                    <div class="details">
                                        <div class="single"><p>{{ $job->name }} tại {{ $job->companyname }}</p></div>
                                        <div class="work-view">
                                            <p class="location"><i></i>{{ $job->district }}, {{ $job->city }}</p>
                                            <p class="salary"><i></i>{{ $job->salary }}</p>
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
        @if(count($jobsvip2) > 0)
        <div class="need-jobs row">
            <div class="title clearfix"><span>Đang tuyển GẤP <i></i></span><a target="_self" href="{{ url('/') }}/showmore?job=vip2">Xem thêm việc làm GẤP <i></i></a></div>
            <div class="wrapper" id="wrapper3">
                <div style="width: 100%;overflow: visible;display: inline-block;position: relative;">
                    <div class="contents">
                    @foreach($jobsvip2 as $job)
                        <div class="item-work" >
                            <div class="border-item">
                                <a target="_self" href="{{ url('/') }}/job/view/{{ $job->id }}">
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image={{ $job->logo }}" alt=""></p>
                                    <div class="details">
                                        <div class="single"><p>{{ $job->name }} tại {{ $job->companyname }}</p></div>
                                        <div class="work-view">
                                            <p class="location"><i></i>{{ $job->district }}, {{ $job->city }}</p>
                                            <p class="salary"><i></i>{{ $job->salary }}</p>
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
        @if(count($jobs) > 0)
        <div class="new-jobs row">
            <div class="title clearfix"><span>Việc làm mới <i></i></span><a target="_self" href="{{ url('/') }}/showmore?job=new">Xem thêm việc làm MỚI <i></i></a></div>
            <div class="wrapper" id="wrapper">
                <div class="prev" id="btPrevNewJobs"><img src="http://test.gmon.com.vn/?image=prev.png" alt=""></div>
                <div class="next"  id="btNextNewJobs"><img src="http://test.gmon.com.vn/?image=next.png" alt=""></div>
                <div style="width: 100%;overflow: hidden;display: inline-block;position: relative;">
                    <div class="contents" id="contents-jobs">
                        @foreach($jobs as $job)
                        <div class="item-work" >
                            <div class="border-item">
                                <a target="_self" href="{{ url('/') }}/job/view/{{ $job->id }}">
                                    <span class="icon-new"><img src="http://test.gmon.com.vn/?image=icon-new.png" alt=""></span>
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image={{ $job->logo }}" alt=""></p>
                                    <div class="details">
                                        <div class="single"><p>{{ $job->name }} tại {{ $job->companyname }}</p></div>
                                        <div class="work-view">
                                            <p class="location"><i></i>{{ $job->district }}, {{ $job->city }}</p>
                                            <p class="salary"><i></i>{{ $job->salary }}</p>
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
        @if(count($companies) > 0)
        <div class="new-employer row">
            <div class="title clearfix"><span>Nhà tuyển dụng mới <i></i></span><a target="_self" href="{{ url('/') }}/showmore?company=new">Xem thêm nhà tuyển dụng MỚI <i></i></a></div>
            <div class="wrapper" id="wrapper2">
                <div class="prev" id="btPrevNewEmployer"><img src="http://test.gmon.com.vn/?image=prev.png" alt=""></div>
                <div class="next"  id="btNextNewEmployer"><img src="http://test.gmon.com.vn/?image=next.png" alt=""></div>
                <div style="width: 100%;overflow: hidden;display: inline-block;position: relative;">
                    <div class="contents" id="contents-employer">
                        @foreach($companies as $company)
                        <div class="item-work" >
                            <div class="border-item">
                                <a target="_self" href="{{ url('/') }}/company/{{ $company->id }}/info">
                                    <span class="icon-new"><img src="http://test.gmon.com.vn/?image=icon-new.png" alt=""></span>
                                    <p class="work-img"><img  src="http://test.gmon.com.vn/?image={{ $company->logo }}" alt=""></p>
                                    <div class="details">
                                        <div class="single"><p>{{ $company->name }}</p></div>
                                        <div class="work-view">
                                            <p>Xem thêm &rsaquo;&rsaquo;</p>
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
    <div class="container list-number">
        <div class="row">
            <div class="col-md-3 col-xs-6">
                <div class="col-md-5 col-xs-5">
                    <i></i>
                </div>
                <div class="col-md-7 col-xs-7">
                    <div class="row info">
                        <p class="text">Hồ sơ ứng viên</p>
                        <p class="number">{{ $cvcount + 5000 }} <a target="_self" href="">&rsaquo;</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="col-md-5 col-xs-5">
                    <i></i>
                </div>
                <div class="col-md-7 col-xs-7">
                    <div class="row info">
                        <p class="text">Freelance</p>
                        <p class="number">1126 <a target="_self" href="">&rsaquo;</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="col-md-5 col-xs-5">
                    <i></i>
                </div>
                <div class="col-md-7 col-xs-7">
                    <div class="row info">
                        <p class="text">Tài năng</p>
                        <p class="number">1452 <a target="_self" href="">&rsaquo;</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="col-md-5 col-xs-5">
                    <i></i>
                </div>
                <div class="col-md-7 col-xs-7">
                    <div class="row info">
                        <p class="text">Tài năng đại học</p>
                        <p class="number">2332 <a target="_self" href="">&rsaquo;</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        window.onresize = function(event){
            resetSlide();
        }
        window.onload =function(){resetSlide();}
        function resetSlide()
        {
            clearTimeout(listLogo.action);
            clearTimeout(listNewEmployer.action);
            clearTimeout(listNewJobs.action);
            $( "#"+listLogo.contents ).css("margin-left","0");
            $( "#"+listNewEmployer.contents ).css("margin-left","0");
            $( "#"+listNewJobs.contents ).css("margin-left","0");
            var w=screen.width;
            var w2=$(".new-jobs #wrapper").outerWidth();
            if(w2 == 0 || w2 == undefined){
                w2 = $(".new-employer #wrapper2").outerWidth();
            }
            var w3;
            if(w>1000){
                w3=w2/5;
                $(".need-jobs .wrapper" ).css("width",w3*5+"px");
                $(".need-jobs .title" ).css("width",w3*5+"px");
//                $("#col-ads").css("width",w3+"px");
            }else if(w>800){
                w3=w2/4;
                $(".need-jobs .wrapper" ).css("width",w3*4+"px");
                $(".need-jobs .title" ).css("width",w3*4+"px");
//                $("#col-ads").css("width",w3+"px");
            }else if(w>600){
                w3=w2/3;
                $(".need-jobs .wrapper" ).css("width",w3*3+"px");
                $(".need-jobs .title" ).css("width",w3*3+"px");
//                $("#col-ads").css("width",w3+"px");
            }else if(w>400){
                w3=w2/2;
            }else{
                w3=w2;
            }
            $(".item-work").css("width",w3+"px");
            $(".new-jobs .contents" ).css("width",w3*( $( "#contents-jobs .item-work" ).length)+"px");
            $(".new-employer .contents" ).css("width",w3*( $( "#contents-employer .item-work" ).length)+"px");
            $(".vip-candidates .item-u" ).css("width",w3+"px");
           
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                $(".new-jobs #wrapper" ).addClass("mobile");
                $(".new-employer .next").css("margin-right","0px");
                $(".new-employer .prev").css("margin-left","0px");
            }

            w2=$("#wrapper-logo").outerWidth();
            if(w>1000){
                w3=w2/13;
            }else if(w>800){
                w3=w2/10;
            }else if(w>600){
                w3=w2/8;
            }else if(w>400){
                w3=w2/5;
            }else{
                w3=w2/4;
            }
            $("#wrapper-logo li").css("width",w3+"px");
            $("#wrapper-logo li").css("height",w3+"px");
            $("#contents-logo").css("width",w3*($( "#wrapper-logo li" ).length)+"px");
            $("#wrapper-logo").parent().children("span").css("top",w3/2+"px");

            setTimeout(function(){onNext(true,listLogo)},2000);
            setTimeout(function(){onPrev(true,listNewEmployer)},3000);
            setTimeout(function(){onNext(true,listNewJobs)},4000);
        };
        var listLogo={
            isRun:false,
            wrapper:"wrapper-logo",
            contents:"contents-logo",
            item:"item-logo",
            action:""
        }
        var listNewEmployer={
            isRun:false,
            wrapper:"wrapper2",
            contents:"contents-employer",
            item:"item-work",
            action:""
        }
        var listNewJobs={
            isRun:false,
            wrapper:"wrapper",
            contents:"contents-jobs",
            item:"item-work",
            action:""
        }
        $("#btPrev").click(function(){onPrev(true,listLogo);});
        $("#btNext").click(function(){onNext(true,listLogo);});
        $("#btPrevNewJobs").click(function(){onPrev(true,listNewJobs);});
        $("#btNextNewJobs").click(function(){onNext(true,listNewJobs);});
        $("#btPrevNewEmployer").click(function(){onPrev(true,listNewEmployer);});
        $("#btNextNewEmployer").click(function(){onNext(true,listNewEmployer);});
        function onNext(b,ob){
            if(ob.isRun) return;
            if(b)clearTimeout(ob.action);
            ob.isRun=true;
            var w=$("#"+ob.contents +" ."+ob.item).outerWidth();
             var n=parseFloat($( "#"+ob.contents ).css("margin-left"));
             var w2=$( "#"+ob.contents ).outerWidth();
             var w3=$( "#"+ob.wrapper ).outerWidth();
             var n2=n-w;
             if(n2+w2-w3>=0){
                $( "#"+ob.contents ).animate({marginLeft: n2+'px'},{duration: 300,complete:function(){ob.isRun=false;}});
                ob.action=setTimeout(function(){onNext(false,ob);},2000);
             }
             else{ob.isRun=false;ob.action=setTimeout(function(){onPrev(false,ob);},2000);}
        }
        function onPrev(b,ob){
            if(ob.isRun) return;
            if(b)clearTimeout(ob.action);
            ob.isRun=true;
             var w=$("#"+ob.contents +" ."+ob.item).outerWidth();
             var n=parseFloat($( "#"+ob.contents ).css("margin-left"));
             var n2=n+w;
             if(n2<=0){
                $( "#"+ob.contents ).animate({marginLeft: n2+'px'},{duration: 300,complete:function(){ob.isRun=false;}});
                ob.action=setTimeout(function(){onPrev(false,ob);},2000);
             }
             else{ob.isRun=false;ob.action=setTimeout(function(){onNext(b,ob);},2000);}
        }

        $(document).ready(function(){
            var site_url = $('base').attr('href');
            $('.search-btn').click(function(){
                var new_link = site_url + '/showmore?';
                var job_selected = $('#job-select').val();
                var city_selected = $('#tinh-select').val();
                var district_selected = $('#quanhuyen-select').val();
                if(job_selected > 0){
                    new_link = new_link + 'job_type=' + job_selected;
                    if(district_selected > 0){
                        new_link += '&district=' + district_selected;
                    }else{
                        if(city_selected > 0){
                            new_link += '&city=' + city_selected;
                        }
                    }
                }else{
                    if(district_selected > 0){
                        new_link += 'district=' + district_selected;
                    }else{
                        if(city_selected > 0){
                            new_link += 'city=' + city_selected;
                        }
                    }
                }
                window.location.replace(new_link);
                return false;
            });

            $("#tinh-select").change(function () {
                var citId = $("#tinh-select").val();
                var request = $.ajax({
                    url: "{{ URL::to('/') }}/getDistrict/" + citId,
                    method: "GET",
                    dataType: "html"
                });

                request.done(function (msg) {
                    $("#quanhuyen-select").html(msg);
                });

                request.fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                });
            });
        });
    </script>
@endsection