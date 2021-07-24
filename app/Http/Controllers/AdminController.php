<?php

namespace App\Http\Controllers;

use App\Models\AdminAuthToken;
use App\Traits\adminChecking;
use App\Models\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    use AuthenticatesUsers, adminChecking;

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($this->attemptLogin($request)) {
            $admin = $this->guard()->user();
            $token = $this->generateToken($admin->id);
            $id = $admin->id;

            return response()->json(['token' => $token, 'id' => $id], 200);
        } else {
            return response()->json(['errMgs' => 'You do not have valid credentials'], 401);
        }
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }


    private function generateToken($id)
    {
        $token = Str::random(80);

        $this->saveToken($id, $token);
        return $token;
    }
    private function saveToken($id, $token): void
    {
        $newToken = new AdminAuthToken();
        $newToken->admin_id = $id;
        $newToken->token = $token;
        $newToken->save();
    }
    private function checkIfAdmin(Request $request): bool
    {
        $id = $request->header('id');
        $token = $request->header('authorization');
        $isAdmin = $this->isAuthenticated($id, $token);
        return $isAdmin ? true : false;
    }





}
