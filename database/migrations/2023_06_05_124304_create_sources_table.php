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
        Schema::create('sources', function (Blueprint $table) {
            $table->id()->comment('grp2-number');
            $table->string('nom')->comment('grp1-text');
            $table->unsignedBigInteger('id_poste')->comment('grp1-foreign');
            $table->foreign('id_poste')->references('id')->on('postes')->onDelete("cascade");;
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
        Schema::dropIfExists('sources');
    }
};
