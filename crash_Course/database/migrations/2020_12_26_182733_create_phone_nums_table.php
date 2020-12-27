<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhoneNumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_nums', function (Blueprint $table) {
            $table->id();

            /*
            * this what insures that the relation is
            * One-To-One AND not One-To-Many.
            * it means that the user_id should be unique
            */

            $table->unique('user_id');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->string('phone');
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
        Schema::dropIfExists('phone_nums');
    }
}