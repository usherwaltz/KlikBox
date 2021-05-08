<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoAndIcons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->text('video')->nullable();
            $table->string('icon_1', 255)->nullable();
            $table->string('icon_2', 255)->nullable();
            $table->string('icon_3', 255)->nullable();
            $table->string('icon_4', 255)->nullable();
            $table->text('icon_1_text')->nullable();
            $table->text('icon_2_text')->nullable();
            $table->text('icon_3_text')->nullable();
            $table->text('icon_4_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
