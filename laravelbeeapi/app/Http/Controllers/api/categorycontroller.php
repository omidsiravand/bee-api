<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;

class categorycontroller extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth:api')->except(['index','show']);
    // }
  
    public function index()
    {
        $category=category::all();
        return response()->json([
            "message"=>"عملیات با موفقیت انجام شد",
            "data"=>$category
        ],200);
    }

   
    public function store(Request $request)
    {
        $file=$request->file('image');
        $image="";
        if(!empty($file)){
            $image=sha1(time()).".". $file->getClientOriginalExtension();
            $file->move('images/category',$image);
        }
        $gategory=category::create([
            'title'=>$request->title,
            'image'=>$image
        ]);
        return response()->json([
          "success"=>"success",
          "message"=>"created",
          "data"=>$gategory
        ]);
    }

  
    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $imagedelete=category::findOrFail($id)->image;
        $file=$request->file('image');
        $image="";
        if(!empty($file)){
            if(file_exists('images/category/'.$imagedelete)){
                unlink('images/category/'.$imagedelete);
            }
            $image=sha1(time()).".". $file->getClientOriginalExtension();
            $file->move('images/category',$image);
        }else{
            $image=$imagedelete;
        }
        $category=category::findOrFail($id)->update([
            'title'=>$request->title,
            'image'=>$image
        ]);
        return response()->json([
            "message"=>'عملیات اپدیت به درستی انجام شد',
            "data"=>$category,
        ],200);
    }

   
    public function destroy(string $id)
    {
        $imagedelte=category::findOrFail($id)->image;
        if(file_exists('images/category/'.$imagedelte)){
            unlink('images/category/'.$imagedelte);
        }
        $category=category::destroy($id);
        return response()->json([
            "message"=>'deleted',
        ],200);
    }
}
