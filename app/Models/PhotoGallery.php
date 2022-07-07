<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoGallery extends Model
{
  use HasFactory;
  protected $table = 'photo_gallery';
  protected $fillable = [
    'title',
    'description',
    'display_title',
    'position',
    'status',
    'created_by',
    'is_deleted',
    'deteted_by'
  ];
}
