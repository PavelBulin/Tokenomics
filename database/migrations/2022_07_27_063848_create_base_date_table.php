<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('base_date', function (Blueprint $table) {
            $table->id();
            $table->integer('time');
        });
    }

    public function down()
    {
        Schema::dropIfExists('base_date');
    }
};
