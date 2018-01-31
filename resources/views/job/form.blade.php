<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('number') ? 'has-error' : ''}}">
    {!! Form::label('number', 'Number', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('number', null, ['class' => 'form-control']) !!}
        {!! $errors->first('number', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('expiration_date') ? 'has-error' : ''}}">
    {!! Form::label('expiration_date', 'Expiration Date', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::input('datetime-local', 'expiration_date', null, ['class' => 'form-control']) !!}
        {!! $errors->first('expiration_date', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('work_time') ? 'has-error' : ''}}">
    {!! Form::label('work_time', 'Work Time', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('work_time', null, ['class' => 'form-control']) !!}
        {!! $errors->first('work_time', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('public') ? 'has-error' : ''}}">
    {!! Form::label('public', 'Public', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('public', null, ['class' => 'form-control']) !!}
        {!! $errors->first('public', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('description', null, ['class' => 'form-control']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('required') ? 'has-error' : ''}}">
    {!! Form::label('required', 'Required', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('required', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('required', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('benefit') ? 'has-error' : ''}}">
    {!! Form::label('benefit', 'Benefit', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('benefit', null, ['class' => 'form-control']) !!}
        {!! $errors->first('benefit', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
    {!! Form::label('city', 'City', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('city', null, ['class' => 'form-control']) !!}
        {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('district') ? 'has-error' : ''}}">
    {!! Form::label('district', 'District', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('district', null, ['class' => 'form-control']) !!}
        {!! $errors->first('district', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('position') ? 'has-error' : ''}}">
    {!! Form::label('position', 'Position', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('position', null, ['class' => 'form-control']) !!}
        {!! $errors->first('position', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('experience') ? 'has-error' : ''}}">
    {!! Form::label('experience', 'Experience', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('experience', null, ['class' => 'form-control']) !!}
        {!! $errors->first('experience', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('work_type') ? 'has-error' : ''}}">
    {!! Form::label('work_type', 'Work Type', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('work_type', null, ['class' => 'form-control']) !!}
        {!! $errors->first('work_type', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('job_type') ? 'has-error' : ''}}">
    {!! Form::label('job_type', 'Job Type', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('job_type', null, ['class' => 'form-control']) !!}
        {!! $errors->first('job_type', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('salary') ? 'has-error' : ''}}">
    {!! Form::label('salary', 'Salary', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('salary', null, ['class' => 'form-control']) !!}
        {!! $errors->first('salary', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">
    {!! Form::label('gender', 'Gender', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('gender', null, ['class' => 'form-control']) !!}
        {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('vip') ? 'has-error' : ''}}">
    {!! Form::label('vip', 'Vip', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('vip', null, ['class' => 'form-control']) !!}
        {!! $errors->first('vip', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('age') ? 'has-error' : ''}}">
    {!! Form::label('age', 'Age', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('age', null, ['class' => 'form-control']) !!}
        {!! $errors->first('age', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('company') ? 'has-error' : ''}}">
    {!! Form::label('company', 'Company', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('company', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
