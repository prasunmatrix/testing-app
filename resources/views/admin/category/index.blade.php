@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Category</h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Category Management</li>
    </ol>

    <div class="card mt-4">
        <div class="card-header">
            Category Listing <a href="{{ url('admin/add-category') }}" class="btn btn-primary btn-sm float-end">
                Add Category </a>
        </div>
        <div class="card-body">
            <!-- @if( session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
            @endif -->
            @if(Session::has('success'))
              <div class="alert alert-success alert-dismissable __web-inspector-hide-shortcut__">                      
                  <span style="color:green;">{{ Session::get('success') }}</span>
              </div>
            @endif
            @if(Session::has('error'))
              <div class="alert alert-danger alert-dismissable">
                  <span style="color:red;">{{ Session::get('error') }}</span>
              </div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @if( count($categories) > 0 )
                    @foreach( $categories as $val )
                    <tr>
                        <td> {{ $val->id }} </td>
                        <td> {{ $val->name }} </td>
                        <td>
                            <img src="{{ asset('uploads/category/'.$val->image) }}" alt="{{ $val->name }}" width="50"
                                height="50"> </img>
                        </td>
                        <td> {{ $val->status ==1 ? 'Show':'Hidden'}} </td>
                        <td> <a href="{{ url('admin/edit-category/'. $val->id) }}" class="btn btn-success"> Edit </a> | <a href="{{ url('admin/delete-category/'. $val->id) }}" class="btn btn-danger" onclick="return confirm('Are you want to delete this category ?');"> Delete </a>
                        </td>

                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection