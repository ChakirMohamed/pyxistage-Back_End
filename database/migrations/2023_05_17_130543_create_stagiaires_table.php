<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStagiairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stagiaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('tel');
            $table->string('mail');
            $table->string('statut');
            $table->dateTime('dateDebut');
            $table->dateTime('dateFin');
            $table->text('cvPath');
            $table->unsignedBigInteger('respo_id');
            $table->foreign('respo_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->unsignedBigInteger('type_stage_id');
            $table->foreign('type_stage_id')->references('id')->on('type_stages')->onDelete('cascade');
            
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
        Schema::dropIfExists('stagiaires');
    }
}
