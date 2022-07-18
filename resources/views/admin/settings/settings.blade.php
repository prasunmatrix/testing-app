@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Settings</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Settings</li>
  </ol>
  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">General Settings</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Social Settings</button>
    </li>
    <!-- <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
    </li> -->
  </ul>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">  
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

                <form method="POST" action="{{ route('admin.post-settings') }}" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="mb-3">
                      <label>Email</label>
                      <input type="email" name="email"  value="@if(!empty($settings)){{ $settings->email }} @endif" class="form-control" />
                      <span style="color:red;">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>Phone</label>
                      <input type="text" name="phone" value="@if(!empty($settings->phone)){{ $settings->phone }} @endif" maxlength="10" pattern="\d{10}"   class="form-control" />
                      <span style="color:red;">{{ $errors->first('phone') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>Header Current Logo</label>
                      @if(!empty($settings->header_logo))
                        <img src="@if(!empty($settings)) {{ asset('uploads/settings/'.$settings->header_logo) }} @endif" alt="" width="100" height="100"> </img><br/>
                      @else
                        <img src="{{ asset('uploads/no-image-found.jpg') }}" alt="" width="100" height="100"> </img><br/>
                      @endif  
                    </div>
                    <div class="mb-3">
                        <label>Header Logo</label>
                        <input type="file" name="header_logo" value="" class="form-control" />
                        <input type="hidden" name="header_logo_old" id="header_logo_old" value="@if(!empty($settings)) {{ $settings->header_logo }} @endif">
                    </div>
                    <div class="mb-3">
                      <label>Footer Current Logo</label>
                      @if(!empty($settings->footer_logo))
                        <img src="@if(!empty($settings)) {{ asset('uploads/settings/'.$settings->footer_logo) }} @endif" alt="" width="100" height="100"> </img><br/>
                      @else
                        <img src="{{ asset('uploads/no-image-found.jpg') }}" alt="" width="100" height="100"> </img><br/>
                      @endif
                    </div>
                    <div class="mb-3">
                      <label>Footer Logo</label>
                      <input type="file" name="footer_logo" value="" class="form-control" />
                      <input type="hidden" name="footer_logo_old" id="footer_logo_old" value="@if(!empty($settings)) {{ $settings->footer_logo }} @endif">
                    </div>
                    <div class="col-md-3">
                      <!-- <button type="submit" class="btn btn-primary"> Save Category </button> -->
                      <input type="hidden" name="settings_id" value="@if(!empty($settings)){{ $settings->id }} @endif" />
                      <input type="submit" class="btn btn-primary" name="save" value="Save" />
                    </div> 
                </form>
            </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
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

                  <form method="POST" action="{{ route('admin.post-settings-social') }}" enctype="multipart/form-data" autocomplete="off">
                      @csrf
                      <div class="mb-3">
                        <label>Facebook</label>
                        <input type="text" name="facebook"  value="@if(!empty($settings)){{ $settings->facebook }} @endif" class="form-control" />
                        <span style="color:red;">{{-- $errors->first('facebook') --}}</span>
                      </div>
                      <div class="mb-3">
                        <label>Youtube</label>
                        <input type="text" name="youtube" value="@if(!empty($settings)){{ $settings->youtube }} @endif" class="form-control" />
                        <span style="color:red;">{{-- $errors->first('phone') --}}</span>
                      </div>
                      <div class="mb-3">
                        <label>Linkedin</label>
                        <input type="text" name="linkedin" value="@if(!empty($settings)){{ $settings->linkedin }} @endif" class="form-control" />
                        <span style="color:red;">{{-- $errors->first('phone') --}}</span>
                      </div>
                      <div class="mb-3">
                        <label>Instagram</label>
                        <input type="text" name="instagram" value="@if(!empty($settings)){{ $settings->instagram }} @endif" class="form-control" />
                        <span style="color:red;">{{-- $errors->first('phone') --}}</span>
                      </div>
                      <div class="mb-3">
                        <label>Twitter</label>
                        <input type="text" name="twitter" value="@if(!empty($settings)){{ $settings->twitter }} @endif" class="form-control" />
                        <span style="color:red;">{{-- $errors->first('phone') --}}</span>
                      </div>
                      <div class="col-md-3">
                        <!-- <button type="submit" class="btn btn-primary"> Save Category </button> -->
                        <input type="hidden" name="settings_id" value="@if(!empty($settings)){{ $settings->id }} @endif" />
                        <input type="submit" class="btn btn-primary" name="save" value="Save" />
                      </div> 
                  </form>
              </div>
          </div>
      </div>
    </div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
      Testing666
    </div>
  </div>
</div>
@endsection