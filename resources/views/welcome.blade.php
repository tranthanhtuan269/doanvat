@extends('layouts.app')

@section('content')

    <div class="grid">
      <div class="grid-sizer"></div>
      @foreach($listItem as $item)
      <div class="grid-item" data-itemid="{{ $item->id }}" data-shopid="{{ $item->shop }}" data-lat="{{ $item->lat }}" data-lng="{{ $item->lng }}">
        <img src="{{ url('/') }}/public/images/{{ $item->image }}" />
        <!-- <div class="relative-item"><img src="{{ url('/') }}/public/images/icons/if_finance-03_808676.png" width="32" height="32" /></div> -->
        <div class="detail-item">
            <div class="nameItem">{{ $item->itemname }}</div>
            <div class="nameShop">tại <a href="{{ url('/') }}/shop/{{ $item->shop }}/info">{{ $item->shopname }}</a></div>
            <div class="price">{{ $item->price / 1000 }} <span class="sub-price">k</span></div>
        </div>
      </div>
      @endforeach
    </div>

    <script type="text/javascript">
        var current_possition = 0;

        var $html1 = '';
        var $html2 = '';
        var countLoader = 1;

        var cartList = [];
        var url = "{{ url('/') }}";

        function addItem(){
            $html1  = '<div class="grid-item grid-item'+ countLoader + '" data-itemid="'+ (countLoader + 19) + '">';
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
                var id_selected = $(this).attr('data-itemid');
                var index_selected = cartList.indexOf(id_selected);
                if(!grid_clicked){
                    cartList.push(id_selected);
                    $(this).hide("slow");
                    $('.number-in-cart').html("(" + (parseInt($('.number-in-cart').html().slice(1, -1)) + 1) + ")");
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

    <script src="{{ url('/') }}/public/js/menuBreaker.js"></script>
    <script src="{{ url('/') }}/public/js/script.js"></script>
@endsection