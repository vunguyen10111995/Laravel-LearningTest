<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_in_can_store_user()
    {
        $data = [
            'name' => 'depzai10111995',
            'email' => 'vunguyen10111995@gmail.com',
            'password' => '123456',
            'password_confirmation' => '123456'
        ];

        $this->postJson('/register')->assertStatus(422);

        $this->postJson('/register', $data)->assertStatus(302);
    }
}
