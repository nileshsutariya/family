<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class BaseController extends Controller
{
    public function apisuccess($result, $message)
    {
        $data = Http::get('http://localhost/family/');
        $status = $data->status();
        // print_r($status); die;
        if ($data->successful()) {
            return response()->json([
                'success' => true,
                'status' => $status,   
                'message' => $message,
                'data' => $result 
            ], $status);
        }
        return response()->json([
            'success' => false,
            'status' => $status,
            'message' => 'API request failed'
        ], $status);
    }

    public function apierror($error, $errorMessages = [],  $status = 422)
    {
        if (isset($errorMessages['id_not_found'])) {
            $status = 404; 
        };

        return response()->json([
            'success' => false,
            'status' => $status,
            'message' => $errorMessages,
            'data' => $error
        ], $status);
    }

}
