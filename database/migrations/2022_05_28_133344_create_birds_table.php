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
            $table->string('color')->nullable();
            $table->string('behavior')->nullable();
            $table->string('shape')->nullable();
            $table->string('habitat')->nullable();
            $table->string('when_to_spot')->nullable();
            $table->tinyInteger('rarity')->nullable();
            // // $table->string('characteristics')->nullable();
            $table->string('image_attribution')->nullable();
            $table->string('image_attribution_url')->nullable();
            // $table->string('image_wikimedia_source')->nullable();
            $table->string('image_cc_license')->nullable();
            $table->string('image_cc_license_url')->nullable();
            $table->string('image_gnu_license')->nullable();
            $table->string('image_gnu_license_url')->nullable();
            $table->string('image_edited_by')->nullable();
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
