@extends('layouts.layout_company')

@section('content')
<div class="container info-page">
    <div class="main-menu row">
        <input type="hidden" id="shop_id" value="{{ $shop->id }}">
        <div class="slide"><img src="{{ url('/') }}/public/images/{{ $shop->banner }}" width="100%" height="auto" alt=""><img class="img-thumbnail logo" src="{{ url('/') }}/public/images/{{ $shop->logo }}" alt="" width="250" height="250"></div>
        <div class="menu">
            <a target="_self" href="{{ url('/') }}/shop/{{ $shop->id }}/info" class="active"dụng>Thông Tin</a>
            <a target="_self" href="{{ url('/') }}/shop/{{ $shop->id }}/listitems">Tuyển Dụng</a>
            @if($shop_id != $shop->id)
            <button type="button" class="btn btn-primary" id="follow-btn" @if($followed) style="display: none;" @else style="display: block;" @endif><i></i>Theo dõi</button>
            <button type="button" class="btn btn-danger" id="unfollow-btn" @if($followed) style="display: block;" @else style="display: none;" @endif><i></i>Bỏ theo dõi</button>
            @endif
        </div>
    </div>
    <div class="main-content row">
        <div class="col-left col-md-9 col-xs-12">
            <div class="row">
                <div class="hot-new">
                    @if(Auth::user())
                        @if($shop->user == Auth::user()->id)
                            <button id="create_job_btn" class="bt-rate btn btn-primary"><i></i>Tạo tuyển dụng</button>
                        @endif
                    @endif
                </div>
            </div>

            <div class="pn-left pn-hightlight row info-shop">
                <h5>VỀ CHÚNG TÔI</h5>
                <div class="col-md-4 col-xs-12">
                    <img src="{{ url('/') }}/public/images/{{ $shop->logo }}">
                </div>
                <div class="col-md-8 col-xs-12 border-blue">
                    <p class="row"><h1 class="obj-name">{{ $shop->name }}</h1></p>
                    <p class="row"><i></i>{{ $shop->address }}, {{ $shop->city }}</p>
                    <p class="row"><i></i>{{ $shop->district }}, {{ $shop->city }}</p>
                    @if(strlen($shop->sologan)>0)<p class="row"><i></i>{{ $shop->sologan }}</p>@endif
                    @if(strlen($shop->site_url)>0)<p class="row"><i class="fa fa-link fa-1 icon-plus"></i><a href="{{ $shop->site_url }}">{{ $shop->site_url }}</a></p>@endif
                </div>
                <div class="col-md-12 col-xs-12" style="margin-top: 15px;">
                    <div class="row"><div class="col-md-12 col-xs-12"><?php echo $shop->description; ?></div></div>
                </div>
            </div>
            <?php 
                if(strlen($shop->images)>0){
                    ?>
            <div class="pn-left pn-hightlight row">
                <h5>NƠI BẠN SẼ LÀM VIỆC</h5>
                <div class="col-md-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="wrapper-big" id="wrapper-big">
                                <div class="prev" id="btPrev-big"><img src="{{ url('/') }}/public/images/prev.png" alt=""></div>
                                <div class="next"  id="btNext-big"><img src="{{ url('/') }}/public/images/next.png" alt=""></div>
                                <div style="width: 100%;overflow: hidden;display: inline-block;position: relative;">
                                    <div id="contents-big">
                                        <?php 
                                            
                                            $imageString=rtrim($shop->images,";");
                                            $images = explode(";",$imageString);
                                            foreach ($images as $image) {
                                        ?>
                                        <div class="item-work-big" >
                                            <p class="work-img"><img  src="{{ url('/') }}/public/images/{{ $image }}" alt="" height="435"></p>
                                        </div>
                                        <?php 
                                            }
                                            ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php } ?>

            <?php 
                if(strlen($shop->youtube_link)>0){
                    ?>
            <div class="pn-left pn-hightlight row">
                <h5>VIDEO VỀ CHÚNG TÔI</h5>
                <div class="col-md-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-xs-12" style="text-align: center">
                            <iframe width="560" height="315" src="{{ str_replace('watch?v=','embed/',$shop->youtube_link) }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="pn-left pn-hightlight row">
                <h5>Thực đơn quán chúng tôi</h5>
                <div class="col-md-12 col-xs-12">
                    @foreach($items as $item)
                    <div class="row item-holder">
                        <div class="col-md-3 col-xs-3">
                            <img src="{{ url('/') }}/public/images/{{ $item->image }}">
                        </div>
                        <div class="col-md-9 col-xs-9">
                            
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="pn-left pn-hightlight row">
                <h5>Thêm ý kiến của bạn về chúng tôi</h5>
                <div class="col-md-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <textarea class="form-control" rows="5" id="commenttxt"></textarea>
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <div class="btn btn-primary pull-right submit-comment">Gửi nhận xét</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pn-left pn-hightlight row">
                <h5>Mọi người nói về chúng tôi</h5>
                @foreach($comments as $comment)
                <p class="content">
                    <span><b style="color:#365899; margin: 10px 10px 10px 0;">{{ $comment->username }}</b>{{ $comment->comment }}</span>
                    <i class="pull-right comment-time">
                        <?php 
                            $datetime = new \DateTime($comment->created_at);
                            echo $datetime->format('H:i:s d-m-Y'); 
                            ?>
                    </i>
                    <span class="clearfix"></span>
                </p>
                @endforeach
            </div>
        </div>
        <div class="col-md-3 col-right col-xs-12">
            <div class="pn-hightlight pn-left row">
                <h5>ĐỊA CHỈ</h5>
                <div id="map"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.submit-comment').click(function () {
            var description = $('#inputDescription').val();
            var comment = $('#commenttxt').val();
            var request = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('/') }}/send-comment",
                method: "POST",
                data: {
                    'shop': $('#shop_id').val(),
                    'comment': comment
                },
                dataType: "json"
            });

            request.done(function (msg) {
                console.log(msg);
                if (msg.code == 200) {
                    swal({ 
                        title   : "Thông báo", 
                        text    : "Thêm đánh giá thành công!", 
                        type    : "success"
                    }, function (){
                        location.reload();
                    });
                } else if(msg.code == 404 && msg.message == "unauthen"){
                    swal("Cảnh báo", "Bạn phải đăng nhập để có thể sử dụng chức năng này!", "error");
                }else{
                    swal("Cảnh báo", msg.message, "error");
                }
            });

            request.fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        });
    });
</script>
@endsection