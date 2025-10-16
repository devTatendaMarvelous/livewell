<?php

function successResponseHandler($msg, $data=[]){
    return response()->json([
        'status' => 'success',
        'message' => $msg,
        'data' => $data
    ], 200);
}

function errorResponseHandler($msg, $errors=[])
{
    return response()->json([
        'status' => 'error',
        'message' => $msg,
        'errors' => $errors
    ], 500);
}

function errorValidationResponseHandler($msg, $data=[])
{
    return response()->json([
        'status' => 'error',
        'message' => $msg,
        'data' => $data
    ], 400);
}
function notFoundResponseHandler($msg, $data=[])
{
    return response()->json([
        'status' => 'failed',
        'message' => $msg,
        'data' => $data
    ], 404);
}

function deleteSuccessHandler($msg, $data=[])
{
    return response()->json([
        'status' => 'success',
        'message' => $msg,
        'data' => $data
    ], 200);
}
