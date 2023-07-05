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
        Schema::create('postes', function (Blueprint $table) {
            $table->id()->comment('grp2-number');
            $table->string('nom')->comment('grp1-text');
            $table->unsignedBigInteger('id_icon')->comment('grp3-icons')->default(1);
            $table->foreign('id_icon')->references('id')->on('icons');
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
        Schema::dropIfExists('postes');
    }
};
