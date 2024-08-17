<?php

namespace App\Http\Controllers\Api;

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
     * @param $customerId
     *
     * @return PassportResource
     */
    public function index($customerId): PassportResource
    {
        $passport = Passport::where('customer_uuid', $customerId)->firstOrFail();

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
    public function show($passportUuid)
    {
        $passport = Passport::all()->where(['uuid' => $passportUuid]);

        return new PassportResource($passport);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PassportRequest $request
     * @param Passport        $passport
     *
     * @return PassportRequest
     */
    public function update(PassportRequest $request, Passport $passport)
    {
        $passport->update($request->validated());

        return new PassportRequest($passport);
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
