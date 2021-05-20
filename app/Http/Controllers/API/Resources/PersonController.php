<?php

namespace App\Http\Controllers\Api\Resources;

use App\Models\Person;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersonRequest;
use App\Http\Resources\PersonResource;
use App\Http\Resources\PersonCollection;
use App\Traits\ApiResponser as JsonResponser;
use Symfony\Component\HttpFoundation\Response;

class PersonController extends Controller
{
    use JsonResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return JsonResponser::success(new PersonCollection(Person::all()), $this->message('index', 'User'), Response::HTTP_OK);
        // return $this->success(new PersonCollection(Person::all()), $this->message('index', 'User'), Response::HTTP_OK);
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
    public function store(PersonRequest $request)
    {
        return JsonResponser::success(Person::create($request->validated()), $this->message('created', 'Person'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        return JsonResponser::success(new PersonResource($person->load('user', 'user.roles.permissions')), $this->message('show', 'Person'), Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(PersonRequest $request, Person $person)
    {
        return JsonResponser::success($person->update($request->validated()), $this->message('update', 'Person'), Response::HTTP_OK);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        return JsonResponser::success($person->destroy($person->id), $this->message('destroy', 'Person'), Response::HTTP_OK);
    }
}
