<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
  use HasFactory;
  protected $table = 'cms';
  protected $fillable = [
    'name',
    'slug',
    'description',
    'image',
    'meta_title',
    'meta_description',
    'meta_keyword',
    'navbar_status',
    'status',
    'created_by',
    'is_deleted',
    'deteted_by'
  ];
}
