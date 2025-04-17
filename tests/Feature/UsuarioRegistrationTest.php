<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsuarioRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_registration_with_valid_data()
    {
        $response = $this->postJson('/api/usuario', [
            'name' => 'Test Usuario',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Usuário cadastrado com sucesso!'
            ]);

        $this->assertDatabaseHas('usuarios', [
            'email' => 'test@example.com'
        ]);
    }

    public function test_user_registration_with_invalid_data()
    {
        $response = $this->postJson('/api/usuario', [
            'name' => 'A', // Muito curto
            'email' => 'not-an-email',
            'password' => 'short',
            'password_confirmation' => 'different'
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    }
}