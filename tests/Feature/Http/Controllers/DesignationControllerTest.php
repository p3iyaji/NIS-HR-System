<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Designation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DesignationController
 */
class DesignationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $designations = Designation::factory()->count(3)->create();

        $response = $this->get(route('designation.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DesignationController::class,
            'store',
            \App\Http\Requests\DesignationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $name = $this->faker->name;

        $response = $this->post(route('designation.store'), [
            'name' => $name,
        ]);

        $designations = Designation::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $designations);
        $designation = $designations->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $designation = Designation::factory()->create();

        $response = $this->get(route('designation.show', $designation));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DesignationController::class,
            'update',
            \App\Http\Requests\DesignationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $designation = Designation::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('designation.update', $designation), [
            'name' => $name,
        ]);

        $designation->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $designation->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $designation = Designation::factory()->create();

        $response = $this->delete(route('designation.destroy', $designation));

        $response->assertNoContent();

        $this->assertModelMissing($designation);
    }
}
