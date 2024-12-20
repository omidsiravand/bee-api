<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\gallery;
use Illuminate\Http\Request;

class gallerycontroller extends Controller
{
    public function __construct(){
        $this->middleware('auth:api')->except(['index','show']);
    }
   
    public function index()
    {
        $gallery=gallery::all();
        return response()->json([
            "message"=>"عملیات با موفقیت انجام شد",
            "data"=>$gallery
        ],200);
    }


    public function store(Request $request)
    {
        $file=$request->file('image');
        $image="";
        if(!empty($file)){
            $image=sha1(time()).".". $file->getClientOriginalExtension();
            $file->move('images/gallery',$image);
        }
        $gallery=gallery::create([
            'image'=>$image
        ]);
        return response()->json([
          "success"=>"success",
          "message"=>"created",
          "data"=>$gallery
        ],200);
    }

    public function show(string $id)
    {
        //
    }

   
    public function update(Request $request, string $id)
    {
        $imagedelete=gallery::findOrFail($id)->image;
        $file=$request->file('image');
        $image="";
        if(!empty($file)){
            if(file_exists('images/gallery/'.$imagedelete)){
                unlink('images/gallery/'.$imagedelete);
            }
            $image=sha1(time()).".". $file->getClientOriginalExtension();
            $file->move('images/gallery',$image);
        }else{
            $image=$imagedelete;
        }
        $gallery=gallery::findOrFail($id)->update([
            'image'=>$image
        ]);
        return response()->json([
            "message"=>'عملیات اپدیت به درستی انجام شد',
            "data"=>$gallery,
        ],200);
    }

    public function destroy(string $id)
    {
        $imagedelte=gallery::findOrFail($id)->image;
        if(file_exists('images/gallery/'.$imagedelte)){
            unlink('images/gallery/'.$imagedelte);
        }
        $gallery=gallery::destroy($id);
        return response()->json([
            "message"=>'deleted',
        ],200);
    }
}
