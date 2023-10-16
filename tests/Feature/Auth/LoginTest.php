<?php

namespace Tests\Feature\Auth;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function correct_credentials(): void
    {
        $user = UserFactory::new()->create([
            'email' => 'test@test.com',
            'password' => Hash::make('password'),
        ]);
        $this->actingAs($user);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', '/api/v1/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    /** @test */
    public function incorrect_credentials(): void
    {
        $user = UserFactory::new()->create([
            'email' => 'example@example.com',
            'password' => Hash::make('password'),
        ]);
        $this->actingAs($user);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', '/api/v1/auth/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(401);
    }
}
