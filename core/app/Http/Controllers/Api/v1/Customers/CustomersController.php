<?php

namespace App\Http\Controllers\Api\v1\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Response;
use Inertia\Inertia;
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
    public function index(): \Inertia\Response
    {
        $customers = Customer::orderBy('created_at', 'desc')
                             ->paginate(20)
                             ->withQueryString()
                             ->through(fn ($customer) => [
                                 'uuid'         => $customer->uuid,
                                 'last_name'    => $customer->last_name,
                                 'first_name'   => $customer->first_name,
                                 'phone_number' => $customer->phone_number,
                             ]);

        return Inertia::render('Customers/Index', [
            'customers' => $customers,
        ]);
    }

    /**
     * @param UpdateCustomerRequest $request
     *
     * @return CustomerResource
     */
    public function store(UpdateCustomerRequest $request): CustomerResource
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

    public function edit()
    {
        return Inertia::render('Customers/Edit', []);
    }

    public function update(UpdateCustomerRequest $request): CustomerResource
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
