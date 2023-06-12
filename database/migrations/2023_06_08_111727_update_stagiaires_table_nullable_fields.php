<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStagiairesTableNullableFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stagiaires', function (Blueprint $table) {
            //
            $table->string('statut')->nullable()->change();
            $table->dateTime('dateDebut')->nullable()->change();
            $table->dateTime('dateFin')->nullable()->change();
            $table->text('cvPath')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     * 
     * @return void
     */
    public function down()
    {
        Schema::table('stagiaires', function (Blueprint $table) {
            //

            $table->string('statut')->nullable(false)->change();
            $table->dateTime('dateDebut')->nullable(false)->change();
            $table->dateTime('dateFin')->nullable(false)->change();
            $table->text('cvPath')->nullable(false)->change();

        });
    }
}
