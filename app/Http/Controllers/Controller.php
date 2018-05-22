<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected function res($data = [], $success = false,$token=null)
    {
        if ($token == null) {
            $res = [
                'success' => $success ? true : false,
                'message' => $success ? 'success' : 'failed',
                'data' => $data,
            ];
        } else {
            $res = [
                'success' => $success ? true : false,
                'message' => $success ? 'success' : 'failed',
                'data' => $data,
                'token' => $token
            ];
        }


        return response()->json($res);
    }
}
