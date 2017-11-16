<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    
    /** @test */
    public function testBasicTest()
    {   
        $user = factory('App\User')->create();

        $this->actingAs($user)->get('/home', $user->toArray());
        $this->assertDatabaseHas('users', $user->toArray());   
    }
}