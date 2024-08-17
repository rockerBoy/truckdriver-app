<?php

namespace App\Http\Controllers\Api\v1\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerAddressRequest;
use App\Http\Resources\CustomerAddressResource;
use App\Models\CustomerAddress;
use Illuminate\Http\Response;

class CustomerAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $customerUuid
     *
     * @return CustomerAddressResource
     */
    public function index(string $customerUuid): CustomerAddressResource
    {
        $address = CustomerAddress::where(['customer_uuid' => $customerUuid])->firstOrFail();

        return new CustomerAddressResource($address);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CustomerAddressRequest $request
     *
     * @return CustomerAddressResource
     */
    public function store(CustomerAddressRequest $request): CustomerAddressResource
    {
        $address = CustomerAddress::create($request->validated());

        return new CustomerAddressResource($address);
    }

    /**
     * Display the specified resource.
     *
     * @param string $customerUuid
     *
     * @return CustomerAddressResource
     */
    public function show(string $customerUuid): CustomerAddressResource
    {
        $address = CustomerAddress::findOrFail(['customer_uuid' => $customerUuid])->first();

        return new CustomerAddressResource($address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CustomerAddressRequest $request
     *
     * @return CustomerAddressResource
     */
    public function update(CustomerAddressRequest $request): CustomerAddressResource
    {
        $address = CustomerAddress::where(['customer_uuid' => $request->customer_uuid])->firstOrFail();
        $address->update($request->validated());

        return new CustomerAddressResource($address);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CustomerAddress  $customerAddress
     * @return Response
     */
    public function destroy(CustomerAddress $customerAddress)
    {
    }
}
