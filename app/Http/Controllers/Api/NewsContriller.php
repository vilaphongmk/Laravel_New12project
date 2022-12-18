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
            "title" => "required|max:255",
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
            $news->title = $request->title;
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

    public function delete($id)
    {
        try {
            tbl_news::find($id)->delete();
            return response()->json([
                "message" => "ລົບຂໍ້ມູນສຳເລັດ",
                "status" => "success",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th,
                "status" => "error",
            ]);
        }
    }

    public function getNewsById($id)
    {
        try {
            $news =   tbl_news::where('id', $id)->first();
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

    public function update(request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            "title" => "required",
            "content" => "required",
            "id" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors(),
                "status" => "error",
            ]);
        }

        try {
            tbl_news::where('id', $request->id)->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);

            return response()->json([
                "message" => "ອັບເດດ ຂໍ້ມູນສຳເລັດ",
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
