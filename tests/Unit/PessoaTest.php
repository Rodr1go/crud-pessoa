<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Pessoa;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PessoaTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_pessoa()
    {
        $data = [
            'nome' => 'John Doe',
            'cpf' => '12345678901',
            'email' => 'johndoe@example.com',
            'data_nasc' => '1990-01-01',
            'nacionalidade' => 'USA',
        ];

        $response = $this->post(route('pessoa.store'), $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('pessoa', $data);
    }

    public function test_can_get_pessoa()
    {
        $pessoa = Pessoa::factory()->create();

        $response = $this->get(route('pessoa.show', $pessoa->id));

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'nome' => $pessoa->nome,
            'cpf' => $pessoa->cpf,
            'email' => $pessoa->email,
            'data_nasc' => $pessoa->data_nasc,
            'nacionalidade' => $pessoa->nacionalidade,
        ]);
    }

    public function test_can_update_pessoa()
    {
        $pessoa = Pessoa::factory()->create();

        $data = [
            'nome' => 'Jane Doe',
            'cpf' => '98765432101',
            'email' => 'janedoe@example.com',
            'data_nasc' => '1995-01-01',
            'nacionalidade' => 'Canada',
        ];

        $response = $this->put(route('pessoa.update', $pessoa->id), $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('pessoa', $data);
    }

    public function test_can_delete_pessoa()
    {
        $pessoa = Pessoa::factory()->create();

        $response = $this->delete(route('pessoa.destroy', $pessoa->id));

        $response->assertStatus(204);
        $this->assertDatabaseMissing('pessoa', [
            'id' => $pessoa->id,
        ]);
    }
}