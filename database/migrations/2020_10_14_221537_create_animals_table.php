<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal', function (Blueprint $table) {
            $table->id();
			$table->bigInteger("especie")->unsigned();
			$table->string("nome", 100);
			$table->string("dono", 100);
			$table->string("raca", 100);
			$table->date("nascimento");
			$table->integer("idade");
			$table->foreign("especie")->references("id")->on("especie");
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
        Schema::dropIfExists('animal');
    }
}
