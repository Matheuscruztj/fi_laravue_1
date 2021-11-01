<?php

namespace App\Response;

abstract class JsonResponse{
    public static function success(string $message, array $data){
        return response()->json(['message' => $message, 'data' => $data], 200); 
    }
    public static function warning(string $message, array $data){
        return response()->json(['message' => $message, 'data' => $data], 401); 
    }
    public static function error(string $message, array $data){
        return response()->json(['message' => $message, 'data' => $data], 500); 
    }
    public static function error2(int $cod = null, string $message, array $data){
        if($cod)
            return response()->json(['message' => $message, 'data' => $data], $cod);
        return response()->json(['message' => $message, 'data' => $data], 500); 
    }
}