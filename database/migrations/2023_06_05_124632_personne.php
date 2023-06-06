<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('personnes', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('prenom');
        $table->date('date_naiss');
        $table->string('adresse');
        $table->string('telephone');
        $table->string('email');
        $table->date('date_debut');
        $table->date('date_fin');
        $table->string('cin');
        $table->boolean('presence');
        $table->string('sexe');
        $table->string('etat_civil');
        $table->unsignedBigInteger('id_services');
        $table->unsignedBigInteger('id_employement');
        $table->unsignedBigInteger('id_poste');
        $table->foreign('id_poste')->references('id')->on('postes');
        $table->unsignedBigInteger('id_source_embauche');
        $table->foreign('id_services')->references('id')->on('services');
        $table->foreign('id_employement')->references('id')->on('employements');
        $table->foreign('id_source_embauche')->references('id')->on('sources_embauche');
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
        //
        Schema::dropIfExists('personnes');
    }
};
