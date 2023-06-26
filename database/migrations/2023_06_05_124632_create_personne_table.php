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
            $table->id()->comment('grp1-number');
            $table->string('nom')->comment('grp1-text');
            $table->string('prenom')->comment('grp1-text');
            $table->date('date_naissance')->comment('grp1-date');
            $table->string('adresse')->comment('grp1-text');
            $table->string('telephone')->comment('grp1-tel');
            $table->string('email')->comment('grp1-email');
            $table->date('date_debut')->comment('grp1-date');
            $table->date('date_fin')->nullable()->comment('grp1-date');
            $table->string('cin')->comment('grp1-text');
            $table->boolean('sexe')->comment('grp1-bool-Male-Female');
            $table->boolean('etat_civil')->comment('grp1-bool-Marie-Single');

            $table->unsignedBigInteger('id_service')->comment('grp1-foreign');
            $table->unsignedBigInteger('id_employement')->comment('grp1-foreign');
            $table->unsignedBigInteger('id_poste')->comment('grp1-foreign');
            $table->unsignedBigInteger('id_source')->nullable()->comment('grp1-foreign');

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
