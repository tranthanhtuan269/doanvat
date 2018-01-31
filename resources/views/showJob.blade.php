@extends('layouts.layout')

@section('content')
<?php $jobstype = \App\JobType::select('id', 'name')->get(); ?>


    <style type="text/css">
        .mass-content{
            width: 100%;
            height: 100%;
            position: fixed;
            background-color:rgba(0, 0, 0, 0.5);
            z-index: 1;
            display: none;
        }
        .loader {
            z-index: 10000;
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-bottom: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 1s linear infinite;
            position: absolute;
            top: 50%;
            left: 45%;
            display: none;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
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
    <div class="container ads showmore-page">
        <div class="row">
            <div class="col-md-9 col-xs-12">
                <div class="my_row wp_breadcum">
                    <div class="breadcum f-left">
                        <a href="{{ url('/') }}"><i class="fa fa-home color-breadcum"></i></a>
                        <a href="{{ url('/') }}/showmore?job=new" class="color-breadcum">/&nbsp;Việc làm mới</a>
                    </div>
                    <div class="f-right">
                        <span class="red-color">{{ $jobcount[0]->number_job }}</span><span>&nbsp;việc làm</span>
                    </div>
                </div>
                    <ul class="ul-content">
                    @foreach($jobs as $job)
                    <li class="list-item">
                        <div class="img-item">
                            <a href="{{ url('/') }}/job/view/{{ $job->id }}">
                                <span class="wp-avatar">
                                    
                                        <img src="http://test.gmon.com.vn/?image={{ $job->logo }}" alt="">
                                    
                                </span>
                            </a>
                        </div>

                        <div class="content-item">
                            <a href="{{ url('/') }}/job/view/{{ $job->id }}"><h4>{{ $job->name }}</h4></a>
                            <p>
                                <span>Mức lương: </span><span class="grey-color">{{ $job->salary }}</span>
                            </p>
                            <p>
                                <div class="title-list">
                                    <span>Số lượng: </span><span class="grey-color">{{ $job->number }}</span>
                                </div>
                                <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i><span class="grey-color">{{ $job->district }}, {{ $job->city }}</span></a>
                            </p>
                            <p>
                                <div class="title-list">
                                    <span>Nhận hồ sơ đến hết:</span>
                                </div>
                                <a href="#"><i class="fa fa-clock-o"></i><span class="grey-color">{{ $job->expiration_date }}</span></a>
                            </p>
                        </div>
                        <div class="last-item">
                            <span class="profile_num grey1-color">Lượt xem: <i class="fa fa-eye"></i><span class="grey-color">{{ $job->views }}</span></span>
                            <span class="grey1-color">Hồ sơ ứng tuyển: <span class="grey-color">{{ $job->applied }}</span></span>
                        </div>
                        <div class="new-bg">
                                Mới
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3 col-xs-12 no_padding_right">
                <div class="content_hot">
                    <h4>VIỆC LÀM HOT</h4>
                    <ul>
                        @foreach($jobsvip as $jobvip)
                        <li>
                            <a href="{{ url('/') }}/job/view/{{ $job->id }}">
                            <span class="wp-avatar-mini">
                                <img src="http://test.gmon.com.vn/?image={{ $jobvip->logo }}" alt="">
                            </span>
                            <p class="title-content-right">{{ $jobvip->name }} tại {{ $jobvip->companyname }}</p>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="ads">
                    <div class="ads-top"><a href=""><img src="{{ url('/') }}/public/images/ads.png" alt=""></a></div>
                    <div class="ads-bot">
                        <a href="http://gmon.vn/company/27/info"><img src="http://test.gmon.com.vn/?image=Banner-Web-Gmon-13.gif" alt=""></a>
                    </div>
                </div>
                <div class="content_hot info">
                    <h4>Bạn nên biết!?</h4>
                    <ul>
                        @foreach($news as $new)
                        <li>
                            <a href="http://news.gmon.vn/?post={{ $new->id }}">
                            <span class="wp-avatar-mini">
                                    <img src="http://test.gmon.com.vn/?image={{ $new->image }}" alt="">
                            </span>
                            <p class="title-content-right">{{ $new->title }}</p>
                            </a>
                        </li>
                        @endforeach
                    </ul>
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
                    <?php 
                        $count = 0; 
                        foreach($companies as $company){
                            if($count == 0){
                            ?>
                        <li class="item-logo"><a href=""><img src="http://test.gmon.com.vn/?image={{ $company->logo }}" alt=""></a></li>
                        <?php
                            }else{
                            ?>
                        <li><a href="{{ url('/') }}/company/{{ $company->id }}/info"><img src="http://test.gmon.com.vn/?image={{ $company->logo }}" alt=""></a></li>
                        <?php 
                            }
                            $count++;
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php
        parse_url(url('/') . $_SERVER['REQUEST_URI'], PHP_URL_QUERY);
    ?>

    <script type="text/javascript">
        var site_url = $('base').attr('href');
        var $currentJob = 15;
        var $currentPossion = 0;
        var $newPossion = 0;
        $(window).scroll(function (event) {
            var scroll = $(window).scrollTop();
            $newPossion = scroll;
            if($newPossion - $currentPossion > 680){
                $currentPossion = $newPossion;
                $('.mass-content').show();
                $('.loader').show();
                var request = $.ajax({
                    url: "{{ URL::to('/') }}/getJob/?start=" + $currentJob + "&<?php echo parse_url(url('/') . $_SERVER['REQUEST_URI'], PHP_URL_QUERY); ?>",
                    method: "GET",
                    dataType: "json"
                });

                request.done(function (msg) {
                    $('.mass-content').hide();
                    $('.loader').hide();
                    if(msg['code'] == 200){
                        var $html = '';
                        $(msg['jobs']).each(function( index ) {
                            $html += '<li class="list-item">';
                                $html += '<div class="img-item">';
                                    $html += '<a href="' + site_url + '/job/view/'+ $(this)[0].id +'">';
                                        $html += '<span class="wp-avatar">';
                                                $html += '<img src="http://test.gmon.com.vn/?image='+ $(this)[0].logo +'" alt="">';
                                        $html += '</span>';
                                   $html += '</a>';
                                $html += '</div>';

                                $html += '<div class="content-item">';
                                    $html += '<a href="' + site_url + '/job/view/'+ $(this)[0].id +'"><h4>'+ $(this)[0].name +'</h4></a>';
                                    $html += '<p>';
                                        $html += '<span>Mức lương: </span><span class="grey-color">'+ $(this)[0].salary +'</span>';
                                    $html += '</p>';
                                    $html += '<p>';
                                        $html += '</p><div class="title-list">';
                                            $html += '<span>Số lượng: </span><span class="grey-color">'+ $(this)[0].number +'</span>';
                                        $html += '</div>';
                                        $html += '<a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i><span class="grey-color">'+ $(this)[0].district +', '+ $(this)[0].city +'</span></a>';
                                    $html += '<p></p>';
                                    $html += '<p>';
                                        $html += '</p><div class="title-list">';
                                            $html += '<span>Nhận hồ sơ đến hết:</span>';
                                        $html += '</div>';
                                        $html += '<a href="#"><i class="fa fa-clock-o"></i><span class="grey-color">'+ $(this)[0].expiration_date +'</span></a>';
                                    $html += '<p></p>';
                                $html += '</div>';
                                $html += '<div class="last-item">';
                                    $html += '<span class="profile_num grey1-color">Lượt xem: <i class="fa fa-eye"></i><span class="grey-color">'+ $(this)[0].views +'</span></span>';
                                    $html += '<span class="grey1-color">Hồ sơ ứng tuyển: <span class="grey-color">'+ $(this)[0].applied +'</span></span>';
                                $html += '</div>';
                                $html += '<div class="new-bg">';
                                        $html += 'Mới';
                                $html += '</div>';
                            $html += '</li>';
                        });
                        $currentJob += 5;
                        $('.ul-content').append($html);
                    }
                });

                request.fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                });
            }
        });
        window.onresize = function(event){
            resetSlide();
        }
        window.onload =function(){resetSlide();}
        function resetSlide()
        {
            clearTimeout(listLogo.action);
            $( "#"+listLogo.contents ).css("margin-left","0");
            var w=screen.width;

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
        };
        var listLogo={
            isRun:false,
            wrapper:"wrapper-logo",
            contents:"contents-logo",
            item:"item-logo",
            action:""
        }
        $("#btPrev").click(function(){onPrev(true,listLogo);});
        $("#btNext").click(function(){onNext(true,listLogo);});
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
            $('.item-job').show();
            $('.job-list-0').show();
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