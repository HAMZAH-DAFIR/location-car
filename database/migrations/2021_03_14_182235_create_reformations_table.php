<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('reformations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mechanic_id')->constrained('employes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('damage_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('description')->nullable();
            $table->float('totalprice');
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
        Schema::dropIfExists('reformations');
    }
}
