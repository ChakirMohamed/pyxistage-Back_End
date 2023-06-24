<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AupdateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            //
            $table->string('url')->nullable();

            $table->unsignedBigInteger('theme_question_id');
            $table->foreign('theme_question_id')->references('id')->on('question_themes')->onDelete('cascade');
            $table->date('expirationDate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            //
            $table->dropColumn('url');
            
        });
    }
}
