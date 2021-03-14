<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Agence;
use App\Models\Car;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CarController
 */
class CarControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $cars = Car::factory()->count(3)->create();

        $response = $this->get(route('car.index'));
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CarController::class,
            'store',
            \App\Http\Requests\CarStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $name = $this->faker->name;
        $model = $this->faker->word;
        $carNumber = $this->faker->numberBetween(-10000, 10000);
        $horse = $this->faker->numberBetween(-10000, 10000);
        $kilometers = $this->faker->numberBetween(-10000, 10000);
        $dor = $this->faker->numberBetween(-10000, 10000);
        $fuel = $this->faker->word;
        $type = $this->faker->word;
        $luggage = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->randomElement(/** enum_attributes **/);
        $category = Category::factory()->create();
        $agence = Agence::factory()->create();
        $in_agaence = $this->faker->boolean;

        $response = $this->post(route('car.store'), [
            'name' => $name,
            'model' => $model,
            'carNumber' => $carNumber,
            'horse' => $horse,
            'kilometers' => $kilometers,
            'dor' => $dor,
            'fuel' => $fuel,
            'type' => $type,
            'luggage' => $luggage,
            'status' => $status,
            'category_id' => $category->id,
            'agence_id' => $agence->id,
            'in_agaence' => $in_agaence,
        ]);

        $cars = Car::query()
            ->where('name', $name)
            ->where('model', $model)
            ->where('carNumber', $carNumber)
            ->where('horse', $horse)
            ->where('kilometers', $kilometers)
            ->where('dor', $dor)
            ->where('fuel', $fuel)
            ->where('type', $type)
            ->where('luggage', $luggage)
            ->where('status', $status)
            ->where('category_id', $category->id)
            ->where('agence_id', $agence->id)
            ->where('in_agaence', $in_agaence)
            ->get();
        $this->assertCount(1, $cars);
        $car = $cars->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $car = Car::factory()->create();

        $response = $this->get(route('car.show', $car));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CarController::class,
            'update',
            \App\Http\Requests\CarUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $car = Car::factory()->create();
        $name = $this->faker->name;
        $model = $this->faker->word;
        $carNumber = $this->faker->numberBetween(-10000, 10000);
        $horse = $this->faker->numberBetween(-10000, 10000);
        $kilometers = $this->faker->numberBetween(-10000, 10000);
        $dor = $this->faker->numberBetween(-10000, 10000);
        $fuel = $this->faker->word;
        $type = $this->faker->word;
        $luggage = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->randomElement(/** enum_attributes **/);
        $category = Category::factory()->create();
        $agence = Agence::factory()->create();
        $in_agaence = $this->faker->boolean;

        $response = $this->put(route('car.update', $car), [
            'name' => $name,
            'model' => $model,
            'carNumber' => $carNumber,
            'horse' => $horse,
            'kilometers' => $kilometers,
            'dor' => $dor,
            'fuel' => $fuel,
            'type' => $type,
            'luggage' => $luggage,
            'status' => $status,
            'category_id' => $category->id,
            'agence_id' => $agence->id,
            'in_agaence' => $in_agaence,
        ]);

        $car->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $car->name);
        $this->assertEquals($model, $car->model);
        $this->assertEquals($carNumber, $car->carNumber);
        $this->assertEquals($horse, $car->horse);
        $this->assertEquals($kilometers, $car->kilometers);
        $this->assertEquals($dor, $car->dor);
        $this->assertEquals($fuel, $car->fuel);
        $this->assertEquals($type, $car->type);
        $this->assertEquals($luggage, $car->luggage);
        $this->assertEquals($status, $car->status);
        $this->assertEquals($category->id, $car->category_id);
        $this->assertEquals($agence->id, $car->agence_id);
        $this->assertEquals($in_agaence, $car->in_agaence);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $car = Car::factory()->create();

        $response = $this->delete(route('car.destroy', $car));

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertSoftDeleted($car);
    }
}
