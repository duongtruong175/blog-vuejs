<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BackendAuthenticationController extends Controller
{
    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember;

        $permission = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('roles.name', 'users.password')
            ->where([
                ['users.email', $email],
                ['roles.name', 'admin']
            ])
            ->first();

        if (!empty($permission) && Hash::check($password, $permission->password)) {
            // redict login success, add session
            Auth::attempt(['email' => $email, 'password' => $password], $remember);
            $request->session()->regenerate();
            $user = User::find(Auth::user());
            return response()->json([
                'user' => $user->load(['roles'])
            ]);
        }

        return response()->json([
            'errors' => [
                'email' => ['The provided credentials do not match our admin records.']
            ],
            'message' => 'The given data was invalid.'
        ], 422);
    }

    /**
     * Destroy an authenticated admin session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logout succcess',
        ], 200);
    }
}
