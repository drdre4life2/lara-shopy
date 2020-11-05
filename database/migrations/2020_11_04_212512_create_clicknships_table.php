<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClicknshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('clicknships', function (Blueprint $table) {
            $table->id();
            $table->text('phone');
            $table->text('username');
            $table->text('password');
            $table->text('store_city');
            $table->text('locationId');
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
        Schema::dropIfExists('clicknships');
    }
}
