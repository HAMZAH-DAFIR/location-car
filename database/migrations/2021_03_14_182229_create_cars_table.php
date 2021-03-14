<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('model', 50);
            $table->integer('carNumber');
            $table->integer('horse');
            $table->integer('kilometers');
            $table->integer('dor');
            $table->string('fuel', 20);
            $table->string('type', 5)->default('M');
            $table->integer('luggage');
            $table->enum('status', ["available","reserved","crash","reforme","inavalable"]);
            $table->foreignId('category_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('agence_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('in_agaence')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
