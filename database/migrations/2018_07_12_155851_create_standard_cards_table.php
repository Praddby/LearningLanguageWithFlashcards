<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStandardCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standard_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_original');
            $table->string('name_translation');
            $table->boolean('is_level_zero')->default(true);
            $table->unsignedInteger('card_group_id');
            $table->timestamps();
            
            $table->foreign('card_group_id')->references('id')->on('card_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('standard_cards');
    }
}
