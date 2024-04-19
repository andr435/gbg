<?php

/**
 * Base Api Controller
 */
Class ApiController extends Controller
{
    public function __construct(){
        header("Content-Type: application/json; charset=UTF-8");
    }

    public function onError($data, $code = null)
    {
        return json_encode(['error' => ['code' => $code,'message'=> $data]]);
    }

    public function onSuccess($data, $code = 200){
        return json_encode(['code' => $code,'data'=> $data]);       
    }
}