<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kota;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Auth;

class KotaController extends Controller
{
    public function gate()
    {
        // Skenario 1: Test dengan kota ID 1
        echo "<h2>Skenario 1: Test dengan Kota ID = 1</h2>";
        $kota = Kota::find(1);
        
        if ($kota) {
            echo "Data Kota:<br>";
            echo "- ID Kota: " . $kota->id . "<br>";
            echo "- Nama Kota: " . $kota->nama_kota . "<br>";
            echo "- User ID pemilik: " . $kota->user_id . "<br><br>";
            
            echo "User yang login:<br>";
            echo "- ID User: " . \Auth::user()->id . "<br>";
            echo "- Nama User: " . \Auth::user()->name . "<br><br>";
            
            if (Gate::allows('baca', $kota)) {
                echo "<strong style='color: green;'>✓ Akses membaca tabel kota DIIZINKAN</strong><br>";
                echo "Alasan: User ID login (" . \Auth::user()->id . ") = User ID pemilik kota (" . $kota->user_id . ")<br>";
            } else {
                echo "<strong style='color: red;'>✗ Akses membaca tabel kota TIDAK DIIZINKAN</strong><br>";
                echo "Alasan: User ID login (" . \Auth::user()->id . ") ≠ User ID pemilik kota (" . $kota->user_id . ")<br>";
            }
        } else {
            echo "<strong style='color: orange;'>Kota dengan ID 1 tidak ditemukan</strong><br>";
        }
        
        echo "<hr><br>";
        
        // Skenario 2: Test dengan kota ID 2
        echo "<h2>Skenario 2: Test dengan Kota ID = 2</h2>";
        $kota2 = Kota::find(2);
        
        if ($kota2) {
            echo "Data Kota:<br>";
            echo "- ID Kota: " . $kota2->id . "<br>";
            echo "- Nama Kota: " . $kota2->nama_kota . "<br>";
            echo "- User ID pemilik: " . $kota2->user_id . "<br><br>";
            
            echo "User yang login:<br>";
            echo "- ID User: " . \Auth::user()->id . "<br>";
            echo "- Nama User: " . \Auth::user()->name . "<br><br>";
            
            if (Gate::allows('baca', $kota2)) {
                echo "<strong style='color: green;'>✓ Akses membaca tabel kota DIIZINKAN</strong><br>";
                echo "Alasan: User ID login (" . \Auth::user()->id . ") = User ID pemilik kota (" . $kota2->user_id . ")<br>";
            } else {
                echo "<strong style='color: red;'>✗ Akses membaca tabel kota TIDAK DIIZINKAN</strong><br>";
                echo "Alasan: User ID login (" . \Auth::user()->id . ") ≠ User ID pemilik kota (" . $kota2->user_id . ")<br>";
            }
        } else {
            echo "<strong style='color: orange;'>Kota dengan ID 2 tidak ditemukan</strong><br>";
        }
        
        echo "<hr><br>";
        
        // Tampilkan semua data kota
        echo "<h2>Daftar Semua Kota</h2>";
        $allKotas = Kota::all();
        if ($allKotas->count() > 0) {
            echo "<table border='1' cellpadding='10'>";
            echo "<tr><th>ID</th><th>Nama Kota</th><th>Provinsi</th><th>User ID Pemilik</th><th>Status Akses</th></tr>";
            foreach ($allKotas as $k) {
                $access = Gate::allows('baca', $k) ? "<span style='color: green;'>✓ DIIZINKAN</span>" : "<span style='color: red;'>✗ DITOLAK</span>";
                echo "<tr>";
                echo "<td>" . $k->id . "</td>";
                echo "<td>" . $k->nama_kota . "</td>";
                echo "<td>" . $k->provinsi . "</td>";
                echo "<td>" . $k->user_id . "</td>";
                echo "<td>" . $access . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Belum ada data kota. Silakan insert data terlebih dahulu.</p>";
        }
        
        exit;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kota = Kota::with(['propinsi', 'user'])->paginate(20);
        return Inertia::render('Kota/Index', [
            'kota' => $kota,
            'message' => session('message'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $propinsis = \App\Models\Propinsi::all();
        $users = \App\Models\User::all();
        
        return Inertia::render('Kota/Create', [
            'propinsis' => $propinsis,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'propinsi_id' => 'required',
            'nama_kota' => 'required'
        ]);
        
        $user = Auth::user();
        
        if ($user->can('create', Kota::class)) {
            $kota = Kota::create($request->all());
            return redirect()->route('kota.index')
                ->with('message', 'Kota baru berhasil ditambahkan!');
        } else {
            return redirect()->route('kota.index')
                ->with('message', 'Tidak diizinkan menambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kota = Kota::findOrFail($id);
        return response()->json($kota);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kota = Kota::findOrFail($id);
        $propinsis = \App\Models\Propinsi::all();
        
        return Inertia::render('Kota/Edit', [
            'kota' => $kota,
            'propinsis' => $propinsis,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'propinsi_id' => 'required',
            'nama_kota' => 'required'
        ]);
        
        $user = Auth::user();
        $kota = Kota::find($id);
        
        if ($user->can('update', $kota)) {
            Kota::findOrFail($id)->update($request->all());
            return redirect()->route('kota.index')
                ->with('message', 'Kota berhasil diubah............!');
        } else {
            return redirect()->route('kota.index')
                ->with('message', 'Anda tidak diizinkan mengubah.........!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // membaca user login
        $user = Auth::user();
        // baca kota
        $kota = Kota::find($id);
        if ($user->can('delete', $kota)) {
            Kota::findOrFail($id)->delete();
            return redirect()->route('kota.index')
                ->with('message', 'Kota ' . $kota->nama_kota . ' berhasil dihapus............!');
        } else {
            return redirect()->route('kota.index')
                ->with('message', 'Anda tidak diizinkan menghapus............!');
        }
    }
}
