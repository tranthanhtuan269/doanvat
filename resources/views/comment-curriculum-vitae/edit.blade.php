@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit CommentCurriculumVitae #{{ $commentcurriculumvitae->id }}</div>
                    <div class="panel-body">
                        <a target="_self" href="{{ url('/user/comment-curriculum-vitae') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($commentcurriculumvitae, [
                            'method' => 'PATCH',
                            'url' => ['/user/comment-curriculum-vitae', $commentcurriculumvitae->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('comment-curriculum-vitae.form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
