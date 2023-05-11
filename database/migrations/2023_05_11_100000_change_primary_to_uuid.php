<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Uid\Uuid;

return new class extends Migration
{
    public function up()
    {
        Schema::table('http_logs', function (Blueprint $table) {
            $table->uuid('uuid')->nullable(true)->first();
        });

        $records = \PatrickRiemer\HttpLog\Models\HttpLog::all();
        if($records) {
            foreach($records as $record) {
                $record->uuid = Uuid::v4();
                $record->save();
            }
        }

        Schema::table('http_logs', function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropColumn('id');
        });

        Schema::table('http_logs', function (Blueprint $table) {
            $table->uuid('uuid')->nullable(false)->change();
            $table->primary('uuid');
            $table->renameColumn('uuid', 'id');
        });

        Schema::table('http_logs', function (Blueprint $table) {
            $table->dropColumn('trace');
        });
    }

    public function down()
    {

    }
};