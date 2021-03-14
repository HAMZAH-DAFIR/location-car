<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Damage;
use App\Models\Mechanic;
use App\Models\Reformation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ReformationController
 */
class ReformationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $reformations = Reformation::factory()->count(3)->create();

        $response = $this->get(route('reformation.index'));
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReformationController::class,
            'store',
            \App\Http\Requests\ReformationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $mechanic = Mechanic::factory()->create();
        $damage = Damage::factory()->create();
        $totalprice = $this->faker->randomFloat(/** float_attributes **/);

        $response = $this->post(route('reformation.store'), [
            'mechanic_id' => $mechanic->id,
            'damage_id' => $damage->id,
            'totalprice' => $totalprice,
        ]);

        $reformations = Reformation::query()
            ->where('mechanic_id', $mechanic->id)
            ->where('damage_id', $damage->id)
            ->where('totalprice', $totalprice)
            ->get();
        $this->assertCount(1, $reformations);
        $reformation = $reformations->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $reformation = Reformation::factory()->create();

        $response = $this->get(route('reformation.show', $reformation));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReformationController::class,
            'update',
            \App\Http\Requests\ReformationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $reformation = Reformation::factory()->create();
        $mechanic = Mechanic::factory()->create();
        $damage = Damage::factory()->create();
        $totalprice = $this->faker->randomFloat(/** float_attributes **/);

        $response = $this->put(route('reformation.update', $reformation), [
            'mechanic_id' => $mechanic->id,
            'damage_id' => $damage->id,
            'totalprice' => $totalprice,
        ]);

        $reformation->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($mechanic->id, $reformation->mechanic_id);
        $this->assertEquals($damage->id, $reformation->damage_id);
        $this->assertEquals($totalprice, $reformation->totalprice);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $reformation = Reformation::factory()->create();

        $response = $this->delete(route('reformation.destroy', $reformation));

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertSoftDeleted($reformation);
    }
}
