<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balasan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_balasan';

    protected $fillable = ['pesan_id', 'code_admin', 'isi_balasan'];

    public function pesan()
    {
        return $this->belongsTo(Pesan::class, 'pesan_id', 'id_pesan');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'code_admin', 'kode_admin');
    }
}