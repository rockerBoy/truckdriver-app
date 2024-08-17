<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
    public function getDrivers(): JsonResponse
    {
        $customers = DB::table('customer')
           ->select(['uuid', 'first_name', 'last_name', 'email', 'phone_number'])
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return response()->json([
            'data' => $customers,
        ]);
    }

    public function setDriver(): JsonResponse
    {
        return response()->json([

        ]);
    }
}
