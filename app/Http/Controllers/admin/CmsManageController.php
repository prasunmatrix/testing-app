<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cms;
use Illuminate\Support\Facades\File;
use Auth;
use Redirect;
use Validator;

class CmsManageController extends Controller
{
  //
  public function index()
  {
    $this->data['page_title'] = 'Admin | CMS';
    $cmsList = Cms::where('is_deleted','0')->get();
    $this->data['cmsList']=$cmsList;
    return view('admin.cms.index', $this->data);
  }
  public function create()
  {
    $this->data['page_title'] = 'Admin | Add CMS';
    $this->data['panel_title'] = 'Admin Add CMS';
    return view('admin.cms.create',$this->data);
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
          //$page_slug=$request->slug;
          $page_slug = Str::slug($request->slug, '-');
          $count=Cms::select('slug')->where('slug','=',$page_slug)->count();
          if($count>0)
          {                  
            $errMsg = array();
              $errMsg['slugerror'] = 'Slug already exists.Please enter different slug.';
              return Redirect::back()
                          ->withErrors($errMsg)
                          ->withInput();
          }
          else
          {
            $pageSlug=$page_slug;
          }
          
          $name= $request->name;
          //$slug = $request->slug;
          $description = $request->description;

        if ($request->hasFile('image')) :
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/cms', $filename);
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

      $cms = Cms::create([
        'name'=>$name,
        'slug'=>$pageSlug,
        'description'=>$description,
        'image'=>$image,
        'meta_title'=>$meta_title,
        'meta_description'=>$meta_description,
        'meta_keyword'=>$meta_keyword,
        'navbar_status'=>$navbar_status,
        'status'=>$status,
        'created_by'=>$created_by 
      ]);
      if ($cms != null) {
          
          $successMsg = 'CMS Added Successfully';
          return Redirect('admin/cms')
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
  public function edit($cms_id)
  {
    $this->data['page_title'] = 'Admin | Update Cms';
    $cms = Cms::find($cms_id);
    $this->data['cms']=$cms;
    return view('admin.cms.edit', $this->data);
  }
  public function update(Request $request, $cms_id)
  {
    //dd($cms_id);
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
      $page_slug=Str::slug($request->slug, '-');
      $count=Cms::select('slug')->where('slug','=',$page_slug)->where('id','!=',$cms_id)->count();
      if($count>0)
      {                  
        $errMsg = array();
          $errMsg['slugerror'] = 'Slug already exists.Please enter different slug.';
          return Redirect::back()
                      ->withErrors($errMsg)
                      ->withInput();
      }
      else
      {
        $pageSlug=$page_slug;
      }
      $name= $request->name;
      //$slug = $request->slug;
      $description = $request->description;
      $cms_old_image=$request->cms_old_image;

      if ($request->hasFile('image')) :
          $file = $request->file('image');
          $filename = time() . '.' . $file->getClientOriginalExtension();
          $file->move('uploads/cms', $filename);
          //$image = $filename;
      endif;
      if(!empty($filename) && File::exists(public_path("uploads/cms/".$cms_old_image)))
      {
        //$file_path = public_path().'/uploads/cms/'.$cms_old_image;
        File::delete(public_path("uploads/cms/".$cms_old_image));
      }
      
      if(!empty($filename))
      {
        $image=$filename;
        //dd($image);
      }
      else
      {
        $image=$cms_old_image;
      }
      $meta_title = $request->meta_title;
      $meta_description = $request->meta_description;
      $meta_keyword = $request->meta_keyword;
      $navbar_status = $request->navbar_status == true ? '1' : '0';
      //dd($navbar_status);
      $status = $request->status == true ? '1' : '0';
      $updated_by = Auth::guard('admin')->user()->id;

      $cmsUpdate = cms::where('id',$cms_id)->update([
        'name'=>$name,
        'slug'=>$pageSlug,
        'description'=>$description,
        'image'=>$image,
        'meta_title'=>$meta_title,
        'meta_description'=>$meta_description,
        'meta_keyword'=>$meta_keyword,
        'navbar_status'=>$navbar_status,
        'status'=>$status,
        'created_by'=>$updated_by 
      ]);
      if ($cmsUpdate != null) {
          
          $successMsg = 'CMS Update Successfully';
          return Redirect('admin/cms')
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
  public function delete($cms_id)
  {
    $deleted_by = Auth::guard('admin')->user()->id;
    $deleteCategory = Cms::where('id', $cms_id)->update([
      'is_deleted' =>'1',
      'deteted_by'=>$deleted_by
    ]);                                                
    $successMsg="CMS deleted successfully!";
    return Redirect::back()
    ->withSuccess($successMsg);  
  }
}
