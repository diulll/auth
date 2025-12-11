<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kota;
use App\Models\User;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user pertama (id=1)
        $user1 = User::first();
        
        // Buat kota milik user pertama
        Kota::create([
            'nama_kota' => 'Jakarta',
            'provinsi' => 'DKI Jakarta',
            'user_id' => $user1 ? $user1->id : 1,
        ]);
        
        // Buat kota milik user kedua (jika ada)
        $user2 = User::skip(1)->first();
        Kota::create([
            'nama_kota' => 'Bandung',
            'provinsi' => 'Jawa Barat',
            'user_id' => $user2 ? $user2->id : 2,
        ]);
        
        // Kota lainnya
        Kota::create([
            'nama_kota' => 'Surabaya',
            'provinsi' => 'Jawa Timur',
            'user_id' => $user1 ? $user1->id : 1,
        ]);
    }
}
