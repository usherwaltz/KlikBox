<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name', 255);
            $table->string('lastname', 255);
            $table->string('city', 255);
            $table->string('street', 255);
            $table->string('postcode', 10);
            $table->string('email', 255)->nullable();
            $table->string('phone', 20);
            $table->boolean('confirmed')->default(false);
            $table->boolean('sent')->default(false);

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
        Schema::dropIfExists('orders');
    }
}
