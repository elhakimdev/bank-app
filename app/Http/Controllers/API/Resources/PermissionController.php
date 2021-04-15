<?php

namespace App\Http\Controllers\API\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Authorization\Permission;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\PermissionCollection;
use App\Traits\ApiResponser;

class PermissionController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        return $this->success(Permission::create($request->validated()), 'The new permission was uccesfully saved', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        return $this->success(Permission::where('id', $permission->id)->update($request->validated()), 'successfully updating specified permission', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        return $this->success($permission->destroy($permission->id), 'successfully destroy/deleted given permission', 200);
    }
}
