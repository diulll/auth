<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kota;
use Illuminate\Support\Facades\Auth;

class KotaAutController extends Controller
{
    public function view()
    {
        // membaca user login
        $user = Auth::user();

        // baca kota
        $kota = Kota::find(1);

        if ($user->can('view', $kota)) {
            echo "Nama User " . $user->name .
                ", yang masuk saat ini diizinkan melihat rekaman Kota : " .
                $kota->nama_kota;
        } else {
            echo 'Tidak diijinkan ->' . $user->name;
        }
    }

    public function create()
    {
        // membaca user login
        $user = Auth::user();

        if ($user->can('create', Kota::class)) {
            echo "User : " . $user->name .
                ", yang masuk saat ini diizinkan menambah rekaman baru";
        } else {
            echo 'Tidak diijinkan';
        }
        exit;
    }

    public function update()
    {
        // membaca user login
        $user = Auth::user();

        // baca kota
        $kota = Kota::find(1);

        if ($user->can('update', $kota)) {
            echo "Nama User " . $user->name .
                ", yang masuk saat ini diizinkan mengubah rekaman Kota : " .
                $kota->nama_kota;
        } else {
            echo "Tidak di ijinkan";
        }
    }

    public function delete()
    {
        // membaca user login
        $user = Auth::user();

        // baca kota
        $kota = Kota::find(1);

        if ($user->can('delete', $kota)) {
            echo "Nama User " . $user->name .
                ", yang masuk saat ini diizinkan meghapus rekaman Kota : " .
                $kota->nama_kota;
        } else {
            echo 'tidak dijinkan';
        }
    }
}
