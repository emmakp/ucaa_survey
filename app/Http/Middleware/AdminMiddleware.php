<?php

namespace App\Http\Middleware;

use Closure;
// use Illuminate\Support\Facades\Route;
// use App\User;
use App\UserRoles;
use App\ControllerModel;
use App\Functionary;
use App\UserRoleFunctionary;
use Route;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if(count($request->user()) > 0 && $request->user()->UserRole === 3){
        //     return $next($request);
        // }
        // $route = Route::current();

        // $name = Route::currentRouteName();

        // return $next($request); exit;

        $action = Route::currentRouteAction();
        $action = explode('App\Http\Controllers\\',$action)[1];
        $controller = explode('@',$action)[0];
        $method = explode('@',$action)[1];

        if($controller === 'FileDownloadController'){
            return $next($request);
            exit;
        }
        if((ControllerModel::count()) < 1){ return $next($request); }
        // Controller ID
        $controllerID = ControllerModel::where('Name', $controller)->first()->id;

        // Function to Controller ID
        $functionaryID = Functionary::where('Name', $method)->where('ControllerID', $controllerID)->first()->id;

        // UserRoleID
        $userRole = $request->user()->UserRole;

        // Get status for user role
        $can_access = UserRoleFunctionary::where('Function', $functionaryID)->where('UserRoleID', $userRole)->where('ControllerID', $controllerID)->first();

        // print_r($can_access);
        // exit;

        // if ($method === 'postChangePassword'  || $method === 'getChangePassword'  || $method === 'drugqty' || $method === 'store'  || $method === 'update' || $method === 'showRegistrationForm' || $method === 'logout'){
        //     return $next($request);
        // }else
        // if(isset($can_access) && ($can_access->Status === 1)){
        //     return $next($request);
        // }else if(!isset($can_access) || ($can_access->Status === 0)){
        //     return redirect('/dashboard')->with('error', 'Sorry, You don\'t have access.');
        // }
        if($request->user() && $request->user()->UserRole === 2){
            return $next($request);
        }

        return redirect('/');
    }
}
