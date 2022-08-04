<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id();
            $table->string('name', 100);
            $table->string('email', 255)->nullable(false)->unique('email');
            $table->string('password', 255)->nullable(false);
            $table->string('role')->default('user');
            $table->string('remember_token', 100)->nullable(true);
            $table->string('google_id')->nullable();

            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
