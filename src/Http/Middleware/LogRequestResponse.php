<?php

namespace PatrickRiemer\HttpLog\Http\Middleware;

use PatrickRiemer\HttpLog\Models\HttpLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\Uid\Uuid;

class LogRequestResponse
{
    public function handle(Request $request, Closure $next)
    {
        if (! config('httplog.enabled')) {
            return $next($request);
        }

        $start_time = hrtime(true);
        $trace = Uuid::v7();

        $request->headers->add([
            'Request-Trace' => $trace
        ]);

        $response = $next($request);

        $end_time = hrtime(true);

        $ip = $request->ip();
        if (! empty(config('httplog.header_real_ip')) && $request->hasHeader(config('httplog.header_real_ip'))) {
            $ip = $request->header(config('httplog.header_real_ip'));
        }

        HttpLog::create([
            'trace' => $trace,
            'request_method' => $request->getMethod(),
            'request_path' => $request->path(),
            'request_uri' => $request->getUri(),
            'request_headers' => json_encode($request->headers->all()),
            'request_ip' => $ip,
            'request_input' => json_encode($request->all()),
            'response_status' => $response->getStatusCode(),
            'response_headers' => json_encode($response->headers->all()),
            'response_content' => $response->getContent(),
            'turnaround' => ceil(($end_time - $start_time)/1e+6)
        ]);

        return $response;
    }
}