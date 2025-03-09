<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUserrolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userroles', function (Blueprint $table) {
            //
            $table->string('Description')->nullable();
            $table->integer('created_by')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('userroles', function (Blueprint $table) {
            //
            $table->dropColumn('Description');
            $table->dropColumn('created_by');
        });
    }
}
