<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Auth;
use Redirect;
use Validator;

class CategoryController extends Controller
{
  public function create()
  {
    $this->data['page_title'] = 'Admin | Add Category';
    $this->data['panel_title'] = 'Admin Add Category';
    return view('admin.category.create',$this->data);
  }
  public function store(Request $request){
    //dd($request->all());  
    $validator = Validator::make($request->all(), 
    [
      'name'              => 'required|string|max:200',
      'slug'              => 'required|string|max:200',
      'description'       => 'required',
      'image'             => 'nullable|mimes:jpeg,jpg,png',
      'meta_title'        => 'nullable|string|max:200',
      'meta_description'  => 'nullable|string',
      'meta_keyword'      => 'nullable|string',
      'navbar_status'     => 'nullable',
      'status'            => 'nullable'
    ],
    [      
      'required' => 'The :attribute field is required',
      'name.max' => 'name can be maximum :max chars long',
      'slug.max' => 'slug can be maximum :max chars long', 
    ]);
    if ($validator->fails()) {
      /*echo 'Failed';
      exit();*/
      return Redirect::back()
                  ->withErrors($validator)
                  ->withInput();
    } else {
          $name= $request->name;
          $slug = $request->slug;
          $description = $request->description;

        if ($request->hasFile('image')) :
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/category', $filename);
            $image = $filename;
        endif;

        $category->meta_title = $data['meta_title'];
        $category->meta_description = $data['meta_description'];
        $category->meta_keyword = $data['meta_keyword'];
        $category->navbar_status = $request->navbar_status == true ? '1' : '0';
        $category->status = $request->status == true ? '1' : '0';
        $category->created_by = Auth::user()->id;
        $category->save();

      $adminUser = User::create([
        'name'=>$fullname,
        'company_name'=>$business_name,
        'email'=>$email,
        'usertype'=>'SA',
        'password'=>$password,
        'status'=>'A' 
      ]);
      if ($adminUser != null) {
          
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
}
