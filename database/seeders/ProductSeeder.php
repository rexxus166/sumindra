<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menggunakan Faker untuk generate data dummy
        $faker = Faker::create();

        // Loop untuk insert 50 data produk
        foreach (range(1, 50) as $index) {
            DB::table('products')->insert([
                'user_id' => $faker->numberBetween(1, 50), // Random user_id
                'name' => $faker->word . ' ' . $faker->word, // Nama produk
                'category' => $faker->randomElement(['pakaian', 'makanan']), // Kategori
                'description' => $faker->sentence, // Deskripsi produk
                'price' => $faker->randomFloat(2, 10000, 100000), // Harga produk antara 10.000 sampai 100.000
                'image' => 'produkImg/68300c7425f1b.jpg', // Image produk
                'stock' => $faker->numberBetween(1, 100), // Stok produk antara 1 hingga 100
                'toko_id' => $faker->numberBetween(1, 50), // Random toko_id
                'variants' => json_encode($faker->randomElements(['Original', 'Pedas', 'Asin', 'Manis', 'Besar', 'Kecil'], 3)), // Variants, ambil 3 elemen random
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}