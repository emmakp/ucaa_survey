<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateQuestionsTableAddSurveyIdAndAudienceType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->unsignedBigInteger('survey_id')->nullable()->after('id');
            $table->string('audience_type')->nullable()->after('survey_id');
            $table->boolean('is_required')->default(true)->after('question_type');
            $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropForeign(['survey_id']);
            $table->dropColumn(['survey_id', 'audience_type', 'is_required']);
        });
    }
}
