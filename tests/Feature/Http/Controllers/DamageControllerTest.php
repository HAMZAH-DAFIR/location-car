<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Control;
use App\Models\Damage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DamageController
 */
class DamageControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $damages = Damage::factory()->count(3)->create();

        $response = $this->get(route('damage.index'));
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DamageController::class,
            'store',
            \App\Http\Requests\DamageStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $type = $this->faker->word;
        $price = $this->faker->randomFloat(/** float_attributes **/);
        $control = Control::factory()->create();

        $response = $this->post(route('damage.store'), [
            'type' => $type,
            'price' => $price,
            'control_id' => $control->id,
        ]);

        $damages = Damage::query()
            ->where('type', $type)
            ->where('price', $price)
            ->where('control_id', $control->id)
            ->get();
        $this->assertCount(1, $damages);
        $damage = $damages->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $damage = Damage::factory()->create();

        $response = $this->get(route('damage.show', $damage));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DamageController::class,
            'update',
            \App\Http\Requests\DamageUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $damage = Damage::factory()->create();
        $type = $this->faker->word;
        $price = $this->faker->randomFloat(/** float_attributes **/);
        $control = Control::factory()->create();

        $response = $this->put(route('damage.update', $damage), [
            'type' => $type,
            'price' => $price,
            'control_id' => $control->id,
        ]);

        $damage->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($type, $damage->type);
        $this->assertEquals($price, $damage->price);
        $this->assertEquals($control->id, $damage->control_id);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $damage = Damage::factory()->create();

        $response = $this->delete(route('damage.destroy', $damage));

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertSoftDeleted($damage);
    }
}
