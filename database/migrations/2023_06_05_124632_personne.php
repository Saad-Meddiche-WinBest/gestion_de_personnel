<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.z
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
            $table->string('telephone')->comment('telephone');
            $table->string('email')->comment('email');
            $table->date('date_debut')->comment('date');
            $table->date('date_fin')->comment('date');
            $table->string('cin');
            $table->boolean('presence');
            $table->string('sexe');
            $table->string('etat_civil');

            $table->unsignedBigInteger('id_service')->comment('foreign');
            $table->unsignedBigInteger('id_employement')->comment('foreign');
            $table->unsignedBigInteger('id_poste')->comment('foreign');
            $table->unsignedBigInteger('id_source')->comment('foreign');

            $table->foreign('id_poste')->references('id')->on('postes');
            $table->foreign('id_service')->references('id')->on('services');
            $table->foreign('id_employement')->references('id')->on('employements');
            $table->foreign('id_source')->references('id')->on('sources');
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
