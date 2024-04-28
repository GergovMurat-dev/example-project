<?php

namespace App\Http\Controllers;

use App\Services\Common\ServiceResult;

abstract class Controller
{
    protected function createResponseFromServiceResult(
        ServiceResult $serviceResult,
        bool          $returnValue = false
    )
    {
        if ($serviceResult->isError) {
            return response()->json([
                'message' => $serviceResult->message,
                'errors' => $serviceResult->errors
            ]);
        }

        $data = $serviceResult->data;

        if ($returnValue) {
            return response()->json([
                'data' => $data
            ]);
        }

        return response()->json();
    }
}
