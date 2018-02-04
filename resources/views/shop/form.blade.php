<div class="form-group {{ $errors->has('user') ? 'has-error' : ''}}">
    {!! Form::label('user', 'User', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('user', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('user', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('banner') ? 'has-error' : ''}}">
    {!! Form::label('banner', 'Banner', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('banner', null, ['class' => 'form-control']) !!}
        {!! $errors->first('banner', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('logo') ? 'has-error' : ''}}">
    {!! Form::label('logo', 'Logo', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('logo', null, ['class' => 'form-control']) !!}
        {!! $errors->first('logo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sub_name') ? 'has-error' : ''}}">
    {!! Form::label('sub_name', 'Sub Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('sub_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('sub_name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('tax_code') ? 'has-error' : ''}}">
    {!! Form::label('tax_code', 'Tax Code', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('tax_code', null, ['class' => 'form-control']) !!}
        {!! $errors->first('tax_code', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sologan') ? 'has-error' : ''}}">
    {!! Form::label('sologan', 'Sologan', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('sologan', null, ['class' => 'form-control']) !!}
        {!! $errors->first('sologan', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('size') ? 'has-error' : ''}}">
    {!! Form::label('size', 'Size', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('size', null, ['class' => 'form-control']) !!}
        {!! $errors->first('size', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('jobs') ? 'has-error' : ''}}">
    {!! Form::label('jobs', 'Jobs', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('jobs', null, ['class' => 'form-control']) !!}
        {!! $errors->first('jobs', '<p class="help-block">:message</p>') !!}
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
</div><div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    {!! Form::label('address', 'Address', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('address', null, ['class' => 'form-control']) !!}
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('description', null, ['class' => 'form-control']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
    {!! Form::label('images', 'Images', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('images', null, ['class' => 'form-control']) !!}
        {!! $errors->first('images', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
