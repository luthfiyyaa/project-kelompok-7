<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_guest';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['kode_guest', 'nama', 'alamat'];

    public function pesan()
    {
        return $this->hasOne(Pesan::class, 'kode_guest', 'kode_guest');
    }
}