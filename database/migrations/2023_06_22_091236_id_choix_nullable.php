<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IdChoixNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quiz__questions__reponses', function (Blueprint $table) {
            //

                $table->unsignedBigInteger('choi_id')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quiz__questions__reponses', function (Blueprint $table) {
            //

                $table->unsignedBigInteger('choi_id')->change();
            
        });
    }
}
