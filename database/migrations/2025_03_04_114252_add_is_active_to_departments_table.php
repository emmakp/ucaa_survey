<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsActiveToDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('name');
        });

        // Set existing departments to active
        \App\Departments::query()->update(['is_active' => true]);
    }

    public function down()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
}