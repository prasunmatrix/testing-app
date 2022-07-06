@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Update Category</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Update Category</li>
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

                <form method="POST" action="{{ route('admin.update.put',$category->id ) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Category Name</label>
                        <input type="text" name="name" value="{{ $category->name }}" required class="form-control" />
                        <span style="color:red;">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="mb-3">
                        <label>Category Slug</label>
                        <input type="text" name="slug" value="{{ $category->slug }}" required class=" form-control" />
                        <span style="color:red;">{{ $errors->first('slug') }}</span>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" rows="5" class="form-control" required> {{ $category->description }}
                        </textarea>
                        <span style="color:red;">{{ $errors->first('description') }}</span>
                    </div>
                    <div class="mb-3">
                        <img src="{{ asset('uploads/category/'.$category->image) }}" alt="{{ $category->name }}" width="100"
                                height="100"> </img><br/>
                        <label>Category Image</label>
                        <input type="file" name="image" class="form-control" />
                        <input type="hidden" name="category_old_image" id="category_old_image" value="{{ $category->image }}">
                    </div>

                    <h6>SEO Tags</h6>
                    <div class="mb-3">
                        <label>Meta Title</label>
                        <input type="text" name="meta_title" value="{{ $category->meta_title }}" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label>Meta Description</label>
                        <textarea name="meta_description" rows="3" class="form-control"> {{ $category->meta_description }}
                        </textarea>
                    </div>

                    <div class="mb-3">
                        <label>Meta Keywords</label>
                        <textarea name="meta_keyword" rows="3" class="form-control">{{ $category->meta_keyword }}</textarea>
                    </div>

                    <h6>Status Mode</h6>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Navbar Status</label>
                            <input type="checkbox" name="navbar_status" value="1"@if($category->navbar_status==1) checked @endif />
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Status</label>
                            <input type="checkbox" name="status" value="1"@if($category->status==1) checked @endif />
                        </div>
                        <div class="col-md-6">
                          <!-- <button type="submit" class="btn btn-primary"> Save Category </button> -->
                          <input type="submit" class="btn btn-primary" name="update_category" value="Update Category" />
                        </div>
                    </div>
                </form>

            </div>


        </div>

    </div>
</div>

@endsection