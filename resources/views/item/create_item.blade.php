@extends('layouts.layout')

@section('content')
<link rel="stylesheet" href="{{ url('/') }}/public/css/croppie.css">
<div class="container" style="margin-top: 15px;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Tạo món mới</div>
                <div class="panel-body">
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {!! Form::open(['url' => '/item/store', 'class' => 'form-horizontal', 'files' => true, 'id' => 'create-item']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('logo') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <input type="hidden" id="logo" name="image" value="">
                                    <img src="{{ url('/') }}/public/images/item.jpg" id="logo-image" class="img" style="height: 150px; width: 150px; background-color: #fff; border: 2px solid gray; border-radius: 5px;">
                                    <input type="file" name="logo-img" id="logo-img" style="display: none;">
                                    {!! $errors->first('logo', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                <div class="col-md-6">
                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Tên Món Mới', 'id' => 'item-name']) !!}
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="col-md-6" style="margin-top:6px; text-transform: uppercase;">
                                    <label for="shopName">tại {{ $shop->name }}</label>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                                <div class="col-md-6">
                                    {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Giá', 'id' => 'item-name']) !!}
                                    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="col-md-6" style="margin-top:6px; text-transform: uppercase;">
                                    <label for="shopName">VNĐ</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-12 pull-right">
                                    <div class="btn btn-primary" id="submit-btn">Tạo mới</div>
                                    <a target="_self" href="{{ url('/home') }}" class="btn btn-primary">Trở về trang chủ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .croppie-container .cr-boundary{
        margin: 0;
        width: 100%;
    }
    .croppie-container .cr-slider-wrap{
        margin: 0;
        width: 100%;
    }
</style>

<div class="modal fade modal-show-logo" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel panel-default">
                  <div class="panel-heading">Upload Ảnh</div>
                  <div class="panel-body">

                    <div class="row">
                        <div class="col-md-5 text-center">
                            <div id="upload-logo-demo" style="width:350px"></div>
                        </div>
                        <div class="col-md-2" style="padding-top:30px;">
                            <input type="file" id="upload-logo" style="display: none;">
                            <button class="btn btn-default select-logo" style="margin: 10px 0;">Chọn Ảnh</button>
                            <button class="btn btn-success upload-logo-result">Cắt Ảnh</button>
                        </div>
                        <div class="col-md-5" style="">
                            <div id="upload-logo-i" style="background:#e1e1e1;width:329px;height:249px;margin-top: 30px;"></div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary ok-logo-select">Lựa chọn</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ url('/') }}/public/js/croppie.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    var src_logo = '';
    $('#logo-image').on('click', function (e) {
        $('.modal-show-logo').modal('show');
    });
    $uploadLogoCrop = $('#upload-logo-demo').croppie({
        enableExif: true,
        viewport: {
            width: 329,
            height: 249,
            type: 'square'
        },
        boundary: {
            width: 350,
            height: 300
        }
    });

    $('.select-logo').click(function(){
        $("#upload-logo").click();
    });

    $('#upload-logo').on('change', function () { 
        var reader = new FileReader();
        reader.onload = function (e) {
            $uploadLogoCrop.croppie('bind', {
                url: e.target.result
            }).then(function(){
                console.log('jQuery bind complete');
            });
            
        }
        reader.readAsDataURL(this.files[0]);
    });

    $('.upload-logo-result').on('click', function (ev) {
        $uploadLogoCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('/') }}/ajaxpro",
                type: "POST",
                data: {"image":resp},
                success: function (data) {
                    if(data.code == 200){
                        $('#logo-image').val(data.image_url);
                        $('#logo').val(data.image_url);
                        src_logo = resp;
                        html = '<img src="' + resp + '" />';
                        $("#upload-logo-i").html(html);
                    }
                }
            });
        });
    });

    $('.ok-logo-select').click(function(){
        $('#logo-image').attr('src',src_logo);
        $('.modal-show-logo').modal('toggle');
    });

    $("#submit-btn").click(function () {
        $("#create-item").submit();
    });
});
</script>
@endsection