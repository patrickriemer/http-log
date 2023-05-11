<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('http_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('trace');
            $table->string('request_method');
            $table->string('request_path')->nullable();
            $table->string('request_uri')->nullable();
            $table->json('request_headers')->nullable();
            $table->string('request_ip')->nullable();
            $table->json('request_input')->nullable();
            $table->string('response_status')->nullable();
            $table->json('response_headers')->nullable();
            $table->text('response_content')->nullable();
            $table->integer('turnaround');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('http_logs');
    }
};