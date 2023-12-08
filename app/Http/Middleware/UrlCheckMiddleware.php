<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Illuminate\Support\Facades\Redirect;

class UrlCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       //echo env('URL_PORT');
        
        $host = $request->getHost();
        $port = $request->getPort();

        $baseHost = "127.0.0.1";
        $basePort = 8000;

        if ($baseHost !== $host || $basePort !== $port)
        {
            abort(401, 'Unauthorized');
        }

        
        return $next($request);

        // $allowedUrls = [
            //     "127.0.0.1:8000/",
            //     "127.0.0.1:8000/add",
            //     "127.0.0.1:8000/showData",
            //     "127.0.0.1:8000/deleteData",
            //     "127.0.0.1:8000/editData",
            //     "127.0.0.1:8000/updateData",
            //     "127.0.0.1:8000/getDetails"
            // ];

    }
}
