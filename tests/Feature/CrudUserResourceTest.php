<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrudUserResourceTest extends TestCase
{
    // use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_create_user()
    {
        $user = new User();
        $user->factory()->create([
            "name"  => "test_name",
            "email" => "email@example.com"
        ]);
        $this->assertDatabaseHas('users', [
            "name"  => "test_name",
            "email" => "email@example.com"
        ]);
    }
}
