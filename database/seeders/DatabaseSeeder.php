<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Hasan',
            'username' => 'hasan',
            'password' => Hash::make('hasan123'),
        ]);
        // \App\Models\PriceList::factory()->create([
        //     'size' => 'S',
        //     'price' => '50000',
        //     'price_sale' => '750000'
        // ]);
        // \App\Models\PriceList::factory()->create([
        //     'size' => 'M',
        //     'price' => '60000',
        //     'price_sale' => '100000'
        // ]);
        // \App\Models\PriceList::factory()->create([
        //     'size' => 'L',
        //     'price' => '60000',
        //     'price_sale' => '100000'
        // ]);
        // \App\Models\PriceList::factory()->create([
        //     'size' => 'XL',
        //     'price' => '60000',
        //     'price_sale' => '100000'
        // ]);
        // \App\Models\PriceList::factory()->create([
        //     'size' => 'XXL',
        //     'price' => '65000',
        //     'price_sale' => '105000'
        // ]);

        // $this->call([
        //     CustomerSeeder::class,
        // ]);
    }
}