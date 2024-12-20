<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;

class productcontroller extends Controller
{

    public function index()
    {
        $product=category::with('product')->get();
      
        return response()->json([
            "message"=>"عملیات با موفقیت انجام شد",
            "data"=>$product
        ],200);
    }
  
    public function store(Request $request)
    {
        $file=$request->file('image');
        $image="";
        if(!empty($file)){
            $image=sha1(time()).".". $file->getClientOriginalExtension();
            $file->move('images/product',$image);
        }
        $product=product::create([
            'description'=>$request->description,
            'category_id'=>$request->category_id,
            'image'=>$image
           
        ]);
        return response()->json([
          "success"=>"success",
          "message"=>"created",
          "data"=>$product
        ]);
    
    }

 
    public function show(string $id)
    {
        //
    }

 

    public function update(Request $request, string $id)
    {
        $imagedelete=product::findOrFail($id)->image;
        $file=$request->file('image');
        $image="";
        if(!empty($file)){
            if(file_exists('images/product/'.$imagedelete)){
                unlink('images/product/'.$imagedelete);
            }
            $image=sha1(time()).".". $file->getClientOriginalExtension();
            $file->move('images/product',$image);
        }else{
            $image=$imagedelete;
        }
        $product=product::findOrFail($id)->update([
            'description'=>$request->description,
            'image'=>$image
        ]);
        return response()->json([
            "message"=>'عملیات اپدیت به درستی انجام شد',
            "data"=>$product,
        ],200);
    }

    
    public function destroy(string $id)
    {
        $imagedelte=product::findOrFail($id)->image;
        if(file_exists('images/product/'.$imagedelte)){
            unlink('images/product/'.$imagedelte);
        }
        $product=product::destroy($id);
        return response()->json([
            "message"=>'deleted',
        ],200);
    }
}
