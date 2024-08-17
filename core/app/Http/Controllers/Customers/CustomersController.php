<?php

namespace App\Http\Controllers\Customers;

use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Inertia\Inertia;
use Inertia\Response;

/**
 * @template T
 */
final class CustomersController
{
    public function index(): Response
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

    public function edit(Customer $customer): Response
    {
        return Inertia::render('Customers/Edit', [
            'customer' => CustomerResource::make($customer),
        ]);
    }

    /**
     * @param Customer $customer
     * @param UpdateCustomerRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Customer $customer, UpdateCustomerRequest $request)
    {
        $customer->update($request->validated());

        return redirect()->route('customers.edit', $customer->uuid)->with([
            'message'=> 'Customer updated successfully',
            'customer' => CustomerResource::make($customer),
        ]);
    }
}
