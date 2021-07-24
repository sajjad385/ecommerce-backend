<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\adminChecking;
use App\Traits\sendApiResponse;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    use adminChecking, sendApiResponse;

    /**
     * @var boolean
     */
    protected $isAdmin;

    /**
     * The admin instance
     *
     * @var App\Admin
     */

    protected $admin;

    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            $this->admin = $this->checkIfAdmin($request);
            $this->isAdmin = (bool) $this->admin;
            if( ! $this->isAdmin){
                abort(403, 'You do not have permission to do this.');
            }
            return $next($request);
        });
    }

    protected function checkIfAdmin(Request $request)
    {
        $id = $request->header('id');
        $token = $request->header('authorization');
        $isAdmin = $this->isAuthenticated($id, $token);
        return $isAdmin;
    }

}
