<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['lomba_id', 'peserta_1_id', 'peserta_2_id', 'pemenang_id', 'babak', 'status'])]
class Pertandingan extends Model
{
    use HasFactory;

    protected $table = 'pertandingans';

    /**
     * Relasi ke Lomba.
     */
    public function lomba()
    {
        return $this->belongsTo(Lomba::class);
    }

    /**
     * Relasi ke Peserta 1.
     */
    public function peserta1()
    {
        return $this->belongsTo(User::class, 'peserta_1_id');
    }

    /**
     * Relasi ke Peserta 2.
     */
    public function peserta2()
    {
        return $this->belongsTo(User::class, 'peserta_2_id');
    }

    /**
     * Relasi ke Pemenang.
     */
    public function pemenang()
    {
        return $this->belongsTo(User::class, 'pemenang_id');
    }
}
