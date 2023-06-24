<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteidchoiOnquizQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quiz__questions', function (Blueprint $table) {

            
        // Supprimez la colonne
        $table->dropColumn('choi_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quiz__questions', function (Blueprint $table) {
            //
            $table->int('choi_id')->nullable();
        });
    }
}
