<?php

namespace Database\Factories;

use App\Models\PorticoAforador;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PorticoAforadorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PorticoAforador::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cuerpo = [
            'A' => 'A',
            'B' => 'B'
        ];

        $carril = [
          '1' => '1',
          '2' => '2',
          '3' => '3',
          '4' => '4',
        ];

        $startDate = Carbon::createFromTimeStamp($this->faker->dateTimeBetween('-1 years', '+1 month')->getTimestamp());

        return [
            'tag_id' => $this->faker->numerify('####-###-####'),
            'fecha_ingreso' => $startDate,
            'carril' => array_rand($carril,1),
            'cuerpo' => array_rand($cuerpo,1),
            'placa' => strtoupper(Str::random(3)).$this->faker->numerify('-###'),
        ];
    }
}
