<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\UserRoleController
 */
class UserRoleControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $userRoles = UserRole::factory()->count(3)->create();

        $response = $this->get(route('user-role.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UserRoleController::class,
            'store',
            \App\Http\Requests\UserRoleStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $role_name = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('user-role.store'), [
            'role_name' => $role_name,
        ]);

        $userRoles = UserRole::query()
            ->where('role_name', $role_name)
            ->get();
        $this->assertCount(1, $userRoles);
        $userRole = $userRoles->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $userRole = UserRole::factory()->create();

        $response = $this->get(route('user-role.show', $userRole));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UserRoleController::class,
            'update',
            \App\Http\Requests\UserRoleUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $userRole = UserRole::factory()->create();
        $role_name = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('user-role.update', $userRole), [
            'role_name' => $role_name,
        ]);

        $userRole->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($role_name, $userRole->role_name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $userRole = UserRole::factory()->create();

        $response = $this->delete(route('user-role.destroy', $userRole));

        $response->assertNoContent();

        $this->assertModelMissing($userRole);
    }
}
