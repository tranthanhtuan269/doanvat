@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Post #{{ $post->id }}</div>
                    <div class="panel-body">
                        <a href="{{ url('/post') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($post, [
                            'method' => 'PATCH',
                            'url' => ['/post', $post->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                {!! Form::label('title', 'Title', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-md-10">
                                    {!! Form::text('title', $post->title, ['class' => 'form-control']) !!}
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
                                    {!! Form::textarea('sub_description', $post->sub_description, ['class' => 'form-control']) !!}
                                    {!! $errors->first('sub_description', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                {!! Form::label('description', 'Description', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-md-10">
                                    {!! Form::textarea('description', $post->description, ['class' => 'form-control']) !!}
                                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
                                {!! Form::label('category', 'Category', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-md-10">
                                    {!! Form::select('category', \App\Category::pluck('name', 'id'), $post->category, ['placeholder' => 'Select A Category...', 'class' => 'form-control']) !!}
                                    {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
                                {!! Form::label('image', 'Image', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-md-10">
                                    @if($post->image)
                                    <img src="http://test.gmon.com.vn/?image={{ $post->image }}" id="avatar-image" class="img" style="background-color: #fff; border: 2px solid gray; border-radius: 5px; width: 100%; height: 300px;">
                                    @else
                                    <img src="http://test.gmon.com.vn/?image=anh_dai_dien.jpg" id="avatar-image" class="img" style="background-color: #fff; border: 2px solid gray; border-radius: 5px; width: 100%; height: 300px;">
                                    @endif
                                    <input type="file" name="imagePost" id="image-img" style="display: none;">
                                    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-2">
                                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                            <script src="{{ url('/') }}/public/templateEditor/ckeditor/ckeditor.js"></script>
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

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
