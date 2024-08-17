<?php

namespace App\Http\Controllers\Api\v1\Customers\Passports;

use App\Http\Controllers\Controller;
use App\Http\Requests\PassportRequest;
use App\Http\Resources\PassportResource;
use App\Models\Passport;
use Illuminate\Http\Response;

class PassportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $customerID
     *
     * @return PassportResource
     */
    public function index($customerID): PassportResource
    {
        $passport = Passport::where(['customer_uuid' => $customerID])->firstOrFail();

        return new PassportResource($passport);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PassportRequest $request
     *
     * @return PassportResource
     */
    public function store(PassportRequest $request): PassportResource
    {
        $passport = Passport::create($request->validated());

        return new PassportResource($passport);
    }

    /**
     * Display the specified resource.
     *
     * @return PassportResource
     */
    public function show($customerUuid)
    {
        $passport = Passport::where('customer_uuid', $customerUuid)->firstOrFail();

        return new PassportResource($passport);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PassportRequest $request
     *
     * @return PassportResource
     */
    public function update(PassportRequest $request)
    {
        $passport = Passport::findOrFail($request->uuid);
        $passport->update($request->validated());

        return new PassportResource($passport);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Passport $passport
     *
     * @return Response
     */
    public function destroy(Passport $passport)
    {
        $passport->delete();

        return response()->noContent();
    }
}
