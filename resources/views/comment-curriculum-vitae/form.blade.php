<div class="form-group {{ $errors->has('user') ? 'has-error' : ''}}">
    {!! Form::label('user', 'User', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('user', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('user', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('curriculumvitae') ? 'has-error' : ''}}">
    {!! Form::label('curriculumvitae', 'Curriculumvitae', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('curriculumvitae', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('curriculumvitae', '<p class="help-block">:message</p>') !!}
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
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
