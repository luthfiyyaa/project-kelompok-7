<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pesan';

    protected $fillable = ['code_guest', 'isi', 'lampiran'];

    public function guest()
    {
        return $this->belongsTo(Guest::class, 'code_guest', 'kode_guest');
    }

    public function balasan()
    {
        return $this->hasOne(Balasan::class, 'id_pesan', 'id_pesan');
    }
}