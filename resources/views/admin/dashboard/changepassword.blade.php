@extends('admin.layouts.after-login-layout')
@section('unique-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Change Password</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Change Password</li>
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

                <form method="POST" action="{{ route('admin.changePassword') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label>Current Password</label>
                      <input type="password" name="current_password" id="current_password" value="" required  class="form-control" />
                      <span style="color:red;">{{ $errors->first('current_password') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>New Password</label>
                      <input type="password" name="new_password" id="new_password" value="" required  class="form-control" />
                      <span style="color:red;">{{ $errors->first('new_password') }}</span>
                    </div>
                    <div class="mb-3">
                      <label>Confirm New Password</label>
                      <input type="password" name="confirm_password" id="confirm_password" value="" required  class="form-control" />
                      <span style="color:red;">{{ $errors->first('confirm_password') }}</span>
                    </div>
                    <div class="col-md-6">
                      <!-- <button type="submit" class="btn btn-primary"> Save Category </button> -->
                      <input type="submit" class="btn btn-primary" name="change_password" value="Change Password" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')

@endpush