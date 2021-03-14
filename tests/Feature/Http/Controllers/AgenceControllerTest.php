<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Agence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AgenceController
 */
class AgenceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $agences = Agence::factory()->count(3)->create();

        $response = $this->get(route('agence.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AgenceController::class,
            'store',
            \App\Http\Requests\AgenceStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $name = $this->faker->name;
        $city = $this->faker->city;
        $adresse = $this->faker->text;
        $phone = $this->faker->phoneNumber;
        $email = $this->faker->safeEmail;

        $response = $this->post(route('agence.store'), [
            'name' => $name,
            'city' => $city,
            'adresse' => $adresse,
            'phone' => $phone,
            'email' => $email,
        ]);

        $agences = Agence::query()
            ->where('name', $name)
            ->where('city', $city)
            ->where('adresse', $adresse)
            ->where('phone', $phone)
            ->where('email', $email)
            ->get();
        $this->assertCount(1, $agences);
        $agence = $agences->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $agence = Agence::factory()->create();

        $response = $this->get(route('agence.show', $agence));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AgenceController::class,
            'update',
            \App\Http\Requests\AgenceUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $agence = Agence::factory()->create();
        $name = $this->faker->name;
        $city = $this->faker->city;
        $adresse = $this->faker->text;
        $phone = $this->faker->phoneNumber;
        $email = $this->faker->safeEmail;

        $response = $this->put(route('agence.update', $agence), [
            'name' => $name,
            'city' => $city,
            'adresse' => $adresse,
            'phone' => $phone,
            'email' => $email,
        ]);

        $agence->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $agence->name);
        $this->assertEquals($city, $agence->city);
        $this->assertEquals($adresse, $agence->adresse);
        $this->assertEquals($phone, $agence->phone);
        $this->assertEquals($email, $agence->email);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $agence = Agence::factory()->create();

        $response = $this->delete(route('agence.destroy', $agence));

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertDeleted($agence);
    }
}
