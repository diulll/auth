<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propinsi extends Model
{
    use HasFactory;
    
    protected $table = "propinsis";
    protected $primaryKey = "id";
    protected $fillable = ['id', 'nama_propinsi'];

    // relasi ke kota
    public function kotas()
    {
        return $this->hasMany(Kota::class, 'propinsi_id');
    }
}
