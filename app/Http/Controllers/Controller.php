<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function errorMessage(\Exception $exception): string
    {
        $msg = $exception->getMessage();

        if (!env('APP_DEBUG')) {
            Log::error("=============== Controller Error ============== \n\n {$exception->getMessage()}");
            $msg = 'An error occurred. Please try again';
        }

        return $msg;
    }
}
