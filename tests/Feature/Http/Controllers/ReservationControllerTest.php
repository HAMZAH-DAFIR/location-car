<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\AgenceBack;
use App\Models\Car;
use App\Models\Reservatio;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ReservationController
 */
class ReservationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $reservations = Reservation::factory()->count(3)->create();

        $response = $this->get(route('reservation.index'));
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReservationController::class,
            'store',
            \App\Http\Requests\ReservationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $car = Car::factory()->create();
        $user = User::factory()->create();
        $date_start = $this->faker->dateTime();
        $date_back = $this->faker->dateTime();
        $time_start = $this->faker->numberBetween(-10000, 10000);
        $time_back = $this->faker->numberBetween(-10000, 10000);
        $agenceBack = AgenceBack::factory()->create();
        $confiremed = $this->faker->boolean;

        $response = $this->post(route('reservation.store'), [
            'car_id' => $car->id,
            'user_id' => $user->id,
            'date_start' => $date_start,
            'date_back' => $date_back,
            'time_start' => $time_start,
            'time_back' => $time_back,
            'agenceBack_id' => $agenceBack->id,
            'confiremed' => $confiremed,
        ]);

        $reservations = Reservation::query()
            ->where('car_id', $car->id)
            ->where('user_id', $user->id)
            ->where('date_start', $date_start)
            ->where('date_back', $date_back)
            ->where('time_start', $time_start)
            ->where('time_back', $time_back)
            ->where('agenceBack_id', $agenceBack->id)
            ->where('confiremed', $confiremed)
            ->get();
        $this->assertCount(1, $reservations);
        $reservation = $reservations->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $reservation = Reservation::factory()->create();

        $response = $this->get(route('reservation.show', $reservation));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReservationController::class,
            'update',
            \App\Http\Requests\ReservationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $reservation = Reservation::factory()->create();
        $car = Car::factory()->create();
        $user = User::factory()->create();
        $date_start = $this->faker->dateTime();
        $date_back = $this->faker->dateTime();
        $time_start = $this->faker->numberBetween(-10000, 10000);
        $time_back = $this->faker->numberBetween(-10000, 10000);
        $agenceBack = AgenceBack::factory()->create();
        $confiremed = $this->faker->boolean;

        $response = $this->put(route('reservation.update', $reservation), [
            'car_id' => $car->id,
            'user_id' => $user->id,
            'date_start' => $date_start,
            'date_back' => $date_back,
            'time_start' => $time_start,
            'time_back' => $time_back,
            'agenceBack_id' => $agenceBack->id,
            'confiremed' => $confiremed,
        ]);

        $reservation->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($car->id, $reservation->car_id);
        $this->assertEquals($user->id, $reservation->user_id);
        $this->assertEquals($date_start, $reservation->date_start);
        $this->assertEquals($date_back, $reservation->date_back);
        $this->assertEquals($time_start, $reservation->time_start);
        $this->assertEquals($time_back, $reservation->time_back);
        $this->assertEquals($agenceBack->id, $reservation->agenceBack_id);
        $this->assertEquals($confiremed, $reservation->confiremed);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $reservation = Reservation::factory()->create();
        $reservation = Reservatio::factory()->create();

        $response = $this->delete(route('reservation.destroy', $reservation));

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertDeleted($reservation);
    }
}
