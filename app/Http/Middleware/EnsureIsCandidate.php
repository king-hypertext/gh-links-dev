<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsCandidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,): Response
    {
        if ($request->user('candidate')->is_candidate == true) {
            return $next($request);
        }
        return
            $request->ajax() ?
            response(['message' => 'You are not allowed to access this page'], 401) :
            redirect()->to(route('login'))->with('warning', 'You are not authorized to access this page');
    }
}
