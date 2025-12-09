<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $permissionId
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permissionId)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/')
                ->with('error', 'You must be logged in to access this page.');
        }

        if ($user->status_id != 1) {
            return redirect('/')
                ->with('error', 'Your account is inactive. Please contact support.');
        }

        if (!$this->userHasPermission($user, $permissionId)) {
            return redirect('/dashboard')
                ->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }

    /**
     * Check if the user has the required permission.
     *
     * @param $user
     * @param int $permissionId
     * @return bool
     */
    private function userHasPermission($user, $permissionId)
    {
        return $user->role 
            && $user->role->permissions()->where('permissions.id', $permissionId)->exists();

    }
}
