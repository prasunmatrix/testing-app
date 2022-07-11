@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Update Photo Gallery</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Update Photo Gallery</li>
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

                <form method="POST" action="{{ route('admin.update.photogallery',$photogallery->id ) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" value="{{ $photogallery->title }}" class="form-control" />
                        <span style="color:red;">{{ $errors->first('title') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>Description</label>
                      <textarea name="description" rows="5"  class="form-control textarea">{{ $photogallery->description }}</textarea>
                      <span style="color:red;">{{ $errors->first('description') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>Display Title</label>
                      <input type="text" name="display_title" value="{{ $photogallery->display_title }}"  class="form-control" />
                      <span style="color:red;">{{ $errors->first('display_title') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>Gallery Type/Place</label>
                      <select name="position" id="position"  class="form-control">
                        <option value="">Select Type/Place</option>
                        @if(!empty($categoryList))
                          @foreach($categoryList as $category)
                          <option value="{{ $category->id }}" @if($category->id==$photogallery->position) selected @endif)>{{ $category['name'] }}</option>
                          @endforeach
                        @endif  
                      </select>
                      <span style="color:red;">{{ $errors->first('position') }}</span>
                    </div>
                    {{--
                    <div class="mb-3">
                        <img src="{{ asset('uploads/cms/'.$cms->image) }}" alt="{{ $cms->name }}" width="100"
                                height="100"> </img><br/>
                        <label>Category Image</label>
                        <input type="file" name="image" class="form-control" />
                        <input type="hidden" name="cms_old_image" id="cms_old_image" value="{{ $cms->image }}">
                    </div>
                     --}}
                    <div class="mb-3 homeImages" >
                      @foreach ($photoGalleryImage as $data )
                        {{-- @php $chkd = ''; if ($data->is_checked == 'Y') $chkd = 'checked'; @endphp --}}
                        <div id="{{ 'imageDiv'.$data->id.'' }}" class="col-sm-3">
                          <img src="{{ asset('uploads/gallery/'.$data->image.'') }}" alt="" height="100" width="100%" id="brand_icon">
                          <div style="margin-top: 5px;">
                            <div class="row">
                              <div class="col-sm-6">
                                <button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="{{ $data->id }}" data-encrypt="{{ encrypt($data->id) }}">Delete</button>
                              </div>
                              <div class="col-sm-6">
                                <div style="text-align: right">
                                <!--   <input type="checkbox" name="galleryImage[{{-- $data->id --}}]" value="Y" {{-- $chkd --}} /> -->
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                    <div class="mb-3">
                      <label>Image</label>
                      <input type="file" name="galley_images[]" id="galley_images" value="" class="form-control" multiple />
                      <span class="system required" style="color: red;">(Recommended Image Size: 800 &times; 600)*</span><br>
                      <span style="color:red;">{{ $errors->first('galley_images.*') }}</span>  
                    <h6>Status Mode</h6>
                    <div class="row">
                        <div class="col-md-6 mb-6">
                            <label>Status</label>
                            <input type="checkbox" name="status" value="1"@if($photogallery->status==1) checked @endif />
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
@push('custom-scripts')
<script>
// $("#image").change(function() {
//     //readURL(this);
//     alert('galley_images');
//   });
</script>  
@endpush