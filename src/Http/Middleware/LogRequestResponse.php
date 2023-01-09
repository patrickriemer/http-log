<?php

namespace PatrickRiemer\HttpLog\Http\Middleware;

use App\Models\HttpLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\Uid\Uuid;

class LogRequestResponse
{
    public function handle(Request $request, Closure $next)
    {
        $start_time = hrtime(true);
        $trace = Uuid::v7();

        $request->headers->add([
            'Request-Trace' => $trace
        ]);

        $response = $next($request);

        $end_time = hrtime(true);

        HttpLog::create([
            'trace' => $trace,
            'request_method' => $request->getMethod(),
            'request_path' => $request->path(),
            'request_uri' => $request->getUri(),
            'request_headers' => json_encode($request->headers->all()),
            'request_ip' => $request->ip(),
            'request_input' => json_encode($request->all()),
            'response_status' => $response->getStatusCode(),
            'response_headers' => json_encode($response->headers->all()),
            'response_content' => $response->getContent(),
            'turnaround' => $end_time - $start_time
        ]);

        return $response;
    }
}