<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Mobil;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class ProyekFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $mobil = Mobil::all()->random();

        $tanggal_rental = Carbon::parse(fake()->dateTimeBetween('-10 days', 'now'));
        $tanggal_kembali = Carbon::parse(fake()->dateTimeBetween($tanggal_rental, '+10 days'));
        $days = $tanggal_rental->diffInDays($tanggal_kembali);

        $harga = $mobil->harga_sewa;
        $total_harga = $days * $harga;
        return [
            'nik' => $this->faker->randomElement(Customer::all())['nik'],
            'nopol' => $mobil->nopol,
            'tanggal_rental' => fake()->date(),
            'tanggal_kembali' => fake()->date(),
            'durasi' => $days,
            'total_harga' => $total_harga,
        ];
    }
}
