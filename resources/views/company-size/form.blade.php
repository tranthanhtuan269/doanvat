<div class="form-group {{ $errors->has('size') ? 'has-error' : ''}}">
    {!! Form::label('size', 'Size', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('size', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('size', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
