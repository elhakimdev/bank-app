<?php

namespace App\Http\Controllers\API\Resources;

use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\ProfileCollection;
use App\Traits\ApiResponser as JsonResponseApiHandler;

use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    use JsonResponseApiHandler;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return JsonResponseApiHandler::success(
            new ProfileCollection(Profile::all()),
            $this->message('index', 'Profile'),
            Response::HTTP_OK
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        return JsonResponseApiHandler::success(
            Profile::create($request->validated()),
            $this->message('store', 'Profile'),
            Response::HTTP_OK
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return JsonResponseApiHandler::success(
            new ProfileResource($profile->load(
                'user',
                'profileAddress',
                'user.roles.permissions'
            )),
            $this->message('show', 'Profile'),
            Response::HTTP_OK
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, Profile $profile)
    {
        return JsonResponseApiHandler::success(
            $profile->update($request->validated()),
            $this->message('update', 'Profile'),
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        return JsonResponseApiHandler::success(
            $profile->delete(),
            $this->message('delete', 'Profile'),
            Response::HTTP_OK
        );
    }
}
