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
        Schema::create('tokenomics', function (Blueprint $table) {
          $table->id();

          $table->integer('category_id');
          $table->float('globalPercent', 8, 2)->default(1);

          for ($i = 1; $i <= 49; $i++) {
            $table->float($i . 'Mo', 8, 2)->default(0);
          }

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
        Schema::dropIfExists('tokenomics');
    }
};
