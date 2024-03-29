# HTTP log

Offers a middleware to automatically log HTTP requests and responses for API endpoints. A model allows manually logging as well. All data will be logged into the database table "http_logs". The following information will be captured:

* Unique request ID (UUID 4)
* Request method
* Request path
* Request URI
* Request header
* Request IP
* Request input (JSON)
* Response status code
* Response header
* Response content (JSON)
* Turnaround time in milliseconds (based on PHP's hrtime, rounded up to the next millisecond)

To enable the request logging for all API requests, add it to the api middleware group in the App\Http\Kernel.php:

```phpregexp
use PatrickRiemer\HttpLog\Http\Middleware\LogRequestResponse;

protected $middlewareGroups = [
    'api' => [
        LogRequestResponse::class,
    ],
];
```

The logging is deactivated per default since version 1.1.0. You can enable it in your .env file with the following snippet:

```shell
HTTP_LOG_ENABLED=true
```

The middleware will log the request IP. If you are sitting behind Cloudflare or a similar service that forwards the real IP address, you can specify the header attribute in the environment file that should be used for logging. Example for Cloudflare:

```shell
HEADER_REAL_IP=x-real-ip
```