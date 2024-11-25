<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_admin';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['kode_admin', 'nama', 'alamat'];

    public function balasans()
    {
        return $this->hasMany(Balasan::class, 'kode_admin', 'kode_admin');
    }
}