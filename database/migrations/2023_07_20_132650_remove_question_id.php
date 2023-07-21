<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveQuestionId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quiz_question_choices', function (Blueprint $table) {
            //
            $table->dropIndex('quiz_question_choices_question_id_foreign');

            // Remove the column from the table
            $table->dropColumn('question_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quiz_question_choices', function (Blueprint $table) {
            //
        });
    }
}
