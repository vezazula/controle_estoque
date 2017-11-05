<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContatoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function contato_deve_pertencer_a_um_usuario()
    {
        $usuario = factory('App\User')->create();
        $contato = factory('App\Contato')->make();
        $usuario->addContato($contato);
        $this->assertEquals($contato->usuario->id, $usuario->id);
    }
}
