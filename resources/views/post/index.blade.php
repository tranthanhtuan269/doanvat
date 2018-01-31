@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Post</div>
                    <div class="panel-body">
                        <a href="{{ url('/post/create') }}" class="btn btn-success btn-sm" title="Add New Post">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/post', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search name...">
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
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Views</th>
                                        <th>Likes</th>
                                        <th>Category</th>
                                        <th>Keyword</th>
                                        @if(Auth::check() && (Auth::user()->id == 558))
                                        <th>Active</th>
                                        @endif
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($post as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td><a href="http://news.gmon.vn/?post={{ $item->id }}"> {{ $item->title }}</a></td>
                                        <td><img src="http://test.gmon.com.vn/?image={{ $item->image }}" height="300" width="100%"></td>
                                        <td>{{ $item->views }}</td>
                                        <td>{{ $item->likes }}</td>
                                        <td>{{ $item->categoryName }}</td>
                                        <td>{{ $item->keyword }}</td>
                                        @if(Auth::check() && (Auth::user()->id == 558))
                                        <td>
                                            <div class="btn btn-default btn-xs active-post @if($item->active==1) hidden-object @else show-object @endif" data-id="{{ $item->id }}">
                                            Unactive
                                            </div>
                                            <div class="btn btn-success btn-xs unactive-post @if($item->active==0) hidden-object @else show-object @endif" data-id="{{ $item->id }}">
                                            Active
                                            </div>
                                        </td>
                                        @endif
                                        <td>
                                            <!-- <a href="{{ url('/post/' . $item->id) }}" title="View Post"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a> -->
                                            <a href="{{ url('/post/' . $item->id . '/edit') }}" title="Edit Post"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/post', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Post',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $post->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
