<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Auth;
use Redirect;
use Validator;

class SettingsController extends Controller
{
  public function index()
  {
    $this->data['page_title'] = 'Admin | Settings';
    $this->data['settings']=Settings::orderBy('id', 'DESC')->first();
    return view('admin.settings.settings', $this->data);
  }
  public function postSettings(Request $request)
  {
    $count=Settings::count();
    //dd($count);
    if($count==0)
    {
      //dd($request->all());
      $email= $request->email;
      $phone = $request->phone;
      $header_logo= $request->header_logo;
      $footer_logo = $request->footer_logo;

      if ($request->hasFile('header_logo')) :
        $file = $request->file('header_logo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads/settings', $filename);
        //$image = $filename;
      endif;
      if(!empty($filename))
      {
        $header_logo = $filename;
      }
      else
      {
        $header_logo="";
      }
      if ($request->hasFile('footer_logo')) :
        $file1 = $request->file('footer_logo');
        $filename1 = time() . '.' . $file1->getClientOriginalExtension();
        $file1->move('uploads/settings', $filename1);
        //$image = $filename;
      endif;
      if(!empty($filename1))
      {
        $footer_logo = $filename1;
      }
      else
      {
        $footer_logo="";
      }
      $settings=Settings::create([
        'email'=>$email,
        'phone'=>$phone,
        'header_logo'=>$header_logo,
        'footer_logo'=>$footer_logo
      ]);
      if ($settings != null) {
          
        $successMsg = 'Settings Updated Successfully';
        return Redirect('admin/settings')
                ->withSuccess($successMsg);    
      }
    }
    else
    {

    }
  }
}
