<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Propinsi;
use App\Models\User;

class Kota extends Model
{
    use HasFactory;
    
    protected $table = "kotas";
    protected $primaryKey = "id";
    protected $fillable = ['id', 'propinsi_id', 'nama_kota', 'user_id', 'provinsi'];

    // relasi ke propinsi
    public function propinsi()
    {
        return $this->belongsTo(Propinsi::class, 'propinsi_id');
    }
    
    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
