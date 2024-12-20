<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\about;
use Illuminate\Http\Request;

class aboutecontroller extends Controller
{
    public function __construct(){
        $this->middleware('auth:api')->except(['index','show']);
    }
    
    public function index()
    {
        $aboute=about::all();
        return response()->json([
            "message"=>"عملیات با موفقیت انجام شد",
            "data"=>$aboute
        ],200);
    }

   
    public function store(Request $request)
    {
        $file=$request->file('image');
        $image="";
        if(!empty($file)){
            $image=sha1(time()).".". $file->getClientOriginalExtension();
            $file->move('images/aboute',$image);
        }
        $aboute=about::create([
            'description'=>$request->description,
            'image'=>$image
        ]);
        return response()->json([
          "success"=>"success",
          "message"=>"created",
          "data"=>$aboute
        ]);
    }

 
    public function show(string $id)
    {
        $about=about::findOrFail($id);
        return response()->json([
            'success'=>'success',
            'message'=>'عملیات با موفقیت انجام شد',
            'data'=> $about
        ],200);
    }

  
    public function update(Request $request, string $id)
    {
        $imagedelete=about::findOrFail($id)->image;
        $file=$request->file('image');
        $image="";
        if(!empty($file)){
            if(file_exists('images/aboute/'.$imagedelete)){
                unlink('images/aboute/'.$imagedelete);
            }
            $image=sha1(time()).".". $file->getClientOriginalExtension();
            $file->move('images/aboute',$image);
        }else{
            $image=$imagedelete;
        }
        $aboute=about::findOrFail($id)->update([
            'description'=>$request->description,
            'image'=>$image
        ]);
        return response()->json([
            "message"=>'عملیات اپدیت به درستی انجام شد',
            "data"=>$aboute,
        ],200);
    }

  
    public function destroy(string $id)
    {
        $imagedelte=about::findOrFail($id)->image;
        if(file_exists('images/aboute/'.$imagedelte)){
            unlink('images/aboute/'.$imagedelte);
        }
        $aboute=about::destroy($id);
        return response()->json([
            "message"=>'deleted',
        ],200);
    }
}
