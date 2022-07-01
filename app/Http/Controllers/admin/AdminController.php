<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Redirect;
use Validator;


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
}
