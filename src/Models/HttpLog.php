<?php

namespace PatrickRiemer\HttpLog\Models;

use Illuminate\Database\Eloquent\Model;

class HttpLog extends Model
{
    protected $fillable = [
        'trace',
        'request_method',
        'request_path',
        'request_uri',
        'request_headers',
        'request_ip',
        'request_input',
        'response_status',
        'response_headers',
        'response_content',
        'turnaround',
    ];
}