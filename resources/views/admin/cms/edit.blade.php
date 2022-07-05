@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Update CMS</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Update CMS</li>
    </ol>
    <div class="container-fluid px-4">

        <div class="card mt-4">
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    {{$error}}
                    @endforeach
                </div>
                @endif

                <form method="POST" action="{{ route('admin.update.cms',$cms->id ) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Category Name</label>
                        <input type="text" name="name" value="{{ $cms->name }}" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Category Slug</label>
                        <input type="text" name="slug" value="{{ $cms->slug }}" class=" form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" rows="5" class="form-control"> {{ $cms->description }}
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <img src="{{ asset('uploads/cms/'.$cms->image) }}" alt="{{ $cms->name }}" width="100"
                                height="100"> </img><br/>
                        <label>Category Image</label>
                        <input type="file" name="image" class="form-control" />
                        <input type="hidden" name="cms_old_image" id="cms_old_image" value="{{ $cms->image }}">
                    </div>

                    <h6>SEO Tags</h6>
                    <div class="mb-3">
                        <label>Meta Title</label>
                        <input type="text" name="meta_title" value="{{ $cms->meta_title }}" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label>Meta Description</label>
                        <textarea name="meta_description" rows="3" class="form-control"> {{ $cms->meta_description }}
                        </textarea>
                    </div>

                    <div class="mb-3">
                        <label>Meta Keywords</label>
                        <textarea name="meta_keyword" rows="3" class="form-control">{{ $cms->meta_keyword }}</textarea>
                    </div>

                    <h6>Status Mode</h6>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Navbar Status</label>
                            <input type="checkbox" name="navbar_status" value="1"@if($cms->navbar_status==1) checked @endif />
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Status</label>
                            <input type="checkbox" name="status" value="1"@if($cms->status==1) checked @endif />
                        </div>
                        <div class="col-md-6">
                          <!-- <button type="submit" class="btn btn-primary"> Save Category </button> -->
                          <input type="submit" class="btn btn-primary" name="update_cms" value="Update CMS" />
                        </div>
                    </div>
                </form>

            </div>


        </div>

    </div>
</div>

@endsection