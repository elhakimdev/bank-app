<?php

namespace App\Http\Controllers\API\Resources;

use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Authorization\Permission;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\PermissionCollection;
use Illuminate\Http\JsonResponse;

class PermissionController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success(new PermissionCollection(Permission::all()), 'List Of All Permission', 200);
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
     * @param \App\Models\Authorization\PermissionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PermissionRequest $request): JsonResponse
    {
        return $this->success(Permission::create($request->validated()), 'The new permission was uccesfully saved', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Authorization\Permission $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Permission $permission): JsonResponse
    {
        return $this->success(new PermissionResource(Permission::findById($permission->id)), 'List Specified Permission By Its ID', 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update specified resource.
     *
     * @param \App\Http\Requests\PermissionRequest $request
     * @param \App\Models\Authorization\Permission $permission
     * @return JsonResponse
     */
    public function update(PermissionRequest $request, Permission $permission): JsonResponse
    {
        return $this->success(Permission::where('id', $permission->id)->update($request->validated()), 'successfully updating specified permission', 200);
    }

    /**
     * Remove specified resource from storage.
     *
     * @param \App\Models\Authorization\Permission $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Permission $permission): JsonResponse
    {
        return $this->success($permission->destroy($permission->id), 'successfully destroy/deleted given permission', 200);
    }
}
