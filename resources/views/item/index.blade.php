@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Job</div>
                    <div class="panel-body">
                        <a target="_self" href="{{ url('/admin/job/create') }}" class="btn btn-success btn-sm" title="Add New Job">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/job', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Expiration Date</th>
                                        <th>City</th>
                                        <th>VIP</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($job as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td><a href="{{ url('/') }}//job/view/{{ $item->id }}">{{ $item->name }}</a> <br /> tại {{ $item->company }}</td>
                                        <td>{{ $item->expiration_date }}</td>
                                        <td>{{ $item->city }}</td>
                                        <td>
                                            <div class="btn btn-danger btn-xs vip-job @if($item->vip==2) show-object @else hidden-object @endif" data-id="{{ $item->id }}">
                                            Vip2
                                            </div>
                                            <div class="btn btn-default btn-xs vip2-job @if($item->vip==0) show-object @else hidden-object @endif" data-id="{{ $item->id }}">
                                            Unvip
                                            </div>
                                            <div class="btn btn-success btn-xs unvip-job @if($item->vip==1) show-object @else hidden-object @endif" data-id="{{ $item->id }}">
                                            Vip
                                            </div>
                                        </td>
                                        <td>
                                            <a target="_self" href="{{ url('/admin/job/' . $item->id . '/edit') }}" title="Edit Job"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/job', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Job',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $job->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
