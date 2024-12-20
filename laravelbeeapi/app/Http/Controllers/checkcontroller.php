<?php

namespace App\Http\Controllers;

use App\Models\menu;
use Illuminate\Http\Request;

class checkcontroller extends Controller
{
    public function responsesuccess($data,$cod){
        return response()->json([
            "success"=>'success',
            "message"=>'عملیات با موفقیت انجام شد',
            'date'=>$data,
            "meta"=>[
                'count'=>$data->count()
            ],
        ],$cod);
    }

    public function responseerroe($cod){
        return response()->json([
            "success"=>'success',
            "message"=>'عملیات با موفقیت انجام نشد',
            'date'=>""
        ],$cod);
    }
}

