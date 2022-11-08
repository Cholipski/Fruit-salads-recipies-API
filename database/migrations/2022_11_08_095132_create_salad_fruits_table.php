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
        Schema::create('salad_fruits', function (Blueprint $table) {
            $table->id();
            $table->foreignId("recipe_id")->constrained("salad_recipes");
            $table->foreignId("fruit_id")->constrained();
            $table->float("weight",6,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salad_fruits');
    }
};
