<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\UserController
 */
class UserControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $users = User::factory()->count(3)->create();

        $response = $this->get(route('user.index'));
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UserController::class,
            'store',
            \App\Http\Requests\UserStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $name = $this->faker->name;
        $email = $this->faker->safeEmail;
        $phone = $this->faker->phoneNumber;
        $is_admin = $this->faker->boolean;
        $password = $this->faker->password;
        $locale = $this->faker->word;

        $response = $this->post(route('user.store'), [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'is_admin' => $is_admin,
            'password' => $password,
            'locale' => $locale,
        ]);

        $users = User::query()
            ->where('name', $name)
            ->where('email', $email)
            ->where('phone', $phone)
            ->where('is_admin', $is_admin)
            ->where('password', $password)
            ->where('locale', $locale)
            ->get();
        $this->assertCount(1, $users);
        $user = $users->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $user = User::factory()->create();

        $response = $this->get(route('user.show', $user));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UserController::class,
            'update',
            \App\Http\Requests\UserUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $user = User::factory()->create();
        $name = $this->faker->name;
        $email = $this->faker->safeEmail;
        $phone = $this->faker->phoneNumber;
        $is_admin = $this->faker->boolean;
        $password = $this->faker->password;
        $locale = $this->faker->word;

        $response = $this->put(route('user.update', $user), [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'is_admin' => $is_admin,
            'password' => $password,
            'locale' => $locale,
        ]);

        $user->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $user->name);
        $this->assertEquals($email, $user->email);
        $this->assertEquals($phone, $user->phone);
        $this->assertEquals($is_admin, $user->is_admin);
        $this->assertEquals($password, $user->password);
        $this->assertEquals($locale, $user->locale);
    }


    /**
     * @test
     */
    public function destroy_deletes()
    {
        $user = User::factory()->create();

        $response = $this->delete(route('user.destroy', $user));

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertSoftDeleted($user);
    }
}
