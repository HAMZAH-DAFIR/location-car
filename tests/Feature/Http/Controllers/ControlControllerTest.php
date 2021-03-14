<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Car;
use App\Models\Control;
use App\Models\Controller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ControlController
 */
class ControlControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $controls = Control::factory()->count(3)->create();

        $response = $this->get(route('control.index'));
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ControlController::class,
            'store',
            \App\Http\Requests\ControlStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $controller = Controller::factory()->create();
        $car = Car::factory()->create();
        $confirmed = $this->faker->boolean;

        $response = $this->post(route('control.store'), [
            'controller_id' => $controller->id,
            'car_id' => $car->id,
            'confirmed' => $confirmed,
        ]);

        $controls = Control::query()
            ->where('controller_id', $controller->id)
            ->where('car_id', $car->id)
            ->where('confirmed', $confirmed)
            ->get();
        $this->assertCount(1, $controls);
        $control = $controls->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $control = Control::factory()->create();

        $response = $this->get(route('control.show', $control));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ControlController::class,
            'update',
            \App\Http\Requests\ControlUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $control = Control::factory()->create();
        $controller = Controller::factory()->create();
        $car = Car::factory()->create();
        $confirmed = $this->faker->boolean;

        $response = $this->put(route('control.update', $control), [
            'controller_id' => $controller->id,
            'car_id' => $car->id,
            'confirmed' => $confirmed,
        ]);

        $control->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($controller->id, $control->controller_id);
        $this->assertEquals($car->id, $control->car_id);
        $this->assertEquals($confirmed, $control->confirmed);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $control = Control::factory()->create();

        $response = $this->delete(route('control.destroy', $control));

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertSoftDeleted($control);
    }
}
