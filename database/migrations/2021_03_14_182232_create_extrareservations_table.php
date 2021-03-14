<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtrareservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('extrareservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('extra_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('reservation_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('quantite');
            $table->float('totalPrice');
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
        Schema::dropIfExists('extrareservations');
    }
}
