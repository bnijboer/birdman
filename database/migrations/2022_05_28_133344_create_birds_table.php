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
        Schema::create('birds', function (Blueprint $table) {
            $table->id();
            $table->string('dutch_name');
            // $table->string('english_name')->nullable();
            // $table->string('latin_name')->nullable();
            $table->string('color')->nullable();
            $table->string('behavior')->nullable();
            $table->string('shape')->nullable();
            $table->string('habitat')->nullable();
            $table->string('when_to_spot')->nullable();
            $table->tinyInteger('rarity')->nullable();
            $table->string('characteristics')->nullable();
            // $table->text('description')->nullable();
            $table->text('image')->nullable();
            // $table->text('sound')->nullable();
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
        Schema::dropIfExists('birds');
    }
};
