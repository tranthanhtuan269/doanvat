<script src="{{ url('/') }}/public/templateEditor/ckeditor/ckeditor.js"></script>
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('keyword') ? 'has-error' : ''}}">
    {!! Form::label('keyword', 'Keyword', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('keyword', null, ['class' => 'form-control']) !!}
        {!! $errors->first('keyword', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('sub_description') ? 'has-error' : ''}}">
    {!! Form::label('sub_description', 'Sub Description', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::textarea('sub_description', null, ['class' => 'form-control']) !!}
        {!! $errors->first('sub_description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
    {!! Form::label('category', 'Category', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('category', \App\Category::pluck('name', 'id'), null, ['placeholder' => 'Select A Category...', 'class' => 'form-control']) !!}
        {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        <img src="http://test.gmon.com.vn/?image=anh_dai_dien.jpg" id="avatar-image" class="img" style="background-color: #fff; border: 2px solid gray; border-radius: 5px; width: 100%; height: 300px;">
        <input type="file" name="imagePost" id="image-img" style="display: none;">
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-2 col-md-2">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

<script>
    CKEDITOR.replace( 'description', {
        'filebrowserBrowseUrl' : '{{ url("/") }}/public/templateEditor/kcfinder/browse.php?opener=ckeditor&type=files',
        'filebrowserImageBrowseUrl' : '{{ url("/") }}/public/templateEditor/kcfinder/browse.php?opener=ckeditor&type=images',
        'filebrowserFlashBrowseUrl' : '{{ url("/") }}/public/templateEditor/kcfinder/browse.php?opener=ckeditor&type=flash',
        'filebrowserUploadUrl' : '{{ url("/") }}/public/templateEditor/kcfinder/upload.php?opener=ckeditor&type=files',
        'filebrowserImageUploadUrl' : '{{ url("/") }}/public/templateEditor/kcfinder/upload.php?opener=ckeditor&type=images',
        'filebrowserFlashUploadUrl' : '{{ url("/") }}/public/templateEditor/kcfinder/upload.php?opener=ckeditor&type=flash'
    } );
    CKEDITOR.replace( 'sub_description', {
        'filebrowserBrowseUrl' : '{{ url("/") }}/public/templateEditor/kcfinder/browse.php?opener=ckeditor&type=files',
        'filebrowserImageBrowseUrl' : '{{ url("/") }}/public/templateEditor/kcfinder/browse.php?opener=ckeditor&type=images',
        'filebrowserFlashBrowseUrl' : '{{ url("/") }}/public/templateEditor/kcfinder/browse.php?opener=ckeditor&type=flash',
        'filebrowserUploadUrl' : '{{ url("/") }}/public/templateEditor/kcfinder/upload.php?opener=ckeditor&type=files',
        'filebrowserImageUploadUrl' : '{{ url("/") }}/public/templateEditor/kcfinder/upload.php?opener=ckeditor&type=images',
        'filebrowserFlashUploadUrl' : '{{ url("/") }}/public/templateEditor/kcfinder/upload.php?opener=ckeditor&type=flash'
    } );
</script>