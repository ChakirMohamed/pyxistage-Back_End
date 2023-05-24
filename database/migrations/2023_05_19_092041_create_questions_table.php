<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');

            $table->unsignedBigInteger('niveau_question_id');
            $table->foreign('niveau_question_id')->references('id')->on('niveau_questions')->onDelete('cascade');

            $table->unsignedBigInteger('theme_question_id');
            $table->foreign('theme_question_id')->references('id')->on('question_themes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
