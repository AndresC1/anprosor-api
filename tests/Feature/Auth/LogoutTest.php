<?php

namespace Tests\Feature\Auth;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function logout_success(): void
    {
        $user = UserFactory::new()->create();
        $this->actingAs($user);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', '/api/v1/auth/logout');

        $response->assertStatus(200);
    }

    /** @test */
    public function logout_fail(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', '/api/v1/auth/logout');

        $response->assertStatus(401);
    }
}
