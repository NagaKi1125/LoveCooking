<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('dish_name');
            $table->string('cate_id');
            $table->string('avatar')->nullable();
            $table->string('description');
            $table->string('use');
            $table->string('material');
            $table->string('steps');
            $table->string('step_imgs');
            $table->integer('author');
            $table->integer('liked_count');
            $table->integer('checked');
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
        Schema::dropIfExists('dishes');
    }
}
