<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pessoa;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pessoa>
 */
class PessoaFactory extends Factory
{
    protected $model = Pessoa::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'cpf' => $this->faker->unique()->numerify('#########'),
            'email' => $this->faker->unique()->safeEmail(),
            'data_nasc' => $this->faker->date(),
            'nacionalidade' => $this->faker->country(),
        ];
    }
}