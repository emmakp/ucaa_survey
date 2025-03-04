<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSurveySubmissionIdToAnswersTable extends Migration
{
    public function up()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->unsignedBigInteger('survey_submission_id')->nullable()->after('id');
            $table->foreign('survey_submission_id')->references('id')->on('survey_submissions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->dropForeign(['survey_submission_id']);
            $table->dropColumn('survey_submission_id');
        });
    }
}