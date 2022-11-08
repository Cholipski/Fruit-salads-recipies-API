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
        Schema::create('salad_recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->text("description");
            $table->float("carbohydrates",5,2)->default(0);
            $table->float("protein",5,2)->default(0);
            $table->float("fat",5,2)->default(0);
            $table->float("calories",5,2)->default(0);
            $table->float("sugar",5,2)->default(0);
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
        Schema::dropIfExists('salad_recipes');
    }
};
