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
        $usuario = factory('App\User')->create();

        $this->actingAs($usuario)->get('/home', $usuario->toArray());
        $this->assertDatabaseHas('users', $usuario->toArray());   
    }
}