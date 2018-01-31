<div class="form-group {{ $errors->has('user') ? 'has-error' : ''}}">
    {!! Form::label('user', 'User', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('user', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('user', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('job') ? 'has-error' : ''}}">
    {!! Form::label('job', 'Job', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('job', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('job', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
