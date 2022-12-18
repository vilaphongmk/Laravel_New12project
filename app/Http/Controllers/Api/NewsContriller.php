<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\tbl_news;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class NewsContriller extends Controller
{
    public function GetNews()
    {
        try {
            $news = tbl_news::all();
            return response()->json([
                "news" => $news,
                "status" => "success",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th,
                "status" => "error",
            ]);
        }
    }
    public function Addnews(request $request)
    {


        $validator = FacadesValidator::make($request->all(), [
            "tittle" => "required | max:50 ",
            "content" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors(),
                "status" => "error",
            ]);
        }

        try {
            $news = new tbl_news();
            $news->tittle = $request->tittle;
            $news->content = $request->content;
            $news->save();
            return response()->json([
                "message" => "ເພີ່ມຂໍ້ມູນສຳເລັດ",
                "status" => "success",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "ເພີ່ມຂໍ້ມູນບໍ່ສຳເລັດ",
                "status" => "error",
            ]);
        }
    }
}
