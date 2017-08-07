<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cofigs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('config_title');
            $table->string('config_var',120);
            $table->text('config_value');
            $table->enum('type', array('text','textarea','checkbox','radio','select'));
            $table->char('can_edit', 1)->default('Y');
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
        Schema::drop('cofigs');
    }
}
