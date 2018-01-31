@extends('layouts.layout_cv')

@section('content')
<link rel="stylesheet" href="{{ url('/') }}/public/css/croppie.css">
<div class="container" style="margin-top: 15px;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Tạo hồ sơ</div>
                <div class="panel-body">
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {!! Form::open(['url' => '/curriculumvitae/store', 'class' => 'form-horizontal', 'files' => true, 'id' => 'create-curriculum-vitae']) !!}
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group {{ $errors->has('avatar') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <input type="hidden" id="avatar" name="avatar" value="">
                                    <img src="http://test.gmon.com.vn/?image=anh_dai_dien.jpg" id="avatar-image" class="img" style="height: 150px; width: 150px; background-color: #fff; border: 2px solid gray; border-radius: 50%;">
                                    <input type="file" name="avatar-img" id="avatar-img" style="display: none;">
                                    {!! $errors->first('avatar', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group {{ $errors->has('birthday') ? 'has-error' : ''}}">
                                {!! Form::label('birthday', 'Ngày sinh', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    <div class='input-group date' id='datetimepicker'>
                                        <input type='text' class="form-control" name="birthday" id="birthday" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar">
                                            </span>
                                        </span>
                                    </div>
                                    {!! $errors->first('birthday', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
                                {!! Form::label('city', 'Tỉnh / Thành phố', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    <select class="form-control col-md-2" class="city" id="city" name="city">
                                        <option value="0">Chọn Tỉnh / Thành phố</option>
                                        @foreach($cities as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('salary') ? 'has-error' : ''}}">
                                {!! Form::label('birthday', 'Mức lương', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    <input type="hidden" id="salary" name="salary" value="1">
                                    <select class="form-control" title="Mức lương" id="salary_select" name="salary_select">
                                        @foreach($salaries as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('salary', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div id="jobs_hold" class="form-group {{ $errors->has('jobs') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <input type="hidden" id="jobs" name="jobs" value="">
                                    <select class="form-control selectpicker" multiple title="Chọn công việc">
                                        @foreach($job_types as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('jobs', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5" style="margin:3px 0;">
                            <div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">
                                {!! Form::label('gender', 'Giới tính', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    <label>{!! Form::radio('gender', '1', true); !!}Nam</label>
                                    <label>{!! Form::radio('gender', '0'); !!}Nữ</label>
                                    {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('district') ? 'has-error' : ''}}">
                                {!! Form::label('district', 'Quận / Huyện', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    <select class="form-control" id="district" name="district"><option value="0">Chọn Quận / Huyện</option></select>
                                    {!! $errors->first('district', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                                {!! Form::label('address', 'Địa chỉ', ['class' => 'col-md-5 control-label']) !!}
                                <div class="col-md-7">
                                    {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Số nhà và Đường']) !!}
                                    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div id="time_can_work_hold" class="form-group {{ $errors->has('jobs') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <input type="hidden" id="time_can_work" name="time_can_work" value="">
                                    <select class="form-control selectpicker" multiple title="Chọn Thời gian làm việc">
                                        <option>Ca 1 (7h - 12h)</option>
                                        <option>Ca 2 (12h - 17h)</option>
                                        <option>Ca 3 (17h - 22h)</option>
                                        <option>Fulltime</option>
                                    </select>
                                    {!! $errors->first('jobs', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default" id="qua_trinh_hoc_tap">
                        <div class="panel-heading">Quá trình học tập</div>
                        <div class="panel-body">
                            <input type="hidden" name="education" id="education" value="">
                            <div class="form-hoc-tap-group first-form" id="hoc_tap_0">
                                <input type="hidden" class="education_json" id="hoc_tap_0_json" value="">
                                <div id='hoc_tap_0_content'>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="col-md-2"><input type="radio" class='bang_cap' name="bang_cap_0" value="0" checked> Chứng chỉ</label>
                                            <label class="col-md-5"><input type="radio" class='bang_cap' name="bang_cap_0" value="1">Sau Đại học / Đại học / Cao đẳng / Trung cấp</label>
                                            <label class="col-md-5"><input type="radio" class='bang_cap' name="bang_cap_0" value="2">Tiểu học / Trung học</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="birthday" class="col-md-2 control-label">Học tại</label>
                                        <div class="col-md-4">
                                            <input type="text" name="school" class="form-control truong_hoc" id="truong_hoc_0" placeholder="Nhập tên trường, trung tâm học">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-sm-offset-2"><input type="radio" class="student_process" name="student_process_0" value="0" checked>Đang học</label>
                                            <label class="col-sm-offset-2"><input type="radio" class="student_process" name="student_process_0" value="1">Đã tốt nghiệp</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="birthday" class="col-md-2 control-label">Thời gian học</label>
                                        <div class="col-md-1">
                                            <label for="birthday" class="col-md-2 control-label">Từ:</label>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control col-md-2" class="thang_bat_dau" id="thang_bat_dau_0">
                                                @foreach($months as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control col-md-2" class="nam_bat_dau" id="nam_bat_dau_0">
                                                @foreach($years as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-1 learn-to-0" style="display: none;">
                                            <label for="birthday" class="col-md-2 control-label">Đến:</label>
                                        </div>
                                        <div class="col-md-2 learn-to-0" style="display: none;">
                                            <select class="form-control col-md-2" class="thang_ket_thuc" id="thang_ket_thuc_0">
                                                @foreach($months as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 learn-to-0" style="display: none;">
                                            <select class="form-control col-md-2" class="nam_ket_thuc" id="nam_ket_thuc_0">
                                                @foreach($years as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="chuyen_nganh" class="col-md-2 control-label"><div id="chuyen_nganh_0_label">Chuyên ngành</div></label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" class="chuyen_nganh" id="chuyen_nganh_0">
                                        </div>
                                        <label for="loai_tot_nghiep_0" class="col-md-2 control-label"><span  id="loai_tot_nghiep_0_label" style="display:none;">Tốt nghiệp loại</span></label>
                                        <div class="col-md-3">
                                            <select class="form-control loai_tot_nghiep" id="loai_tot_nghiep_0" style="display:none;">
                                                @foreach($loaitotnghieps as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class='col-md-8'>
                                        <p id='truong_hoc_0_txt' class='truong-hoc-hide'></p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class='btn btn-primary pull-right hoc_tap_edit-btn' id='edit_0' style='display:none;'>Chỉnh sửa</div>
                                        <div class="btn btn-primary pull-right hoc_tap_success-btn" id='success_0'>Hoàn thành</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center"><div class="btn btn-link" id="them_moi_hoc_tap"> + Thêm mới</div></div>
                    </div>

                    <div class="panel panel-default" id="kinh_nghiem_lam_viec">
                        <div class="panel-heading">Kinh nghiệm làm việc</div>
                        <div class="panel-body">
                            <input type="hidden" name="word_experience" id="word_experience" value="">
                            <div class="form-kinh-nghiem-group first-form" id="kinh_nghiem_lam_viec_0">
                                <input type="hidden" class="word_experience_json" id="kinh_nghiem_lam_viec_0_json" value="">
                                <div id='kinh_nghiem_lam_viec_0_content'>
                                    <input type="hidden" id="lam_viec_0_image" value="">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="ten_cong_ty" class="col-md-4 control-label">Tên công ty</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" class="ten_cong_ty_0" id="ten_cong_ty_0">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="vi_tri" class="col-md-4 control-label">Vị trí công việc</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" class="vi_tri" id="vi_tri_0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="birthday" class="col-md-2 control-label">Thời gian làm</label>
                                        <div class="col-md-1">
                                            <label for="birthday" class="col-md-2 control-label">Từ:</label>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control col-md-2" class="thang_bat_dau" id="thang_bat_dau_lam_viec_0">
                                                @foreach($months as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control col-md-2" class="nam_bat_dau" id="nam_bat_dau_lam_viec_0">
                                                @foreach($years as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <label for="birthday" class="col-md-2 control-label">Đến:</label>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control col-md-2" class="thang_ket_thuc" id="thang_ket_thuc_lam_viec_0">
                                                @foreach($months as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control col-md-2" class="nam_ket_thuc" id="nam_ket_thuc_lam_viec_0">
                                                @foreach($years as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="ten_cong_ty" class="col-md-2 control-label">Mô tả công việc</label>
                                        <div class="col-md-10">
                                            <textarea rows="4" cols="50" class="form-control" class="mo_ta_0" id="mo_ta_0" placeholder="Mô tả ngắn về công việc"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class='col-md-8'>
                                        <p id='kinh_nghiem_0_txt' class='kinh-nghiem-hide'></p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class='btn btn-primary pull-right kinh_nghiem_edit-btn' id='edit_kinh_nghiem_0' style='display:none;'>Chỉnh sửa</div>
                                        <div class="btn btn-primary pull-right kinh_nghiem_success-btn" id='success_kinh_nghiem_0'>Hoàn thành</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center"><div class="btn btn-link" id="them_moi_kinh_nghiem"> + Thêm mới</div></div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Kỹ năng làm việc</div>
                        <div class="panel-body">
                            <input type="hidden" name="qualification" id="qualification" value="">
                            <div class="form-ngon-ngu-group">
                                <div class="form-group" id="qualification_content">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="ten_ky_nang" class="col-md-2 control-label">Tên kỹ năng</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" class="ten_ky_nang" id="ten_ky_nang">
                                    </div>
                                    <div class="btn btn-primary" id="add-qualification">Thêm mới</div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        VD: Word, Excel, Powerpoint,...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Trình độ ngoại ngữ</div>
                        <div class="panel-body" style="display: none;">
                            <input type="hidden" name="language" id="language" value="">
                            <div class="form-ngon-ngu-group">
                                <div class="form-group" id="ngoai_ngu_content">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="ten_ngoai_ngu" class="col-md-2 control-label">Tên ngoại ngữ</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" class="ten_ngoai_ngu" id="ten_ngoai_ngu">
                                    </div>
                                    <label for="trinh_do_ngoai_ngu" class="col-md-2 control-label">Trình độ</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" class="trinh_do_ngoai_ngu" id="trinh_do_ngoai_ngu">
                                    </div>
                                    <div class="btn btn-primary" id="add-language">Thêm mới</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Sở thích - Tính cách</div>
                        <div class="panel-body" style="display: none;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="interests" class="col-md-12">Sở thích</label>
                                    <div class="col-md-12">
                                        {!! Form::text('interests', null, ['class' => 'form-control', 'id' => 'interests']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="interests" class="col-md-12">Tính cách</label>
                                    <div class="col-md-12">
                                        {!! Form::text('references', null, ['class' => 'form-control', 'id' => 'references']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Mục tiêu nghề nghiệp</div>
                        <div class="panel-body" style="display: none;">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        {!! Form::text('career_objective', null, ['class' => 'form-control', 'id' => 'career_objective']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Hoạt động ngoại khóa</div>
                        <div class="panel-body" style="display: none;">
                            <div class="form-group">
                                <div class="col-md-12">
                                    Mô tả một vài hoạt động mà bạn đã tham gia...
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    {!! Form::text('active', null, ['class' => 'form-control', 'id' => 'active']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Thêm ảnh ngoại khóa</div>
                        <div class="panel-body">
                            <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <label class="control-label">Thêm ảnh</label>
                                </div>
                                <div class="col-md-12">
                                    <div id="images-plus"></div>
                                    <div class="clearfix"></div>
                                    <img src="http://test.gmon.com.vn/?image=icons8-Add-Image-50.png" id="images" class="img" style="height: 50px; width: 50px;">
                                    <input type="file" name="images-img[]" id="images-img" style="display: none;" multiple>
                                    {!! $errors->first('images', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            <button class="btn btn-primary" id="submit-btn">Lưu lại</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-show-avatar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel panel-default">
                  <div class="panel-heading">Upload Avatar</div>
                  <div class="panel-body">

                    <div class="row">
                        <div class="col-md-5 text-center">
                            <div id="upload-demo" style="width:350px"></div>
                        </div>
                        <div class="col-md-3" style="padding-top:30px;">
                            <input type="file" id="upload" style="display: none;">
                            <button class="btn btn-default select-avatar" style="margin: 10px 0;">Chọn avatar</button>
                            <button class="btn btn-success upload-result">Cắt Avatar</button>
                        </div>
                        <div class="col-md-4" style="">
                            <div id="upload-demo-i" style="background:#e1e1e1;width:200px;height:200px;margin-top: 30px;"></div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary ok-select">Lựa chọn</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ url('/') }}/public/js/croppie.js"></script>
<script type="text/javascript">

    var src_avatar = "";
    $uploadCrop = $('#upload-demo').croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200,
            type: 'circle'
        },
        boundary: {
            width: 300,
            height: 300
        }
    });

    $('.select-avatar').click(function(){
        $("#upload").click();
    });

    $('.ok-select').click(function(){
        $('#avatar-image').attr('src',src_avatar);
        $('.modal-show-avatar').modal('toggle');
    });

    $('#avatar-img').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $uploadCrop.croppie('bind', {
                url: e.target.result
            }).then(function(){
                console.log('jQuery bind complete');
            });
            
        }
        reader.readAsDataURL(this.files[0]);
    });

    $('#upload').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $uploadCrop.croppie('bind', {
                url: e.target.result
            }).then(function(){
                console.log('jQuery bind complete');
            });
            
        }
        reader.readAsDataURL(this.files[0]);
    });

    $('.upload-result').on('click', function (ev) {
        $uploadCrop.croppie('result', {
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
                        $('#avatar').val(data.image_url);
                        src_avatar = resp;
                        html = '<img src="' + resp + '" />';
                        $("#upload-demo-i").html(html);
                    }
                }
            });
        });
    });
</script>
<script src="{{ url('/') }}/public/js/curriculum_vitae.js"></script>
@endsection
