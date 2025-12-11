<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Propinsi;

class PropinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $propinsis = [
            'DKI Jakarta',
            'Jawa Barat',
            'Jawa Tengah',
            'Jawa Timur',
            'Banten',
            'Bali',
            'Sumatera Utara',
            'Sumatera Barat',
            'Sumatera Selatan',
            'Sulawesi Selatan',
            'Sulawesi Utara',
            'Kalimantan Timur',
            'Kalimantan Barat',
            'Papua',
        ];

        foreach ($propinsis as $nama) {
            Propinsi::firstOrCreate(['nama_propinsi' => $nama]);
        }
    }
}
