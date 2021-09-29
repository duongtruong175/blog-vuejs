<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BackendUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all data
        $users = User::with(['roles'])->paginate(request('length') ? request('length') : 5);

        $viewdata = [
            'users' => $users
        ];

        return response()->json($viewdata);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $viewdata = [
            'roles' => $roles
        ];

        // redict to create new form
        return response()->json($viewdata);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        // Validate errors (StoreUserRequest validated)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->roles()->attach($request->roles);

        return $user;
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
        $user = User::with(['roles'])->findOrFail($id);
        $roles = Role::all();

        $viewdata = [
            'user' => $user,
            'roles' => $roles
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
    public function update(Request $request, $id)
    {
        //
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'roles' => 'array|min:1',
            'roles.*' => 'integer|distinct',
        ])->validate();

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->roles()->detach();
        $user->roles()->attach($request->roles);

        $user->save();

        return $user;
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
        $user = User::findOrFail($id);

        // Detach all relationships
        $user->roles()->detach();
        $user->forceDelete();

        return $user;
    }
}
