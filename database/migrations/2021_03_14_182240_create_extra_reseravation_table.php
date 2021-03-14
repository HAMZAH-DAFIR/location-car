<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraReseravationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // public function up()
    // {
    //     Schema::disableForeignKeyConstraints();

    //     Schema::create('extra_reseravation', function (Blueprint $table) {
    //         $table->foreignId('extra_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
    //         $table->foreignId('reseravation_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
    //     });

    //     Schema::enableForeignKeyConstraints();
    // }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('extra_reseravation');
    }
}
