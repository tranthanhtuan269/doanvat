<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('description', null, ['class' => 'form-control']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('star') ? 'has-error' : ''}}">
    {!! Form::label('star', 'Star', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('star', null, ['class' => 'form-control']) !!}
        {!! $errors->first('star', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('company') ? 'has-error' : ''}}">
    {!! Form::label('company', 'Company', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('company', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
