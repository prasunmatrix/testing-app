<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{PhotoGallery,Category,PhotoGalleryImage};
use Illuminate\Support\Facades\File;
use Auth;
use Redirect;
use Validator;
use App\Traits\ImageUpload;

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
      'galley_images'     => 'required',
      'galley_images.*'   => 'image|mimes:jpg,jpeg,png,gif|max:2048',
      'status'            => 'nullable'
    ],
    [      
      'required' => 'The :attribute field is required',
      'title.max' => 'title can be maximum :max chars long',
      'display_title.max' => 'display title can be maximum :max chars long',
      'position'=>'please select the type/place',
      'galley_images.mimes'=>'Image should be jpeg,png,jpg,gif types', 
    ]);
    if ($validator->fails()) {
      /*echo 'Failed';
      exit();*/
      return Redirect::back()
                  ->withErrors($validator)
                  ->withInput();
    } else {
      $title= $request->title;
      $description = $request->description;
      $display_title= $request->display_title;
      $position = $request->position;
      $status = $request->status == true ? '1' : '0';
      $created_by = Auth::guard('admin')->user()->id;
      $photoGallery=PhotoGallery::create([
        'title'=>$title,
        'description'=>$description,
        'display_title'=>$display_title,
        'position'=>$position,
        'status'=>$status,
        'created_by'=>$created_by
      ]);
      //dd($photoGallery->id);
      if($photoGallery!=null)
      {
        if($request->file('galley_images')) {
          $files=$request->file('galley_images');
          foreach($files as $key=>$file){
              $file_name =time().'-'.$key;
              $extension = $file->getClientOriginalExtension();
              $fullFileName = $file_name.'.'.$extension; 
              $destinationPath = 'uploads/gallery';
              $uploadResponse= $file->move($destinationPath,$fullFileName); 

              $photoGalleryImage=PhotoGalleryImage::create([
                'photo_gallery_fk'=>$photoGallery->id,
                'image'=>$fullFileName
              ]);    
          }
        }
        $successMsg = 'Photo Gallery Added Successfully';
          return Redirect('admin/photogallery')
                  ->withSuccess($successMsg);
      }
      else
      {
        $errMsg = array();
          $errMsg['registrationerror'] = 'Something went wrong, please try again';
          return Redirect::back()
                  ->withErrors($errMsg)
                  ->withInput();
      }  
    }  
  }
  public function edit($photogallery_id)
  {
    $this->data['page_title'] = 'Admin | Update Photogallery';
    $photogallery = PhotoGallery::find($photogallery_id);
    $photoGalleryImage=PhotoGalleryImage::where('photo_gallery_fk',$photogallery_id)->get();
    //dd($photoGalleryImage);
    $this->data['photogallery']=$photogallery;
    $this->data['photoGalleryImage']=$photoGalleryImage;
    $categoryList = Category::where('is_deleted','0')->where('status','1')->get();
    $this->data['categoryList']=$categoryList;
    return view('admin.photogallery.edit', $this->data);
  }
  public function update(Request $request,$photogallery_id)
  {
    //dd($request->all());
    $validator = Validator::make($request->all(), 
    [
      'title'             => 'required|string|max:200',
      'description'       => 'required',
      'display_title'     => 'required|string|max:200',
      'position'          => 'required',
      //'galley_images'     => 'required',
      'galley_images.*'   => 'image|mimes:jpg,jpeg,png,gif|max:2048',
      'status'            => 'nullable'
    ],
    [      
      'required' => 'The :attribute field is required',
      'title.max' => 'title can be maximum :max chars long',
      'display_title.max' => 'display title can be maximum :max chars long',
      'position'=>'please select the type/place',
      'galley_images.mimes'=>'Image should be jpeg,png,jpg,gif types', 
    ]);
    if ($validator->fails()) {
      return Redirect::back()
                  ->withErrors($validator)
                  ->withInput();
    }
    else
    {
      $title= $request->title;
      $description = $request->description;
      $display_title= $request->display_title;
      $position = $request->position;
      $status = $request->status == true ? '1' : '0';
      $photoGallery=PhotoGallery::where('id',$photogallery_id)->update([
        'title'=>$title,
        'description'=>$description,
        'display_title'=>$display_title,
        'position'=>$position,
        'status'=>$status  
      ]);
      if($request->file('galley_images')) {
        $files=$request->file('galley_images');
        foreach($files as $key=>$file){
            $file_name =time().'-'.$key;
            $extension = $file->getClientOriginalExtension();
            $fullFileName = $file_name.'.'.$extension; 
            $destinationPath = 'uploads/gallery';
            $uploadResponse= $file->move($destinationPath,$fullFileName); 

            $photoGalleryImage=PhotoGalleryImage::create([
              'photo_gallery_fk'=>$photogallery_id,
              'image'=>$fullFileName
            ]);    
        }
      }
      if($photoGallery!=null)
      {
        $successMsg = 'Photo Gallery updated Successfully';
          return Redirect('admin/photogallery')
                  ->withSuccess($successMsg);
      }
      else
      {
        $errMsg = array();
          $errMsg['error'] = 'Something went wrong, please try again';
          return Redirect::back()
                  ->withErrors($errMsg)
                  ->withInput();

      }
    }
  }
  public function galleryImageDelete(Request $request){
    //dd($request->all());
    // $response['has_error']= 1;
    // $response['msg']= 'Something went wrong. Please try again later.';
    $imageId = decrypt($request->encryptId); // get image-id After Decrypt.
    //dd($imageId);
    $image=PhotoGalleryImage::select('image')->where('id','=',$imageId)->first();
    //dd($image->image);
    $saveResponse=PhotoGalleryImage::where('id','=',$imageId)->delete();
    if($saveResponse){
      //$response['has_error']= 0;
      //$response['msg']= 'Successfully deleted.';
      if(File::exists(public_path("uploads/gallery/".$image->image)))
      {
        File::delete(public_path("uploads/gallery/".$image->image));
      }
      header('Content-Type:application/json');
      $msg="Successfully deleted.";
      die(json_encode(array("has_error"=>"0","msg"=>$msg)));
    }
    else
    {
      header('Content-Type:application/json');
      $msg="Something went wrong. Please try again later.";
      die(json_encode(array("has_error"=>"1","msg"=>$msg)));
    }

    // return $response;
  }

}
