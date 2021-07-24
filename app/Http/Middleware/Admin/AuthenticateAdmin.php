<?php

namespace App\Http\Middleware\Admin;

use App\Traits\adminChecking;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthenticateAdmin
{
    use adminChecking;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!empty($request)) {
            if (!$this->checkIfAdmin($request)) {
                return response()->json(
                    ['errMgs' => 'Not Authorized to make this request'],
                    Response::HTTP_UNAUTHORIZED
                );
            }
        }
        return $next($request);

    }
    protected function checkIfAdmin(Request $request): bool
    {
        $id = $request->header('id');
        $token = $request->header('authorization');
        $isAdmin = $this->isAuthenticated($id, $token);
        return $isAdmin ? true : false;
    }

}
