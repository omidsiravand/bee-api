<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\checkcontroller;
use App\Http\Controllers\Controller;
use App\Http\Resources\menuresource;
use App\Models\menu;
use Illuminate\Http\Request;

class menucontroller extends controller
{


    public function __construct(){
        $this->middleware('auth:api')->except(['index','show']);
    }
   
    public function index()
    {
        $menu=menu::paginate();
        return response()->json([
            'success'=>'success',
            'message'=>'عملیات با موفقیت انجام شد',
            'data'=>menuresource::collection($menu),
            'meta'=>[
                'count'=>$menu->count()
            ]
        ],200);
    }


   
    public function store(Request $request)
    {
        $file=$request->file('image');
        $image="";
        if(!empty($file)){
            $image=sha1(time()).".". $file->getClientOriginalExtension();
            $file->move('images/menu',$image);
        }
        $menu=menu::create([
       'title1'=>$request->title1,
       'p'=>$request->p,
       'title'=>$request->title,
       'description'=>$request->description,
       'image'=>$image
        ]);
        return response()->json([
          "message"=>'created',
          'data'=>$menu
        ]);
    }


    public function show(string $id)
    {
        $menu=menu::findOrFail($id);
        return response()->json([
            'success'=>'success',
            'message'=>'عملیات با موفقیت انجام شد',
            'data'=> new menuresource($menu)
        ],200);
    }

 

    public function update(Request $request, string $id)
    {
        $imagedelete=menu::findOrFail($id)->image;
        $file=$request->file('image');
        $image="";
        if(!empty($file)){
            if(file_exists('images/menu/'.$imagedelete)){
                unlink('images/menu/'.$imagedelete);
            }
            $image=sha1(time()).".". $file->getClientOriginalExtension();
            $file->move('images/menu',$image);
        }else{
            $image=$imagedelete;
        }
        $menu=menu::findOrFail($id)->update([
            'title1'=>$request->title1,
            'p'=>$request->p,
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$image
        ]);
        return response()->json([
            "message"=>'update ok',
            'data'=>$menu
        ]);
    }

   
    public function destroy(string $id)
    {
        $imagedelete=menu::findOrFail($id)->image;
        if(file_exists('images/menu/'.$imagedelete)){
            unlink('images/menu/'.$imagedelete);
        }   
        $menu=menu::destroy($id);
        return response()->json([
            'message'=>'deletetd',
        ],200);
    }
}
