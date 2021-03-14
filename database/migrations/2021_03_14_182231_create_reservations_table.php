<?php

use App\Models\Reservation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('agent_id')->nullable()->constrained('employes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('date_start')->default(Reservation::raw('CURRENT_TIMESTAMP'))->unique();
            $table->timestamp('date_back')->default(Reservation::raw('CURRENT_TIMESTAMP'))->unique();
            $table->integer('time_start');
            $table->integer('time_back');
            $table->foreignId('agenceBack_id')->constrained('agences')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('confiremed')->default(false);
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
        Schema::dropIfExists('reservations');
    }
}
