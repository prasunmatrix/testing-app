@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Add Category</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Add a new category</li>
    </ol>
    <div class="container-fluid px-4">

        <div class="card mt-4">
            <div class="card-body">
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

                <form method="POST" action="{{ route('admin.add-category.post') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label>Category Name</label>
                      <input type="text" name="name" value="{{old('name')}}"  class="form-control" />
                      <span style="color:red;">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>Category Slug</label>
                      <input type="text" name="slug" value="{{old('slug')}}"  class="form-control" />
                      <span style="color:red;">{{ $errors->first('slug') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>Description</label>
                      <textarea name="description" rows="5"  class="form-control">{{old('description')}}</textarea>
                      <span style="color:red;">{{ $errors->first('description') }}</span>
                    </div>
                    <div class="mb-3">
                        <label>Category Image</label>
                        <input type="file" name="image" value="{{old('image')}}" class="form-control" />
                    </div>

                    <h6>SEO Tags</h6>
                    <div class="mb-3">
                        <label>Meta Title</label>
                        <input type="text" name="meta_title" value="{{old('meta_title')}}" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label>Meta Description</label>
                        <textarea name="meta_description" rows="3" class="form-control">{{old('meta_description')}}</textarea>
                    </div>

                    <div class="mb-3">
                        <label>Meta Keywords</label>
                        <textarea name="meta_keyword" rows="3" class="form-control">{{old('meta_keyword')}}</textarea>
                    </div>

                    <h6>Status Mode</h6>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Navbar Status</label>
                            <input type="checkbox" name="navbar_status" value="1" />
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Status</label>
                            <input type="checkbox" name="status" value="1" />
                        </div>
                        <div class="col-md-6">
                          <!-- <button type="submit" class="btn btn-primary"> Save Category </button> -->
                          <input type="submit" class="btn btn-primary" name="save_category" value="Save Category" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection