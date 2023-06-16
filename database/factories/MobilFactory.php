<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mobil>
 */
class MobilFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Mendapatkan nama-nama file gambar yang ada di direktori public/gambar
        $nama_file = scandir(public_path('gambar'));

        // Menghapus elemen array yang tidak diperlukan
        unset($nama_file[0]); // Menghapus elemen '.'
        unset($nama_file[1]); // Menghapus elemen '..'

        // Membuat data fakta untuk factory
        $data_fakta = [];
        foreach ($nama_file as $file) {
            $data_fakta[] = ['gambar' => $file];
        }
        return [
            'nopol' => fake()->unique()->regexify('[A-Z]{1} [0-9]{4} [A-Z]{2,3}'),
            'merk' => fake()->randomElement(['Toyota', 'Honda', 'Suzuki', 'Mitsubishi']),
            'model' => fake()->randomElement(['Avanza', 'Innova', 'Xenia', 'Ertiga']),
            'tahun' => fake()->date(),
            'warna' => fake()->randomElement(['Merah', 'Hitam', 'Putih', 'Biru']),
            'harga_sewa' => fake()->numberBetween(100000, 200000),
            'gambar' => fake()->randomElement($data_fakta)['gambar'],
        ];
    }
}
