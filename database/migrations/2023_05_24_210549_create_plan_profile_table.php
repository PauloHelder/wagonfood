<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_profile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('profile_id');

            $table->foreign('plan_id')
                        ->references('id')
                        ->on('plans')
                        ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('profile_id')
                        ->references('id')
                        ->on('profiles')
                        ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('plan_profile');
    }
}
