<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{PhotoGallery,Category};
use Illuminate\Support\Facades\File;
use Auth;
use Redirect;
use Validator;

class PhotoGalleryController extends Controller
{
  public function index()
  {
    $this->data['page_title'] = 'Admin | Photo Gallery';
    $photoGalleryList = PhotoGallery::where('is_deleted','0')->get();
    $this->data['photoGalleryList']=$photoGalleryList;
    return view('admin.photogallery.index', $this->data);
  }
  public function create()
  {
    $this->data['page_title'] = 'Admin | Photo Gallery';
    $this->data['panel_title'] = 'Admin Photo Gallery';
    $categoryList = Category::where('is_deleted','0')->where('status','1')->get();
    //dd($categoryList);
    $this->data['categoryList']=$categoryList;
    return view('admin.photogallery.create',$this->data);
  }
  public function store(Request $request)
  {
    //dd($request->all());
    $validator = Validator::make($request->all(), 
    [
      'title'             => 'required|string|max:200',
      'description'       => 'required',
      'display_title'     => 'required|string|max:200',
      'position'          => 'required',
      'image'             => 'required|mimes:jpeg,jpg,png',
      'status'            => 'nullable'
    ],
    [      
      'required' => 'The :attribute field is required',
      'title.max' => 'title can be maximum :max chars long',
      'display_title.max' => 'display title can be maximum :max chars long',
      'position'=>'please select the type/place' 
    ]);
    if ($validator->fails()) {
      /*echo 'Failed';
      exit();*/
      return Redirect::back()
                  ->withErrors($validator)
                  ->withInput();
    } else {

    }  
  }
}
