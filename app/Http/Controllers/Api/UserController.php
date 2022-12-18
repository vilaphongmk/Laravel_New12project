<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\tbl_users;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function getUsers()
    {
        try {
            $user = tbl_users::all();
            return response()->json([
                "user" => $user,
                "status" => "success",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th,
                "status" => "error",
            ]);
        }
    }
}
