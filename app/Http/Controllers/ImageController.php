<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    //
    protected function showListImage($filename)
{
   //check image exist or not
   $exists = Storage::disk('public')->exists('list/'.$filename);
   
   if($exists) {
      
      //get content of image
      $content = Storage::get('public/list/'.$filename);
      
      //get mime type of image
      $mime = Storage::mimeType('public/list/'.$filename);
      //prepare response with image content and response code
      $response = Response::make($content, 200);
      //set header 
      $response->header("Content-Type", $mime);
      // return response
      return $response;
   } else {
      abort(404);
   }
}
}


