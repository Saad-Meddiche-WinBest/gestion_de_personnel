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
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_personne')->comment('grp2-foreign');
            $table->unsignedBigInteger('id_reason')->comment('grp1-foreign');
            $table->date('date')->comment('grp1-date');
            $table->string('comment')->comment('grp1-text')->default(null);
            $table->foreign('id_personne')->references('id')->on('personnes')->onDelete("cascade");
            $table->foreign('id_reason')->references('id')->on('reasons');
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
        Schema::dropIfExists('scheduale_absence');
    }
};
