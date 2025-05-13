<?php

namespace App\Http\Middleware;

use App\Exceptions\BasicAuthFailureException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class authBasic
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string $configKey
     *
     * @return mixed
     * @throws BasicAuthFailureException
     */
    public function handle(Request $request, Closure $next,)
    {
        $AUTH_USER = env('BASIC_AUTH_USERNAME', 'admin');
        $AUTH_PASS = env('BASIC_AUTH_PASSWORD', 'admin');
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        $has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
        $is_not_authenticated = (
            !$has_supplied_credentials ||
            $_SERVER['PHP_AUTH_USER'] != $AUTH_USER ||
            $_SERVER['PHP_AUTH_PW']   != $AUTH_PASS
        );
        if ($is_not_authenticated) {
            header('HTTP/1.1 401 Authorization Required');
            header('WWW-Authenticate: Basic realm="Access denied"');
            exit;
        }
        return $next($request);
    }
}
