@extends('layouts.layout')

@section('content')
<script type="text/javascript" src="{{ url('/') }}/public//bower_components/moment/min/moment.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public//bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="{{ url('/') }}/public//bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
    <div class="container" style="margin-top: 15px;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Sửa tin tuyển dụng</h1></div>
                <div class="panel-body">
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {!! Form::open(['url' => '/job/' . $job->id . '/update', 'class' => 'form-horizontal', 'files' => true, 'id' => 'edit-job']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                <div class="col-md-6">
                                    {!! Form::text('name', $job->name, ['class' => 'form-control', 'placeholder' => 'Tên công việc', 'id' => 'job-name']) !!}
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="col-md-6" style="margin-top:6px; text-transform: uppercase;">
                                    <label for="companyName">tại {{ $company->name }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" id="select-branch">
                            <input type="hidden" id="branches" name="branches" value="">
                            <?php 
                                $branchArr = ltrim($job->branches,';');
                                $branchList = explode(';', $branchArr);
                                $branchesData = array();
                                foreach ($branchList as $branch) {
                                    if(strlen($branch) > 0){
                                        $branchAddressArr = explode('( ',$branch);
                                        $branchCityDistrictArr = explode(', ',$branchAddressArr[1]);
                                        $branchAddress = '';
                                        for($i = 0; $i < count($branchCityDistrictArr) - 2; $i++){
                                            if($i == 0) $branchAddress .= $branchCityDistrictArr[$i];
                                            else $branchAddress .= ', ' . $branchCityDistrictArr[$i];
                                        }
                                        $branchesData[] = $branchAddress;
                                    }
                                }
                            ?>
                            <select class="form-control selectpicker" multiple title="Chọn chi nhánh tuyển dụng">
                                <?php 
                                    foreach($branches as $branch){
                                        if(in_array($branch->address_branch, $branchesData)){
                                        echo '<option id="'.$branch->id.'" selected>'. $branch->name_branch . '( ' . $branch->address_branch . ', ' . $branch->district_branch_name . ', ' . $branch->city_branch_name . ' )' .'</option>';
                                        }else{
                                        echo '<option id="'.$branch->id.'">'. $branch->name_branch . '( ' . $branch->address_branch . ', ' . $branch->district_branch_name . ', ' . $branch->city_branch_name . ' )' .'</option>';
                                        }
                                    }
                                ?>
                            </select>
                            {!! $errors->first('branches', '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <label class="control-label">Mô tả công việc</label>
                                </div>
                                <div class="col-md-12">
                                    {!! Form::text('description', null, ['class' => 'form-control', 'id' => 'description']) !!}
                                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('requirement') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <label class="control-label">Yêu cầu công việc</label>
                                </div>
                                <div class="col-md-12">
                                    {!! Form::text('requirement', null, ['class' => 'form-control', 'id' => 'requirement']) !!}
                                    {!! $errors->first('requirement', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('public') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('number') ? 'has-error' : ''}}">
                                        <div class="col-md-12">
                                            {!! Form::number('number', $job->number, ['class' => 'form-control', 'placeholder' => 'Số lượng']) !!}
                                            {!! $errors->first('number', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('position') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <label class="control-label"></label>
                                </div>
                                <div class="col-md-12">
                                    {!! Form::select('position', $position, $job->position, ['placeholder' => 'Chọn ngành nghề', 'class' => 'form-control']) !!}
                                    {!! $errors->first('position', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('job_type') ? 'has-error' : ''}}">
                                <div class="col-md-12" id="select-job">
                                    {!! Form::select('job_type', $jobstype, $job->job_type, ['placeholder' => 'Chọn ngành nghề', 'class' => 'form-control']) !!}
                                    {!! $errors->first('job_type', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('education') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <input type="hidden" id="education" name="education" value="0">
                                    {!! Form::select('education_select', $education, $job->education, array('class' => 'form-control', 'id' => 'education_select')) !!}
                                    {!! $errors->first('experience', '<p class="help-block">:message</p>') !!}
                                    {!! $errors->first('education', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('experience') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <input type="hidden" id="experience" name="experience" value="0">
                                    {!! Form::select('experience_select', $experience, $job->experience, array('class' => 'form-control', 'id' => 'experience_select')) !!}
                                    {!! $errors->first('experience', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('salary') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    {!! Form::select('salary', $salaries, $job->salary, ['class' => 'form-control', 'id' => 'salary']) !!}
                                    {!! $errors->first('salary', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('work_type') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <input type="hidden" id="work_type" name="work_type" value="0">
                                    {!! Form::select('work_type_select', ['0' => 'Bán thời gian', '1' => 'Toàn thời gian'], $job->work_type, ['class' => 'form-control', 'id' => 'work_type_select']) !!}
                                    {!! $errors->first('work_type', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('age') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <input type="hidden" id="age" name="age" value="0">
                                    {!! Form::select('age_select', ['0' => 'Không yêu cầu độ tuổi', '1' => '18 - 24 tuổi', '2' => 'Trên 24 tuổi'], $job->age, ['class' => 'form-control', 'id' => 'age_select']) !!}
                                    {!! $errors->first('age', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <input type="hidden" id="gender" name="gender" value="0">
                                    {!! Form::select('gender_select', ['0' => 'Không yêu cầu giới tính', '1' => 'Nam', '2' => 'Nữ'], $job->gender, ['class' => 'form-control', 'id' => 'gender_select']) !!}
                                    {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('benefit') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <label class="control-label">Quyền lợi</label>
                                </div>
                                <div class="col-md-12">
                                    {!! Form::text('benefit', null, ['class' => 'form-control', 'id' => 'benefit']) !!}
                                    {!! $errors->first('benefit', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('expiration_date') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    <div class='input-group date' id='datetimepicker'>
                                        <input type='text' class="form-control" name="expiration_date" id="expiration_date" placeholder="Ngày hết hạn" value="{{ $job->expiration_date }}"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar">
                                            </span>
                                        </span>
                                    </div>
                                    {!! $errors->first('expiration_date', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 pull-right">
                                    <button class="btn btn-primary" id="submit-btn">Lưu lại</button>
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
<script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/css/bootstrap-select.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    CKEDITOR.replace('description');
    CKEDITOR.replace('requirement');
    CKEDITOR.replace('benefit');
    CKEDITOR.instances['description'].setData('<?php echo $job->description; ?>');
    CKEDITOR.instances['requirement'].setData('<?php echo $job->requirement; ?>');
    CKEDITOR.instances['benefit'].setData('<?php echo $job->benefit; ?>');

    $('#time_start').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    $('#expiration_date').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    $("#city").change(function () {
        var citId = $("#city").val();
        var request = $.ajax({
            url: "{{ URL::to('/') }}/getDistrict/" + citId,
            method: "GET",
            dataType: "html"
        });

        request.done(function (msg) {
            $("#district").html(msg);
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $("#education_select").change(function () {
        $("#education").val($(this).val());
    });

    $("#experience_select").change(function () {
        $("#experience").val($(this).val());
    });

    $("#salary_select").change(function () {
        $("#salary").val($(this).val());
    });

    $("#work_type_select").change(function () {
        $("#work_type").val($(this).val());
    });

    $("#age_select").change(function () {
        $("#age").val($(this).val());
    });

    $("#gender_select").change(function () {
        $("#gender").val($(this).val());
    });

    $("#submit-btn").click(function () {
        var listBranches = '';
        $listBranch = $('#select-branch select option');
        $('#select-branch .dropdown-menu.inner li').each(function (index) {
            if($(this).hasClass('selected')){
                listBranches += ';' + $(this).text();
            }
        });

        $('#branches').val(listBranches);
        $('#description').val(CKEDITOR.instances["description"].getData());
        $('#requirement').val(CKEDITOR.instances["requirement"].getData());
        $('#benefit').val(CKEDITOR.instances["benefit"].getData());
        $("#edit-job").submit();
    });
});
</script>
@endsection