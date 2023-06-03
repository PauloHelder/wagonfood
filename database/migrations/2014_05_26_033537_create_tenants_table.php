<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plan_id');
            $table->uuid('uuid');
            $table->string('name')->unique();
            $table->string('url')->unique();
            $table->string('nif')->unique();
            $table->string('email')->unique();
            $table->string('logo')->nullable();

            //Statudo do Tenant no sistema
            $table->enum('active', ['Y','N'])->default('Y');

            //Definição da Subscrição
            $table->date('subscription')->nullable(); //data que se increver
            $table->date('expire_at')->nullable();//data em que expira a sub
            $table->boolean('subscription_id',255)->nullable();
            $table->boolean('subscription_active')->default(false);
            $table->boolean('subscription_suspended')->default(false);
            

            //Definção da Chave estrangeira
            $table->foreign('plan_id')
                            ->references('id')
                            ->on('plans')
                            ->onUpdate('cascade')
                            ->onDelete('cascade');

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
        Schema::dropIfExists('tenants');
    }
}
    