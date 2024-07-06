<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Support\Responses\V1\FailedResponse;
use Symfony\Component\HttpFoundation\Response;

class OnlyAdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Responsable
    {
        $user = $request->user();

        if (! $user || ! $user->isAdmin()) {
            return new FailedResponse(
                errorMessage: 'You do not have the permission to access this resource',
                statusCode: 403
            );
        }

        return $next($request);
    }
}
