<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Redirect;
use Validator;
use Hash;


class AdminController extends Controller
{
  public function index(Request $request)
  {
    //dd('test');
    $this->data['page_title'] = 'Control Panel:Login';
    $this->data['panel_title'] = 'Control Panel:Login';
    if (Auth::guard('admin')->check()) {
        // If admin is logged in, redirect him to dashboard page //
        return \Redirect::route('admin.dashboard');
    } else {
        return view('admin.login.admin_login', $this->data);
    }
  }
  public function verifylogin(Request $request)
  {
    //dd('test');
    if (Auth::guard('admin')->check()) {
        // If admin is logged in, redirect him/her to dashboard page //
        return Redirect::Route('admin.dashboard');
    } else {
        try {
            if ($request->isMethod('post')) {
                // Checking validation
                $validationCondition = array(
                    'email' => 'required',
                    'password' => 'required',
                );
                $Validator = Validator::make($request->all(), $validationCondition);

                if ($Validator->fails()) {
                    // If validation error occurs, load the error listing
                    return Redirect::route('admin.login')->withErrors($Validator);
                } else {
                    $rememberMe = false; // set default boolean value for remember me

                    if ($request->input('remember_me')) // if user checked remember me
                        $rememberMe = true; // set user value

                    $email = $request->input('email');
                    $password = $request->input('password');

                    /* Check if user with same email exists, who is:-
                    1. Blocked or Not
                      */
                    $userExists = User::where(
                        array(
                            'email' => $email,
                            'status' => 'A',
                        ))->where(function ($query) {
                        $query->where('usertype', 'S')->orWhere('usertype', 'SA');
                    })->count();


                    if ($userExists > 0) {
                        // if user exists, check the password
                        $auth = auth()->guard('admin')->attempt([
                            'email' => $email,
                            'password' => $password,
                        ], $rememberMe);

                        if ($auth) {
                            return Redirect::Route('admin.dashboard');
                        } else {
                            $request->session()->flash('error', 'Invalid Password');
                            return Redirect::Route('admin.login');
                        }
                    } else {
                        $request->session()->flash('error', 'You are not an authorized user');
                        return Redirect::Route('admin.login');
                    }
                }
            }
        } catch (Exception $e) {
            return Redirect::Route('admin.login')->with('error', $e->getMessage());
        }
    }
  }
  public function dashboardView()
  {
    $this->data['page_title'] = 'Admin | Dashboard';
    $this->data['panel_title'] = 'Admin Dashboard';
    // $this->data['total_user']=User::where('is_deleted','=','N')
    //                         ->where('usertype','=','FU')
    //                         ->get()
    //                         ->count();
    // $this->data['total_shipment']=Mastershipment::where('is_deleted','=','N')
    //                             ->get()
    //                             ->count();
    return view('admin.dashboard.index', $this->data);
  }
  public function logout()
  {
    // echo "aaa";die;
    if (Auth::guard('admin')->logout()) {
        return Redirect::Route('admin.login');
    } else {
        return Redirect::Route('admin.dashboard');
    }
  }
  public function register(Request $request)
  {
    $this->data['page_title'] = 'Admin:Registration';
    $this->data['panel_title'] = 'Admin:Registration';
    if (Auth::guard('admin')->check()) {
        // If admin is logged in, redirect him to dashboard page //
        return \Redirect::route('admin.dashboard');
    } else {
        return view('admin.register.register', $this->data);
    }
  }
  public function postRegister(Request $request){
    //dd($request->all());  
    $validator = Validator::make($request->all(), 
    [
      'first_name'             => 'required',
      'last_name'              => 'required',
      //'business_name'          => 'required',
      'email'                => 'required|email|unique:users',
      //'phone'           => 'required|min:10|max:10|unique:users',
      //'password'              => 'required|confirmed|min:8',
      'password'              => 'required|min:8',
      'confirm_password'       => 'same:password',
    ],
    [      
      'required' => 'The :attribute field is required',
      'email.unique'   => 'This email has already been registered',
      'email'    => 'This is not a valid email format',
      //'phone.unique'   => 'This phone number has already been taken',
      //'phone.min' => 'Phone Number has to be :min chars long',
      //'phone.max' => 'Phone Number can be maximum :max chars long',
      'password.min' => 'Password must be at least :min characters',
      //'password.confirmed' => 'Password & Confirm Password must be same',
      'confirm_password.same' => 'Password & Confirm Password must be same', 
    ]);

    if ($validator->fails()) {
      /*echo 'Failed';
      exit();*/
      return Redirect::back()
                  ->withErrors($validator)
                  ->withInput();
    } else {
      $first_name = trim($request->get('first_name'));
      $last_name = trim($request->get('last_name'));
      $business_name = trim($request->get('business_name'));
      $email = trim($request->get('email'));
      //$phone = trim($request->get('phone'));
      $password = trim($request->get('password'));
      $fullname=$first_name." ".$last_name;

      $adminUser = User::create([
        'name'=>$fullname,
        'company_name'=>$business_name,
        'email'=>$email,
        'usertype'=>'SA',
        'password'=>$password,
        'status'=>'A' 
      ]);
      if ($adminUser != null) {
          // $token = Str::random(60);
          // $frontendUser->userkey = $token;
          // $frontendUser->save();
          
          // $data['token'] = $token;
          // $data['email'] = $frontendUser->email;
          // //dd($data);
          // //Mail::to($email)->send(new FrontEndUserWelcomeMail($data));
          // Mail::send('email.frontenduser-email-register', $data, function($message) use ($data)
          //   {
          //       $message->from('no-reply@mellobridge.com', "Mello Bridge");
          //       $message->subject("Welcome to Mello Bridge");
          //       $message->to($data['email']);
          //   });
          //$successMsg = 'Thank you '.$adminUser->name.'. PLEASE CHECK YOUR EMAIL to confirm your email address';
          $successMsg = 'Thank you '.$adminUser->name.' for your registration,please login with your credential.';
          return Redirect::back()
                  ->withSuccess($successMsg);
          
      } else {
          $errMsg = array();
          $errMsg['registrationerror'] = 'Something went wrong, please try again';
          return Redirect::back()
                  ->withErrors($errMsg)
                  ->withInput();
      }
    }
  }
  public function showChangePasswordForm()
  {
    $this->data['page_title'] = 'Admin | Change Password';
    $this->data['panel_title'] = 'Change Password';      
    return view('admin.dashboard.changepassword', $this->data);
  }
  public function changePassword(Request $request)
  {
    //dd($request->all());
    if (!(Hash::check($request->get('current_password'), Auth::guard('admin')->user()->password))) {
      // The passwords matches
      return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
    } else {
      try {

          $validationCondition = [
              'new_password' => 'required',
              'confirm_password' => 'required|same:new_password',
          ];

          $validationMessages = array(
              'new_password.required' => 'New Password is required.',
              'confirm_password.required' => 'Confirm Password is required.',
              'confirm_password.same' => 'Confirm Password should be same as new password.',
          );

          $Validator = Validator::make($request->all(), $validationCondition, $validationMessages);
          if ($Validator->fails()) {
              // If validation error occurs, load the error listing
              return redirect()->back()->withErrors($Validator);
          } else {
              $user = User::findOrFail(Auth::guard('admin')->user()->id);
              $user->password = $request->new_password;
              $saveResposne = $user->save();
              if ($saveResposne == true) {
                  return redirect()->back()->with("success", "Password changed successfully !");
              } else {
                  return redirect()->back()->with("error", "Password changed successfully !");
              }
          }

      } catch (Exception $e) {
          return Redirect::Route('admin.changePassword')->with('error', $e->getMessage());
      }
    }
  }
}
