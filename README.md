# HTTP log

Offers a middleware to automatically log HTTP requests and responses for API endpoints. A model allows manually logging as well. All data will be logged into the database table "http_logs". The following information will be captured:

* Unique request ID (UUID 7)
* Request method
* Request path
* Request URI
* Request header
* Request IP
* Request input (JSON)
* Response status code
* Response header
* Response content (JSON)
* Turnaround time in nanoseconds (using PHP's hrtime)

To enable the request logging for all API requests, add it to the api middleware group in the App\Http\Kernel.php:

```phpregexp
use PatrickRiemer\HttpLog\Http\Middleware\LogRequestResponse;

protected $middlewareGroups = [
    'api' => [
        LogRequestResponse::class,
    ],
];
```