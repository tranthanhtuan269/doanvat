@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.Msidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">District</div>
                    <div class="panel-body">
                        <a target="_self" href="{{ url('/admin/district/create') }}" class="btn btn-success btn-sm" title="Add New District">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">ID</th>
                                        <th style="width: 40%">Name</th>
                                        <th style="width: 40%">City</th>
                                        <th style="width: 10%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($districts as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->city }}</td>
                                        <td>
                                            <div class="btn btn-default btn-xs active-district @if($item->active==1) hidden-object @else show-object @endif" data-id="{{ $item->id }}">
                                            Unactive
                                            </div>
                                            <div class="btn btn-success btn-xs unactive-district @if($item->active==0) hidden-object @else show-object @endif" data-id="{{ $item->id }}">
                                            Active
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $districts->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
