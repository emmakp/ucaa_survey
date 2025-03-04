<?php
// database/migrations/2025_03_04_170000_add_audience_id_to_surveys_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAudienceIdToSurveysTable extends Migration
{
    public function up()
    {
        Schema::table('surveys', function (Blueprint $table) {
            $table->unsignedBigInteger('audience_id')->nullable()->after('created_by');
            $table->foreign('audience_id')->references('id')->on('audiences')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('surveys', function (Blueprint $table) {
            $table->dropForeign(['audience_id']);
            $table->dropColumn('audience_id');
        });
    }
}