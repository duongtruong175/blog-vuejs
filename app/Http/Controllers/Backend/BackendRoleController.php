<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class BackendRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all data
        $roles = Role::paginate(request('length') ? request('length') : 5);

        $viewdata = [
            'roles' => $roles
        ];

        return response()->json($viewdata);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        // Validate errors (StoreRoleRequest validated)
        $role = Role::create([
            'name' => $request->name
        ]);

        return $role;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get data and redict to edit form
        $role = Role::findOrFail($id);

        $viewdata = [
            'role' => $role
        ];

        return response()->json($viewdata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRoleRequest $request, $id)
    {
        //
        $role = Role::findOrFail($id);
        $role->name = $request->name;

        $role->save();

        return $role;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $role = Role::findOrFail($id);

        // Detach all relationships
        $role->users()->detach();
        $role->forceDelete();

        return $role;
    }
}
