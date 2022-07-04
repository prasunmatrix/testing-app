<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Redirect;
use Validator;

class CategoryController extends Controller
{
  public function create()
  {
    dd('test');
    return view('admin.category.create');
  }
}
