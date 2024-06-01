<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestoListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resto_lists', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('menu');
            $table->string('title');
            $table->text('description');
            $table->text('alamat');
            $table->text('maps');
            $table->text('range');
            $table->float('total_rating');

            // $table->double('curr_price');
            // $table->integer('discount')->nullable();
            // $table->double('price_after_discount')->nullable();
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
        Schema::dropIfExists('resto_lists');
    }
}
