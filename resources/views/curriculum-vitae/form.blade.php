<div class="form-group {{ $errors->has('user') ? 'has-error' : ''}}">
    {!! Form::label('user', 'User', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('user', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('user', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('avatar') ? 'has-error' : ''}}">
    {!! Form::label('avatar', 'Avatar', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('avatar', null, ['class' => 'form-control']) !!}
        {!! $errors->first('avatar', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('birthday') ? 'has-error' : ''}}">
    {!! Form::label('birthday', 'Birthday', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::input('datetime-local', 'birthday', null, ['class' => 'form-control']) !!}
        {!! $errors->first('birthday', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">
    {!! Form::label('gender', 'Gender', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('gender', null, ['class' => 'form-control']) !!}
        {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
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
</div><div class="form-group {{ $errors->has('town') ? 'has-error' : ''}}">
    {!! Form::label('town', 'Town', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('town', null, ['class' => 'form-control']) !!}
        {!! $errors->first('town', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('education') ? 'has-error' : ''}}">
    {!! Form::label('education', 'Education', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('education', null, ['class' => 'form-control']) !!}
        {!! $errors->first('education', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('word_experience') ? 'has-error' : ''}}">
    {!! Form::label('word_experience', 'Word Experience', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('word_experience', null, ['class' => 'form-control']) !!}
        {!! $errors->first('word_experience', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('language') ? 'has-error' : ''}}">
    {!! Form::label('language', 'Language', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('language', null, ['class' => 'form-control']) !!}
        {!! $errors->first('language', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('interests') ? 'has-error' : ''}}">
    {!! Form::label('interests', 'Interests', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('interests', null, ['class' => 'form-control']) !!}
        {!! $errors->first('interests', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('references') ? 'has-error' : ''}}">
    {!! Form::label('references', 'References', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('references', null, ['class' => 'form-control']) !!}
        {!! $errors->first('references', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('qualification') ? 'has-error' : ''}}">
    {!! Form::label('qualification', 'Qualification', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('qualification', null, ['class' => 'form-control']) !!}
        {!! $errors->first('qualification', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('career_objective') ? 'has-error' : ''}}">
    {!! Form::label('career_objective', 'Career Objective', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('career_objective', null, ['class' => 'form-control']) !!}
        {!! $errors->first('career_objective', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
    {!! Form::label('images', 'Images', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('images', null, ['class' => 'form-control']) !!}
        {!! $errors->first('images', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('active') ? 'has-error' : ''}}">
    {!! Form::label('active', 'Active', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('active', null, ['class' => 'form-control']) !!}
        {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
