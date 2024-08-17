<?php

namespace App\Http\Controllers\Api\v1\Customers\Driver;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverLicenseRequest;
use App\Http\Resources\DriverLicenseResource;
use App\Services\DriverLicenseService;
use Illuminate\Http\JsonResponse;

class DriverLicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param                      $customerId
     * @param DriverLicenseService $driverLicenseService
     *
     * @return DriverLicenseResource
     */
    public function index($customerId, DriverLicenseService $driverLicenseService): DriverLicenseResource
    {
        $license = $driverLicenseService->getLicense($customerId);

        return new DriverLicenseResource($license);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DriverLicenseRequest $request
     * @param DriverLicenseService $driverLicenseService
     *
     * @return DriverLicenseResource
     */
    public function store(DriverLicenseRequest $request, DriverLicenseService $driverLicenseService): DriverLicenseResource
    {
        $license = $driverLicenseService->create($request->validated());

        return new DriverLicenseResource($license);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DriverLicenseRequest $request
     * @param DriverLicenseService $driverLicenseService
     *
     * @return DriverLicenseResource
     */
    public function update(DriverLicenseRequest $request, DriverLicenseService $driverLicenseService): DriverLicenseResource
    {
        $license = $driverLicenseService->update($request);

        return new DriverLicenseResource($license);
    }

    public function showLicenseOptions(): JsonResponse
    {
        return response()->json(
            [
                'data' => [
                    'chipCardExchangeReasons'   => config('truckdriver.chip_exchange_reasons.reasons'),
                    'code95Regions'             => config('truckdriver.95_code_regions.regions'),
                    'categoryList'              => config('truckdriver.driving_license_categories.categories'),
                ],
            ]
        );
    }
}
