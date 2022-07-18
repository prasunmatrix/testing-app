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
  public function index()
  {
    $this->data['page_title'] = 'Admin | Category';
    $categories = Category::where('is_deleted','0')->get();
    $this->data['categories']=$categories;
    return view('admin.category.index', $this->data);
  }
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
            $file->move(public_path().'/uploads/category', $filename);
            //$image = $filename;
        endif;
        if(!empty($filename))
        {
          $image = $filename;
        }
        else
        {
          $image="";
        }
        $meta_title = $request->meta_title;
        $meta_description = $request->meta_description;
        $meta_keyword = $request->meta_keyword;
        $navbar_status = $request->navbar_status == true ? '1' : '0';
        //dd($navbar_status);
        $status = $request->status == true ? '1' : '0';
        $created_by = Auth::guard('admin')->user()->id;

      $category = Category::create([
        'name'=>$name,
        'slug'=>$slug,
        'description'=>$description,
        'image'=>$image,
        'meta_title'=>$meta_title,
        'meta_description'=>$meta_description,
        'meta_keyword'=>$meta_keyword,
        'navbar_status'=>$navbar_status,
        'status'=>$status,
        'created_by'=>$created_by 
      ]);
      if ($category != null) {
          
          $successMsg = 'Category Added Successfully';
          return Redirect('admin/category')
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
  public function edit($category_id)
  {
    $this->data['page_title'] = 'Admin | Update Category';
    $category = Category::find($category_id);
    $this->data['category']=$category;
    return view('admin.category.edit', $this->data);
  }
  public function update(Request $request, $category_id)
  {
    //dd($category_id);
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
    }
    else
    {
      $name= $request->name;
      $slug = $request->slug;
      $description = $request->description;
      $category_old_image=$request->category_old_image;

      if ($request->hasFile('image')) :
          $file = $request->file('image');
          $filename = time() . '.' . $file->getClientOriginalExtension();
          $file->move(public_path().'/uploads/category', $filename);
          //$image = $filename;
      endif;
      if(!empty($filename) && File::exists(public_path("uploads/category/".$category_old_image)))
      {
        //$file_path = public_path().'/uploads/category/'.$category_old_image;
        File::delete(public_path("uploads/category/".$category_old_image));
      }
      
      if(!empty($filename))
      {
        $image=$filename;
        //dd($image);
      }
      else
      {
        $image=$category_old_image;
      }
      $meta_title = $request->meta_title;
      $meta_description = $request->meta_description;
      $meta_keyword = $request->meta_keyword;
      $navbar_status = $request->navbar_status == true ? '1' : '0';
      //dd($navbar_status);
      $status = $request->status == true ? '1' : '0';
      $updated_by = Auth::guard('admin')->user()->id;

      $categoryUpdate = Category::where('id',$category_id)->update([
        'name'=>$name,
        'slug'=>$slug,
        'description'=>$description,
        'image'=>$image,
        'meta_title'=>$meta_title,
        'meta_description'=>$meta_description,
        'meta_keyword'=>$meta_keyword,
        'navbar_status'=>$navbar_status,
        'status'=>$status,
        'created_by'=>$updated_by 
      ]);
      if ($categoryUpdate != null) {
          
          $successMsg = 'Category Update Successfully';
          return Redirect('admin/category')
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
  public function delete($category_id)
  {
    $deleted_by = Auth::guard('admin')->user()->id;
    $deleteCategory = Category::where('id', $category_id)->update([
      'is_deleted' =>'1',
      'deteted_by'=>$deleted_by
    ]);                                                
    $successMsg="Category deleted successfully!";
    return Redirect::back()
    ->withSuccess($successMsg);  
  }
}  

