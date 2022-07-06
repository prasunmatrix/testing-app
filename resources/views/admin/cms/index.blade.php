@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">CMS</h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">CMS Management</li>
    </ol>

    <div class="card mt-4">
        <div class="card-header">
            CMS Listing <a href="{{ url('admin/add-cms') }}" class="btn btn-primary btn-sm float-end">
                Add CMS </a>
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
            <table class="table table-bordered" id="datatablesSimple">
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
                    @if( count($cmsList) > 0 )
                    @foreach( $cmsList as $key=>$val )
                    <tr>
                        <td> {{ $key+1 }} </td>
                        <td> {{ $val->name }} </td>
                        <td>
                            <img src="{{ asset('uploads/cms/'.$val->image) }}" alt="{{ $val->name }}" width="50"
                                height="50"> </img>
                        </td>
                        <td> {{ $val->status ==1 ? 'Show':'Hidden'}} </td>
                        <td> <a href="{{ url('admin/edit-cms/'. $val->id) }}" class="btn btn-success"> Edit </a> | <a href="{{ url('admin/delete-cms/'. $val->id) }}" class="btn btn-danger" onclick="return confirm('Are you want to delete this cms?');"> Delete </a>
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