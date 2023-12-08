<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Office;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OfficeController
 */
class OfficeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $offices = Office::factory()->count(3)->create();

        $response = $this->get(route('office.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OfficeController::class,
            'store',
            \App\Http\Requests\OfficeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $name = $this->faker->name;

        $response = $this->post(route('office.store'), [
            'name' => $name,
        ]);

        $offices = Office::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $offices);
        $office = $offices->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $office = Office::factory()->create();

        $response = $this->get(route('office.show', $office));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OfficeController::class,
            'update',
            \App\Http\Requests\OfficeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $office = Office::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('office.update', $office), [
            'name' => $name,
        ]);

        $office->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $office->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $office = Office::factory()->create();

        $response = $this->delete(route('office.destroy', $office));

        $response->assertNoContent();

        $this->assertModelMissing($office);
    }
}
