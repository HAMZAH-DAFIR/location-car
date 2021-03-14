<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Component;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ComponentController
 */
class ComponentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $components = Component::factory()->count(3)->create();

        $response = $this->get(route('component.index'));
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ComponentController::class,
            'store',
            \App\Http\Requests\ComponentStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $name = $this->faker->name;
        $quantite = $this->faker->numberBetween(-10000, 10000);
        $price = $this->faker->randomFloat(/** float_attributes **/);

        $response = $this->post(route('component.store'), [
            'name' => $name,
            'quantite' => $quantite,
            'price' => $price,
        ]);

        $components = Component::query()
            ->where('name', $name)
            ->where('quantite', $quantite)
            ->where('price', $price)
            ->get();
        $this->assertCount(1, $components);
        $component = $components->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $component = Component::factory()->create();

        $response = $this->get(route('component.show', $component));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ComponentController::class,
            'update',
            \App\Http\Requests\ComponentUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $component = Component::factory()->create();
        $name = $this->faker->name;
        $quantite = $this->faker->numberBetween(-10000, 10000);
        $price = $this->faker->randomFloat(/** float_attributes **/);

        $response = $this->put(route('component.update', $component), [
            'name' => $name,
            'quantite' => $quantite,
            'price' => $price,
        ]);

        $component->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $component->name);
        $this->assertEquals($quantite, $component->quantite);
        $this->assertEquals($price, $component->price);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $component = Component::factory()->create();

        $response = $this->delete(route('component.destroy', $component));

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertSoftDeleted($component);
    }
}
