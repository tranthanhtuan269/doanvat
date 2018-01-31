@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Curriculumvitae</div>
                    <div class="panel-body">
                        <a target="_self" href="{{ url('/admin/curriculum-vitae/create') }}" class="btn btn-success btn-sm" title="Add New CurriculumVitae">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/curriculum-vitae', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
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
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">User</th>
                                        <th style="text-align: center;">Avatar</th>
                                        <th style="text-align: center;">VIP</th>
                                        <th style="text-align: center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($curriculumvitae as $item)
                                    <tr>
                                        <td style="text-align: center;"><a href="{{ url('/') }}/curriculumvitae/view/{{ $item->id }}">{{ $item->id }}</a></td>
                                        <td style="text-align: center;">
                                        <a href="{{ url('/') }}/curriculumvitae/view/{{ $item->id }}">{{ $item->name }}</a>
                                        <div>Email: {{ $item->email }}</div>
                                        <div>Số điện thoại: {{ $item->phone }}</div>
                                        </td>
                                        <td style="text-align: center;"><a href="{{ url('/') }}/curriculumvitae/view/{{ $item->id }}"><img src="http://test.gmon.com.vn/?image={{ $item->avatar }}" id="avatar-image" class="img" style="height: 150px; width: 150px; background-color: #fff; border: 2px solid gray; border-radius: 5px;"></a></td>
                                        <td style="text-align: center;">
                                            <div class="btn btn-default btn-xs vip-cv @if($item->vip==1) hidden-object @else show-object @endif" data-id="{{ $item->id }}">
                                            Unvip
                                            </div>
                                            <div class="btn btn-success btn-xs unvip-cv @if($item->vip==0) hidden-object @else show-object @endif" data-id="{{ $item->id }}">
                                            Vip
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <a target="_self" href="{{ url('/admin/curriculum-vitae/' . $item->id . '/edit') }}" title="Edit CurriculumVitae"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/curriculum-vitae', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete CurriculumVitae',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $curriculumvitae->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
