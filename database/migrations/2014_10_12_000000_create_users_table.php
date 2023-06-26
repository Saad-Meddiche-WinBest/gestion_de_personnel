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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('grp2-number');
            $table->string('name')->comment('grp1-text');
            $table->string('email')->comment('grp1-email');
            $table->string('password')->comment('grp2-password');
            $table->timestamp('email_verified_at')->commennt('grp2-text')->nullable();
            $table->rememberToken()->commennt('grp2-text');
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
        Schema::dropIfExists('users');
    }
};
