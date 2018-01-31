<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    {!! Form::label('address', 'Address', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('address', null, ['class' => 'form-control']) !!}
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
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
</div><div class="form-group {{ $errors->has('master') ? 'has-error' : ''}}">
    {!! Form::label('master', 'Master', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('master', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('master', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('company') ? 'has-error' : ''}}">
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
