<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Agence;
use App\Models\Employe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\EmployeController
 */
class EmployeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $employes = Employe::factory()->count(3)->create();

        $response = $this->get(route('employe.index'));
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EmployeController::class,
            'store',
            \App\Http\Requests\EmployeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $user = User::factory()->create();
        $role = $this->faker->word;
        $birthday = $this->faker->dateTime();
        $cni = $this->faker->word;
        $agence = Agence::factory()->create();

        $response = $this->post(route('employe.store'), [
            'user_id' => $user->id,
            'role' => $role,
            'birthday' => $birthday,
            'cni' => $cni,
            'agence_id' => $agence->id,
        ]);

        $employes = Employe::query()
            ->where('user_id', $user->id)
            ->where('role', $role)
            ->where('birthday', $birthday)
            ->where('cni', $cni)
            ->where('agence_id', $agence->id)
            ->get();
        $this->assertCount(1, $employes);
        $employe = $employes->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $employe = Employe::factory()->create();

        $response = $this->get(route('employe.show', $employe));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EmployeController::class,
            'update',
            \App\Http\Requests\EmployeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $employe = Employe::factory()->create();
        $user = User::factory()->create();
        $role = $this->faker->word;
        $birthday = $this->faker->dateTime();
        $cni = $this->faker->word;
        $agence = Agence::factory()->create();

        $response = $this->put(route('employe.update', $employe), [
            'user_id' => $user->id,
            'role' => $role,
            'birthday' => $birthday,
            'cni' => $cni,
            'agence_id' => $agence->id,
        ]);

        $employe->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($user->id, $employe->user_id);
        $this->assertEquals($role, $employe->role);
        $this->assertEquals($birthday, $employe->birthday);
        $this->assertEquals($cni, $employe->cni);
        $this->assertEquals($agence->id, $employe->agence_id);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $employe = Employe::factory()->create();

        $response = $this->delete(route('employe.destroy', $employe));

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertSoftDeleted($employe);
    }
}
