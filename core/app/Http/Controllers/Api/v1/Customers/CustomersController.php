<?php

namespace App\Http\Controllers\Api\v1\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="E-Shop Catalog",
 *     description="API Documentation",
 * )
 */
class CustomersController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return CustomerResource::collection(
            Customer::orderBy('created_at', 'desc')->paginate(20)
        );
    }

    /**
     * @param CustomerRequest $request
     *
     * @return CustomerResource
     */
    public function store(CustomerRequest $request): CustomerResource
    {
        $customer = Customer::create($request->validated());

        return new CustomerResource($customer);
    }

    /**
     * @param string $customerId
     *
     * @return CustomerResource
     */
    public function show(string $customerId): CustomerResource
    {
        $customer = Customer::findOrFail(['uuid' => $customerId])->first();

        return new CustomerResource($customer);
    }

    public function update(CustomerRequest $request): CustomerResource
    {
        $customer = Customer::findOrFail($request->uuid);
        $customer->update($request->validated());

        return new CustomerResource($customer);
    }

    public function destroy(Customer $customer): Response
    {
        $customer->delete();

        return response()->noContent();
    }
}
