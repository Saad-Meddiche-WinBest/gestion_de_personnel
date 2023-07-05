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
        Schema::create('bans', function (Blueprint $table) {
            $table->id()->comment('grp2-number');
            $table->string('nom')->comment('grp2-text');
            $table->string('prenom')->comment('grp2-text');
            $table->string('cin')->comment('grp2-text');
            $table->date('date')->comment('grp1-date');
            $table->string('reason')->comment('grp1-text');
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
        Schema::dropIfExists('bans');
    }
};
