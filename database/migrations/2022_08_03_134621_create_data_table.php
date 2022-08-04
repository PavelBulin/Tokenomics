<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('raund');
            $table->string('blocked');
            $table->string('unlocked');
            $table->string('timeToUnlock');
            $table->string('timeToFullUnlock');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data');
    }
};
