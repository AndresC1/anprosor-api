<?php

namespace Tests\Feature\User;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChangeStatusTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function change_at_user_role_analyst(): void
    {
        $user_login = UserFactory::new()->create([
            'role_id' => 1,
            'is_active' => 1,
        ]);
        $this->actingAs($user_login);

        $user_analyst = UserFactory::new()->create([
            'role_id' => 2,
            'is_active' => 1,
        ]);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', '/api/v1/user/change_status', [
            'user_id' => $user_analyst->id,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'id' => $user_analyst->id,
            'is_active' => 0,
        ]);
    }

    /** @test */
    public function change_at_account_admin_active(): void
    {
        $user_login = UserFactory::new()->create([
            'role_id' => 1,
            'is_active' => 1,
        ]);
        $this->actingAs($user_login);

        $user_admin = UserFactory::new()->create([
            'role_id' => 1,
            'is_active' => 1,
        ]);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', '/api/v1/user/change_status', [
            'user_id' => $user_admin->id,
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseHas('users', [
            'id' => $user_admin->id,
            'is_active' => 1,
        ]);
    }

    /** @test */
    public function change_at_account_admin_inactive(){
        $user_login = UserFactory::new()->create([
            'role_id' => 1,
            'is_active' => 1,
        ]);
        $this->actingAs($user_login);
        $user_admin = UserFactory::new()->create([
            'role_id' => 1,
            'is_active' => 0,
        ]);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', '/api/v1/user/change_status', [
            'user_id' => $user_admin->id,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'id' => $user_admin->id,
            'is_active' => 1,
        ]);
    }

    /** @test */
    public function change_at_yourself(){
        $user_login = UserFactory::new()->create([
            'role_id' => 1,
            'is_active' => 1,
        ]);
        $this->actingAs($user_login);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', '/api/v1/user/change_status', [
            'user_id' => $user_login->id,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'id' => $user_login->id,
            'is_active' => 0,
        ]);
    }
}
