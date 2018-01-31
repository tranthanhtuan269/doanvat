@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">CommentCurriculumVitae {{ $commentcurriculumvitae->id }}</div>
                    <div class="panel-body">

                        <a target="_self" href="{{ url('/user/comment-curriculum-vitae') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a target="_self" href="{{ url('/user/comment-curriculum-vitae/' . $commentcurriculumvitae->id . '/edit') }}" title="Edit CommentCurriculumVitae"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['user/commentcurriculumvitae', $commentcurriculumvitae->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete CommentCurriculumVitae',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $commentcurriculumvitae->id }}</td>
                                    </tr>
                                    <tr><th> User </th><td> {{ $commentcurriculumvitae->user }} </td></tr><tr><th> Curriculumvitae </th><td> {{ $commentcurriculumvitae->curriculumvitae }} </td></tr><tr><th> Description </th><td> {{ $commentcurriculumvitae->description }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
