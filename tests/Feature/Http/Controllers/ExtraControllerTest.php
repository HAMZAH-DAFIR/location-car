<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Extra;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ExtraController
 */
class ExtraControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $extras = Extra::factory()->count(3)->create();

        $response = $this->get(route('extra.index'));
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ExtraController::class,
            'store',
            \App\Http\Requests\ExtraStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $name = $this->faker->name;
        $price = $this->faker->randomFloat(/** float_attributes **/);
        $quantity = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('extra.store'), [
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
        ]);

        $extras = Extra::query()
            ->where('name', $name)
            ->where('price', $price)
            ->where('quantity', $quantity)
            ->get();
        $this->assertCount(1, $extras);
        $extra = $extras->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $extra = Extra::factory()->create();

        $response = $this->get(route('extra.show', $extra));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ExtraController::class,
            'update',
            \App\Http\Requests\ExtraUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $extra = Extra::factory()->create();
        $name = $this->faker->name;
        $price = $this->faker->randomFloat(/** float_attributes **/);
        $quantity = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('extra.update', $extra), [
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
        ]);

        $extra->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $extra->name);
        $this->assertEquals($price, $extra->price);
        $this->assertEquals($quantity, $extra->quantity);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $extra = Extra::factory()->create();

        $response = $this->delete(route('extra.destroy', $extra));

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertSoftDeleted($extra);
    }
}
