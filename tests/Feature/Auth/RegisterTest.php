<?php

namespace Tests\Feature\Auth;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function create_user_role_admin(): void
    {
        $user = UserFactory::new()->create([
            'role_id'=> 1,
        ]);
        $this->actingAs($user);

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->json('POST', '/api/v1/auth/register', [
            'name' => 'test',
            'email' => 'example13@example.com',
            'role_id' => 1,
        ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function create_user_role_analyst(): void
    {
        $user = UserFactory::new()->create([
            'role_id'=> 1,
        ]);
        $this->actingAs($user);

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->json('POST', '/api/v1/auth/register', [
            'name' => 'test',
            'email' => 'example13@example.com',
            'role_id' => 2,
        ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function email_already_exists(): void
    {
        $user = UserFactory::new()->create([
            'role_id' => 1,
        ]);
        $this->actingAs($user);

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->json('POST', '/api/v1/auth/register', [
            'name' => 'test',
            'email' => $user->email,
            'role_id' => 2,
        ]);

        $response->assertStatus(422);
    }
}
