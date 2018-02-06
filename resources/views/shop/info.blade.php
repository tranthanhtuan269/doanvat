@extends('layouts.layout_shop')

@section('content')
<div class="container info-page">
    <div class="main-menu row">
        <input type="hidden" id="shop_id" value="{{ $shop->id }}">
        <div class="slide"><img src="{{ url('/') }}/public/images/{{ $shop->banner }}" width="100%" height="auto" alt=""><img class="img-thumbnail logo" src="{{ url('/') }}/public/images/{{ $shop->logo }}" alt="" width="250" height="250"></div>
        <div class="menu">
            @if($shop_id != $shop->id)
            <button type="button" class="btn btn-primary" id="follow-btn" @if($followed) style="display: none;" @else style="display: block;" @endif><i></i>Theo dõi</button>
            <button type="button" class="btn btn-danger" id="unfollow-btn" @if($followed) style="display: block;" @else style="display: none;" @endif><i></i>Bỏ theo dõi</button>
            @endif
        </div>
    </div>
    <div class="main-content row">
        <div class="col-left col-md-9 col-xs-12">
            <div class="pn-left pn-hightlight row info-shop">
                <h5>VỀ CHÚNG TÔI</h5>
                <div class="col-md-4 col-xs-12">
                    <img src="{{ url('/') }}/public/images/{{ $shop->logo }}">
                </div>
                <div class="col-md-8 col-xs-12 border-blue">
                    <ul>
                        <li><h3>{{ $shop->name }}</h3></li>
                        <li>{{ $shop->address }},{{ $shop->town }},{{ $shop->district }}, {{ $shop->city }}</li>
                    </ul>
                </div>
            </div>

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
                    <div class="row item-holder" id="holder-{{ $item->id }}">
                        <div class="col-md-4 col-xs-4">
                            <img src="{{ url('/') }}/public/images/{{ $item->image }}" class="img-thumbnail">
                        </div>
                        <div class="col-md-8 col-xs-8">
                            <div class="row">
                                <div class="col-md-4 col-xs-4"><label>Tên món:</label></div>
                                <div class="col-md-8 col-xs-8">{{ $item->name }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-xs-4"><label>Giá:</label></div>
                                <div class="col-md-8 col-xs-8"><label>{{ $item->price / 1000 }}</label> K</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-xs-4"><label>Thích:</label></div>
                                <div class="col-md-8 col-xs-8"><label id="like-{{ $item->id }}">{{ $item->likes }}</label> lượt</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-xs-4"><label>Đặt hàng:</label></div>
                                <div class="col-md-8 col-xs-8"><label>{{ $item->views }}</label> lượt</div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <?php 
                                        $liked = in_array($item->id, $likedArray);
                                        ?>
                                    <div class="btn btn-default like-holder" data-toggle="tooltip" title="Thích" @if($liked)style="display: none;"@endif><img src="{{ url('/') }}/public/images/icons/if_icon-ios7-heart-outline_211754.png" width="18" height="18" class="likeBtn" data-id="{{ $item->id }}"></div>
                                    <div class="btn btn-default unlike-holder" data-toggle="tooltip" title="Bỏ Thích" @if(!$liked)style="display: none;"@endif><img src="{{ url('/') }}/public/images/icons/if_heart_299063.png" width="18" height="18" class="unlikeBtn" data-id="{{ $item->id }}"></div>
                                    <div class="btn btn-default" data-toggle="tooltip" title="Đặt hàng"><img src="{{ url('/') }}/public/images/icons/if_6_67719.png" width="18" height="18" class="cartBtn" data-id="{{ $item->id }}"></div>
                                    @if(Auth::user())
                                        @if($shop->user == Auth::user()->id)
                                            <div class="btn btn-default" data-toggle="tooltip" title="Dừng bán"><img src="{{ url('/') }}/public/images/icons/remove.png" width="18" height="18" class="disableBtn" data-id="{{ $item->id }}"></div>
                                        @endif
                                    @endif
                                </div>
                            </div>
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
        $('.disableBtn').click(function(){
            var _self = $(this);
            var item_id = _self.attr('data-id');

            var requestDisable = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('/') }}/item/disable",
                method: "POST",
                data: {
                    'item': item_id
                },
                dataType: "json"
            });

            requestDisable.done(function (msg) {
                if (msg.code == 200) {
                    $('#holder-' + item_id).hide('slow');
                } else if(msg.code == 401 && msg.message == "unauthen"){
                    swal("Cảnh báo", "Bạn phải đăng nhập để có thể sử dụng chức năng này!", "error");
                }else{
                    swal("Cảnh báo", msg.message, "error");
                }
            });

            requestDisable.fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        });

        $('.likeBtn').click(function(){
            var _self = $(this);
            var item_id = _self.attr('data-id');

            var requestLike = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('/') }}/send-like",
                method: "POST",
                data: {
                    'item': item_id,
                    'like': 1
                },
                dataType: "json"
            });

            requestLike.done(function (msg) {
                if (msg.code == 200) {
                    _self.parent().hide();
                    _self.parent().parent().find('.unlike-holder').show();
                    $('#like-' + item_id).html(parseInt($('#like-' + item_id).html()) + 1);
                } else if(msg.code == 404 && msg.message == "unauthen"){
                    swal("Cảnh báo", "Bạn phải đăng nhập để có thể sử dụng chức năng này!", "error");
                }else{
                    swal("Cảnh báo", msg.message, "error");
                }
            });

            requestLike.fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        });

        $('.unlikeBtn').click(function(){
            var _self = $(this);
            var item_id = _self.attr('data-id');

            var requestLike = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('/') }}/send-like",
                method: "POST",
                data: {
                    'item': item_id,
                    'like': 0
                },
                dataType: "json"
            });

            requestLike.done(function (msg) {
                if (msg.code == 200) {
                    _self.parent().hide();
                    _self.parent().parent().find('.like-holder').show();
                    $('#like-' + item_id).html(parseInt($('#like-' + item_id).html()) - 1);
                } else if(msg.code == 404 && msg.message == "unauthen"){
                    swal("Cảnh báo", "Bạn phải đăng nhập để có thể sử dụng chức năng này!", "error");
                }else{
                    swal("Cảnh báo", msg.message, "error");
                }
            });

            requestLike.fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        });

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