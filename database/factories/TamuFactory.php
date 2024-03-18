<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tamu>
 */
class TamuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'kelamin' => $this->faker->randomElement(['L','P']), // Generate random enum for kelamin
            'email' => $this->faker->email,
            'nohp'=> $this->faker->phoneNumber,
            'keperluan' => $this->faker->paragraph(6),
            'tanggalDatang' => $this->faker->dateTimeBetween('-1 week', '+4 week'),
            

        ];
    }
}
