<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{

    public function successResponse($data, $code = Response::HTTP_OK)
    {
       // return response()->json(['data' => $data], $code);
       return response($data, $code)->header('Content-Type', 'application/json');
    }

    public function errrorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    public function validResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json(['data'=>$data], $code);
    }

    public function errorMessage($message, $code)
    {
        return response($message,$code)->header('Content-Type', 'application/json');
    }


}