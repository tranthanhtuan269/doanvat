@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">CurriculumVitae {{ $curriculumvitae->id }}</div>
                    <div class="panel-body">

                        <a target="_self" href="{{ url('/admin/curriculum-vitae') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a target="_self" href="{{ url('/admin/curriculum-vitae/' . $curriculumvitae->id . '/edit') }}" title="Edit CurriculumVitae"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/curriculumvitae', $curriculumvitae->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete CurriculumVitae',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $curriculumvitae->id }}</td>
                                    </tr>
                                    <tr><th> User </th><td> {{ $curriculumvitae->user }} </td></tr><tr><th> Avatar </th><td> {{ $curriculumvitae->avatar }} </td></tr><tr><th> Birthday </th><td> {{ $curriculumvitae->birthday }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
