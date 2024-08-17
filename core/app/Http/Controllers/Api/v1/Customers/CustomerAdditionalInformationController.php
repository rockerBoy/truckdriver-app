<?php

namespace App\Http\Controllers\Api\v1\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerAdditionalInformationRequest;
use App\Http\Resources\CustomerAdditionalInformationResource;
use App\Models\Countries;
use App\Models\Language;
use App\Services\CustomerAdditionalInfoService;
use Illuminate\Http\JsonResponse;

class CustomerAdditionalInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param                               $customerID
     * @param CustomerAdditionalInfoService $service
     *
     * @return CustomerAdditionalInformationResource
     */
    public function index($customerID, CustomerAdditionalInfoService $service): CustomerAdditionalInformationResource
    {
        return new CustomerAdditionalInformationResource($service->getAdditionalInfo($customerID));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CustomerAdditionalInformationRequest $request
     * @param CustomerAdditionalInfoService        $additionalInfoService
     *
     * @return CustomerAdditionalInformationResource
     */
    public function store(CustomerAdditionalInformationRequest $request, CustomerAdditionalInfoService $additionalInfoService): CustomerAdditionalInformationResource
    {
        $additionalInfo = $additionalInfoService->create($request->validated());

        return new CustomerAdditionalInformationResource($additionalInfo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerAdditionalInformationRequest $request, CustomerAdditionalInfoService $service): CustomerAdditionalInformationResource
    {
        $additionalInfo = $service->update($request);

        return new CustomerAdditionalInformationResource($additionalInfo);
    }

    /**
     * Returns options for the additional information selectors.
     *
     * @return JsonResponse
     */
    public function getOptions(): JsonResponse
    {
        return response()->json([
           'countries' => Countries::all()->toArray(),
           'languages' => Language::all()->toArray(),
       ]);
    }
}
