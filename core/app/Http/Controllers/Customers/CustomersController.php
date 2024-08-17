<?php

namespace App\Http\Controllers\Customers;

use App\Models\Customer;
use Inertia\Inertia;
use Inertia\Response;

final class CustomersController
{
    public function index(): Response
    {
        $customers = Customer::orderBy('created_at', 'desc')
                             ->paginate(20)
                             ->withQueryString()
                             ->through(fn($customer) => [
                                 'uuid'         => $customer->uuid,
                                 'last_name'    => $customer->last_name,
                                 'first_name'   => $customer->first_name,
                                 'phone_number' => $customer->phone_number,
                             ]);

        return Inertia::render('Customers/Index', [
            'customers' => $customers,
        ]);
    }

    public function edit(): Response
    {
        return Inertia::render('Customers/Edit', [
        ]);
    }
}
