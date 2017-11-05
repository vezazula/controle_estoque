<?php

namespace Tests\Feature;

use App\Contato;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GerenciarContatosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function usuario_logado_pode_inserir_novo_contato()
    {
        $usuario = factory('App\User')->create();
        $contato = factory('App\Contato')->make(['user_id' => $usuario->id]);
        $this->actingAs($usuario)->post('/contatos', $contato->toArray());
        $this->assertDatabaseHas('contatos', $contato->toArray());
    }


    /** @test */
    public function usuario_deslogado_nao_pode_inserir_novo_contato()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $contato = factory('App\Contato')->make();
        $this->post('/contatos', $contato->toArray());
        $this->assertDatabaseMissing('contatos', $contato->toArray());
    }

    /** @test */
    public function usuario_logado_pode_visualizar_seus_contatos()
    {
        $usuario = factory('App\User')->create();
        $contatos = factory('App\Contato', 5)->create(['user_id' => $usuario->id]);

        $outroUsuario = factory('App\User')->create();
        $outrosContatos = factory('App\Contato', 5)->create(['user_id' => $outroUsuario->id]);

        $response = $this->actingAs($usuario)->get('/contatos');
        foreach ($contatos as $contato) {
            $response->assertSee($contato->nome);
            $response->assertSee($contato->email);
            $response->assertSee($contato->informacoes);
        }

        foreach ($outrosContatos as $outroContato) {
            $response->assertDontSee($outroContato->nome);
            $response->assertDontSee($outroContato->email);
            $response->assertDontSee($outroContato->informacoes);
        }
    }

    /** @test */
    public function usuario_deslogado_nao_pode_visualizar_contatos()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $contato = factory('App\Contato')->create();
        $this->get('/contatos');
    }

    /** @test */
    public function usuario_logado_pode_deletar_seus_contatos()
    {
        $usuario = factory('App\User')->create();
        $contato = factory('App\Contato')->create(['user_id' => $usuario->id]);
        $outroContato = factory('App\Contato')->create();

        $response = $this->actingAs($usuario)->delete('/contatos', $contato->toArray());
        $response->assertStatus(200);
        $this->assertDatabaseMissing('contatos', $contato->toArray());

        $response = $this->actingAs($usuario)->delete('/contatos', $outroContato->toArray());
        $response->assertStatus(403);
        $this->assertDatabaseHas('contatos', $outroContato->toArray());
    }

    /** @test */
    public function usuario_deslogado_nao_pode_deletar_contatos()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $contato = factory('App\Contato')->create();
        $this->assertDatabaseHas('contatos', $contato->toArray());
        $this->delete('/contatos', $contato->toArray());
    }

    /** @test */
    public function usuario_logado_pode_alterar_um_contato()
    {
        $usuario = factory('App\User')->create();
        $contato = factory('App\Contato')->create(['user_id' => $usuario->id]);
        $outroContato = factory('App\Contato')->create();
        $contato->nome = "nome";

        $response = $this->actingAs($usuario)->put("/contatos/" . $contato->id, $contato->toArray());
        $this->assertDatabaseHas('contatos', $contato->toArray());
        $response->assertStatus(200);

        $response = $this->actingAs($usuario)->put("/contatos/" . $outroContato->id, $outroContato->toArray());
        $response->assertStatus(403);
    }


}
