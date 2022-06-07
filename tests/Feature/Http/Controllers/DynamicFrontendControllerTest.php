<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;

use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DynamicFrontendControllerTest extends TestCase
{
    use WithFaker;
    use WithoutMiddleware;
    /**
     * @test
     */
    public function it_stores_data_dynamic()
    {
        $this->withoutMiddleware();

        // make user factory model with role admin, name, email , password
        $user = User::where('roles', '=', 'ADMIN')->first();
        
        $response = $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->post(route('dynamicfe.store'), [
                'photos' => [
                    $this->faker->imageUrl(200, 200),
                    $this->faker->imageUrl(200, 200),
                    $this->faker->imageUrl(200, 200),
                ],
            ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('dynamicfe.index'));
    }

    /**
     * @test
     */
    public function it_failed_no_photos()
    {
        // $this->withoutMiddleware();

        // make user factory model with role admin, name, email , password
        $user = User::where('roles', '=', 'ADMIN')->first();

        $response = $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->from(route('dynamicfe.create'))
            ->post(route('dynamicfe.store'), [
                'photoyyyy' => [
                    $this->faker->imageUrl(200, 200),
                    $this->faker->imageUrl(200, 200),
                    $this->faker->imageUrl(200, 200),
                ],
            ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('dynamicfe.index'));
    }
}
