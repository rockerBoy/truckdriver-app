<?php

namespace App\Http\Controllers\Api\v1\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerExperienceRequest;
use App\Http\Resources\CustomerExperienceResource;
use App\Models\Customer;
use App\Models\CustomerExperience;
use App\Models\DriverTrailer;
use App\Models\Trailer;

class CustomerExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $customerId
     *
     * @return CustomerExperienceResource
     * @throws \JsonException
     */
    public function index($customerId): CustomerExperienceResource
    {
        $customerExperience = CustomerExperience::where(['customer_uuid' => $customerId])->firstOrFail();

        $trailers = $customerExperience->trailers()->get()->toArray();

        $res = [];

        foreach ($trailers as $trailer) {
            $res[] = $trailer['trailer_id'];
        }

        $customerExperience->trailers = $res;
        $customerExperience->work_places = json_decode($customerExperience->work_places, true, 512, JSON_THROW_ON_ERROR);

        return new CustomerExperienceResource($customerExperience);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CustomerExperienceRequest $request
     *
     * @return CustomerExperienceResource
     */
    public function store(CustomerExperienceRequest $request): CustomerExperienceResource
    {
        $trailers = [];
        $customer = Customer::findOrFail($request->customer_uuid);
        $customerExperience = CustomerExperience::create($request->validated());

        if (!empty($request->trailers)) {
            foreach ($request->trailers as $trailer) {
                $trailers[] =
                    new DriverTrailer([
                        'customer_uuid' => $request->customer_uuid,
                        'trailer_id' => $trailer,
                    ]);
            }

            $customer->trailers()->saveMany($trailers);
        }

        return new CustomerExperienceResource($customerExperience);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CustomerExperienceRequest $request
     *
     * @return CustomerExperienceResource
     */
    public function update(CustomerExperienceRequest $request): CustomerExperienceResource
    {
        $customerExperience = CustomerExperience::findOrFail($request->uuid);
        $customerExperience->update($request->validated());

        DriverTrailer::where('customer_uuid', $request->customer_uuid)->delete();

        $trailers = [];

        foreach ($request->trailers as $trailer) {
            $trailers[] =
                new DriverTrailer([
                    'trailer_id' => $trailer,
                    'customer_uuid' => $request->customer_uuid,
                ]);
        }

        $customerExperience->trailers()->saveMany($trailers);

        return new CustomerExperienceResource($customerExperience);
    }

    public function getTrailersList(): string
    {
        return Trailer::all()->toJson();
    }
}
