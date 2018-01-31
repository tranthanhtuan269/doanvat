<div class="form-group {{ $errors->has('company') ? 'has-error' : ''}}">
    {!! Form::label('company', 'Company', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('company', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('company_type') ? 'has-error' : ''}}">
    {!! Form::label('company_type', 'Company Type', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('company_type', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('company_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
