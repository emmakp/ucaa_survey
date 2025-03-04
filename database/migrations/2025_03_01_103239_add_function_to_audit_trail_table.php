<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFunctionToAuditTrailTable extends Migration
{
    public function up()
    {
        Schema::table('audit_trail', function (Blueprint $table) {
            $table->string('function')->after('controller');
        });
    }

    public function down()
    {
        Schema::table('audit_trail', function (Blueprint $table) {
            $table->dropColumn('function');
        });
    }
}