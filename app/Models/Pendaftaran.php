<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'lomba_id', 'status'])]
class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans';

    /**
     * Relasi ke User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Lomba.
     */
    public function lomba()
    {
        return $this->belongsTo(Lomba::class);
    }
}
