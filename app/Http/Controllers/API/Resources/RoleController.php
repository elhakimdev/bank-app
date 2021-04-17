<?php

namespace App\Http\Controllers\API\Resources;

use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use App\Models\Authorization\Role;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Http\Resources\RoleCollection;

class RoleController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success(new RoleCollection(Role::all()), 'Lst Of All Available Role', 200);
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
     * @param  \App\Http\Requests\RoleRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoleRequest $request): JsonResponse
    {
        return $this->success(Role::create($request->validated()), 'The new permission was uccesfully saved', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Authorization\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return $this->success(new RoleResource(Role::findById($role->id)), 'List Of Specified Role BY Its ID', 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Authorization\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @param  \App\Models\Authorization\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        return $this->success(Role::where('id', $role->id)->update($request->validated()), 'successfully updating specified role', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Authorization\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        return $this->success($role->destroy($role->id), 'successfully delete specified role', 200);
    }
}
