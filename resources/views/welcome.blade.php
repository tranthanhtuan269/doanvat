<!DOCTYPE html>
<html>
<head>
    <title>doanvat.vn</title>
    <script src="{{ url('/') }}/public/theme/js/jquery-3.3.1.min.js"></script>
    <script src="{{ url('/') }}/public/theme/js/masonry.pkgd.min.js"></script>
    <script src="{{ url('/') }}/public/theme/js/imagesloaded.pkgd.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="{{ url('/') }}/public/theme/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        * { box-sizing: border-box; }

        /* force scrollbar */
        html { overflow-y: scroll; }

        body { font-family: sans-serif; }

        /* ---- grid ---- */

        .grid {
          background: white;
        }

        /* clear fix */
        .grid:after {
          content: '';
          display: block;
          clear: both;
        }

        /* ---- .grid-item ---- */

        .grid-sizer,
        .grid-item {
          width: 24.8%;
          padding: 3px;
        }

        .grid-item img{
          float: left;
          border: 5px solid #fff;
          border-radius: 16px;
          position: relative;
          cursor: pointer;
        }

        .grid-item img {
          display: block;
          max-width: 100%;
        }

        .detail-item{
            position: absolute;
            width: 70%;
            min-height: 30%;
            text-align: center;
            font-size: 22px;
            bottom: 11px;
            right: 1px;
            opacity: 0;
        }

        .price{
            background-color: #eee;
            color: #333;
            padding: 3px;
            margin: 0 auto;
            width: 92%;
            height: 100%;
            border-radius: 10px;
        }

        .sub-price{
            font-size: 30px;
            margin-left: -12px;
        }

        .icon-menu{
            width: 15px;
            height: 15px;
        }

        /*alert*/
        .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
        /*end alert*/

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
        <a class="navbar-brand" href="#"><img src="{{ url('/') }}/public/theme/images/icons/if_hamburger_93073.png" width="25" height="25" alt="">DoAnVat.vn</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#"><img src="{{ url('/') }}/public/theme/images/icons/if_09_61473.png" class="icon-menu" alt="">Đi chợ <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><img src="{{ url('/') }}/public/theme/images/icons/if_6_67719.png" class="icon-menu" alt="">Giỏ hàng</a>
                </li>
            </ul>
            <form class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Tìm kiếm" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
            </form>
        </div>
    </nav>
    <h1>Masonry - imagesLoaded progress</h1>
    <div class="alert" id="checkLocalStore" style="display: none;">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        Phiên bản trình duyệt của bạn không hỗ trợ mua hàng trên <b>DoAnVat.vn</b>. <br /> Xin hãy cập nhật phiên bản mới để trải nghiệm dịch vụ của chúng tôi!
    </div>

    <div class="grid">
      <div class="grid-sizer"></div>
      <div class="grid-item" data-id="1">
        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/orange-tree.jpg" /> -->
        <img src="{{ url('/') }}/public/theme/images/banh_bot_loc.jpg" />
        <div class="detail-item">
            <div class="price">35 <span class="sub-price">k</span></div>
        </div>
      </div>
      <div class="grid-item" data-id="2">
        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/submerged.jpg" /> -->
        <img src="{{ url('/') }}/public/theme/images/banh_gio01.jpg" />
        <div class="detail-item">
            <div class="price">35 <span class="sub-price">k</span></div>
        </div>
      </div>
      <div class="grid-item" data-id="3">
        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/look-out.jpg" /> -->
        <img src="{{ url('/') }}/public/theme/images/banh_goi01.jpg" />
        <div class="detail-item">
            <div class="price">35 <span class="sub-price">k</span></div>
        </div>
      </div>
      <div class="grid-item" data-id="4">
        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/one-world-trade.jpg" /> -->
        <img src="{{ url('/') }}/public/theme/images/canh_ga_nuong01.jpg" />
        <div class="detail-item">
            <div class="price">35 <span class="sub-price">k</span></div>
        </div>
      </div>
      <div class="grid-item" data-id="5">
        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/drizzle.jpg" /> -->
        <img src="{{ url('/') }}/public/theme/images/banh_xeo01.jpeg" />
        <div class="detail-item">
            <div class="price">35 <span class="sub-price">k</span></div>
        </div>
      </div>
      <div class="grid-item" data-id="6">
        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/cat-nose.jpg" /> -->
        <img src="{{ url('/') }}/public/theme/images/cha_ca_vien01.jpg" />
        <div class="detail-item">
            <div class="price">35 <span class="sub-price">k</span></div>
        </div>
      </div>
      <div class="grid-item" data-id="7">
        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/contrail.jpg" /> -->
        <img src="{{ url('/') }}/public/theme/images/cha_ca_vien01.jpg" />
        <div class="detail-item">
            <div class="price">35 <span class="sub-price">k</span></div>
        </div>
      </div>
      <div class="grid-item" data-id="8">
        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/golden-hour.jpg" /> -->
        <img src="{{ url('/') }}/public/theme/images/chao_suon01.jpg" />
        <div class="detail-item">
            <div class="price">35 <span class="sub-price">k</span></div>
        </div>
      </div>
      <div class="grid-item" data-id="9">
        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/flight-formation.jpg" /> -->
        <img src="{{ url('/') }}/public/theme/images/com_ga01.jpg" />
        <div class="detail-item">
            <div class="price">35 <span class="sub-price">k</span></div>
        </div>
      </div>
      <div class="grid-item" data-id="10">
        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/flight-formation.jpg" /> -->
        <img src="{{ url('/') }}/public/theme/images/cut_lon_xao_me01.jpg" />
        <div class="detail-item">
            <div class="price">35 <span class="sub-price">k</span></div>
        </div>
      </div>
      <div class="grid-item" data-id="11">
        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/flight-formation.jpg" /> -->
        <img src="{{ url('/') }}/public/theme/images/ga_bo_xoi01.jpg" />
        <div class="detail-item">
            <div class="price">35 <span class="sub-price">k</span></div>
        </div>
      </div>
      <div class="grid-item" data-id="12">
        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/flight-formation.jpg" /> -->
        <img src="{{ url('/') }}/public/theme/images/kimpap01.jpg" />
        <div class="detail-item">
            <div class="price">35 <span class="sub-price">k</span></div>
        </div>
      </div>
      <div class="grid-item" data-id="13">
        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/flight-formation.jpg" /> -->
        <img src="{{ url('/') }}/public/theme/images/nem_chua_ran01.jpg" />
        <div class="detail-item">
            <div class="price">35 <span class="sub-price">k</span></div>
        </div>
      </div>
      <div class="grid-item" data-id="14">
        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/flight-formation.jpg" /> -->
        <img src="{{ url('/') }}/public/theme/images/nem_chua_ran02.jpg" />
        <div class="detail-item">
            <div class="price">35 <span class="sub-price">k</span></div>
        </div>
      </div>
      <div class="grid-item" data-id="15">
        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/flight-formation.jpg" /> -->
        <img src="{{ url('/') }}/public/theme/images/ngo_sao01.jpg" />
        <div class="detail-item">
            <div class="price">35 <span class="sub-price">k</span></div>
        </div>
      </div>
      <div class="grid-item" data-id="16">
        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/flight-formation.jpg" /> -->
        <img src="{{ url('/') }}/public/theme/images/nom_chan_ga_rut_xuong01.jpg" />
        <div class="detail-item">
            <div class="price">35 <span class="sub-price">k</span></div>
        </div>
      </div>
      <div class="grid-item" data-id="17">
        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/flight-formation.jpg" /> -->
        <img src="{{ url('/') }}/public/theme/images/nom_chan_ga_rut_xuong02.jpg" />
        <div class="detail-item">
            <div class="price">35 <span class="sub-price">k</span></div>
        </div>
      </div>
      <div class="grid-item" data-id="18">
        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/flight-formation.jpg" /> -->
        <img src="{{ url('/') }}/public/theme/images/xoi_ga01.jpg" />
        <div class="detail-item">
            <div class="price">35 <span class="sub-price">k</span></div>
        </div>
      </div>
      <div class="grid-item" data-id="19">
        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/flight-formation.jpg" /> -->
        <img src="{{ url('/') }}/public/theme/images/xoi_mit01.jpg" />
        <div class="detail-item">
            <div class="price">35 <span class="sub-price">k</span></div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
        var current_possition = 0;

        var $html1 = '';
        var $html2 = '';
        var countLoader = 1;

        var cartList = [];
        var url = "{{ url('/') }}";

        function addItem(){
            $html1  = '<div class="grid-item grid-item'+ countLoader + '" data-id="'+ (countLoader + 19) + '">';
            $html1 += '<img src="'+ url +'/public/theme/images/nom_chan_ga_rut_xuong02.jpg" />';
            $html1 += '<div class="detail-item">';
            $html1 += '<div class="price">35 <span class="sub-price">k</span></div>';
            $html1 += '</div>';
            $html1 += '</div>';
        }

        //--------------------------------------------------------------//
        // localstore check
        if (typeof(Storage) !== "undefined") {
            // Code for localStorage/sessionStorage.
        } else {
            $('#checkLocalStore').show();
        }
        // end check localstore
        //--------------------------------------------------------------//

        //--------------------------------------------------------------//
        // masonry init
        // init Masonry
        var $grid = $('.grid').masonry({
          itemSelector: '.grid-item',
          percentPosition: true,
          columnWidth: '.grid-sizer'
        });
        // layout Masonry after each image loads
        $grid.imagesLoaded().progress( function() {
          $grid.masonry();
        });
        // end masonry
        //--------------------------------------------------------------//

        //--------------------------------------------------------------//
        // item init
        itemInit('.grid-item');
        function itemInit(className){
            $(className).hover(function() {
                $( this ).find( ".detail-item" ).animate({
                    opacity: 1,
                    marginLeft: "0.6in",
                    fontSize: "3em",
                    borderWidth: "10px"
                }, 500 );
            }, function(){
                $( this ).find( ".detail-item" ).animate({
                    opacity: 0,
                    marginLeft: "0.6in",
                    fontSize: "3em",
                    borderWidth: "10px"
                }, 500 );
            });

            $(className).click(function(){
                var grid_clicked = $(this).css("opacity") == 0.4;
                var id_selected = $(this).attr('data-id');
                var index_selected = cartList.indexOf(id_selected);
                if(grid_clicked){
                    cartList.splice(index_selected, 1);
                    $(this).css("opacity", 1);
                }else{
                    cartList.push(id_selected);
                    $(this).css("opacity", 0.4);
                }
                localStorage.setItem("cartList", cartList);
            });
        }

        function removeEventInit(){
            $('.grid-item').off('hover');
        }
        // end item init
        //--------------------------------------------------------------//

        //--------------------------------------------------------------//
        // scroll to load       
        $(window).scroll(function() {
            if($(window).scrollTop() == $(document).height() - $(window).height()) {
                addItem();
                for(var i = 0; i < 10; i++){
                    $('.grid').append($html1);
                    $('.grid').masonry('reloadItems');  
                }
                $('.grid').masonry();
                itemInit('.grid-item' + countLoader);
                countLoader++;
            }
        });
        // end item init
        //--------------------------------------------------------------//


    </script>
    <script src="{{ url('/') }}/public/theme/js/popper.min.js"></script>
    <script src="{{ url('/') }}/public/theme/js/bootstrap.min.js"></script>
</body>
</html>