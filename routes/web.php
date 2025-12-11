<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\KotaAutController;
use App\Http\Controllers\PostController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin routes
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    
    // Kota routes
    Route::get('/kota/gate', [KotaController::class, 'gate'])->name('kota.gate');
    
    // Post routes
    Route::get('/post/gate', [PostController::class, 'gate'])->name('post.gate');
    
    // Seed Propinsi
    Route::get('/propinsi/seed', function() {
        \App\Models\Propinsi::firstOrCreate(['nama_propinsi' => 'DKI Jakarta']);
        \App\Models\Propinsi::firstOrCreate(['nama_propinsi' => 'Jawa Barat']);
        \App\Models\Propinsi::firstOrCreate(['nama_propinsi' => 'Jawa Tengah']);
        \App\Models\Propinsi::firstOrCreate(['nama_propinsi' => 'Jawa Timur']);
        \App\Models\Propinsi::firstOrCreate(['nama_propinsi' => 'Banten']);
        \App\Models\Propinsi::firstOrCreate(['nama_propinsi' => 'Bali']);
        \App\Models\Propinsi::firstOrCreate(['nama_propinsi' => 'Sumatera Utara']);
        \App\Models\Propinsi::firstOrCreate(['nama_propinsi' => 'Sulawesi Selatan']);
        \App\Models\Propinsi::firstOrCreate(['nama_propinsi' => 'Kalimantan Timur']);
        \App\Models\Propinsi::firstOrCreate(['nama_propinsi' => 'Papua']);
        
        return redirect()->back()->with('message', 'Data propinsi berhasil dibuat');
    })->name('propinsi.seed');
    
    Route::get('/kota/seed', function() {
        $users = \App\Models\User::all();
        
        // Insert propinsi jika belum ada
        $propinsi1 = \App\Models\Propinsi::firstOrCreate(
            ['nama_propinsi' => 'DKI Jakarta']
        );
        $propinsi2 = \App\Models\Propinsi::firstOrCreate(
            ['nama_propinsi' => 'Jawa Barat']
        );
        $propinsi3 = \App\Models\Propinsi::firstOrCreate(
            ['nama_propinsi' => 'Jawa Timur']
        );
        
        // Insert kota untuk user pertama
        if ($users->count() > 0) {
            \App\Models\Kota::create([
                'nama_kota' => 'Jakarta',
                'provinsi' => 'DKI Jakarta',
                'propinsi_id' => $propinsi1->id,
                'user_id' => $users[0]->id,
            ]);
        }
        
        // Insert kota untuk user kedua (jika ada)
        if ($users->count() > 1) {
            \App\Models\Kota::create([
                'nama_kota' => 'Bandung',
                'provinsi' => 'Jawa Barat',
                'propinsi_id' => $propinsi2->id,
                'user_id' => $users[1]->id,
            ]);
        }
        
        // Insert kota lain untuk user pertama
        if ($users->count() > 0) {
            \App\Models\Kota::create([
                'nama_kota' => 'Surabaya',
                'provinsi' => 'Jawa Timur',
                'propinsi_id' => $propinsi3->id,
                'user_id' => $users[0]->id,
            ]);
        }
        
        return redirect()->route('kota.index')->with('message', 'Data kota berhasil dibuat');
    })->name('kota.seed');
    Route::resource('kota', KotaController::class);
    
    // KotaAut routes - Policy based authorization
    Route::get('kotaAut/view', [KotaAutController::class, 'view']);
    Route::get('kotaAut/create', [KotaAutController::class, 'create']);
    Route::get('kotaAut/update', [KotaAutController::class, 'update']);
    Route::get('kotaAut/delete', [KotaAutController::class, 'delete']);
    
    // Tambahkan routes lain di sini
});

require __DIR__.'/auth.php';
