<?php namespace App\Http\Middleware;

use Closure;

class Authorize {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        $actions = $request->route()->getAction();

        $roles = isset($actions['roles']) ? $actions['roles'] : [];
        $permissions = isset($actions['permissions']) ? $actions['permissions'] : [];

		if($request->user()->ability($roles, $permissions))
		{
			return $next($request);
		}

        return response('Access Denied', 403);
	}

}
