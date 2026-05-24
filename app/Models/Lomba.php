<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['nama_lomba', 'deskripsi', 'batas_kuota_maksimal'])]
class Lomba extends Model
{
    use HasFactory;

    /**
     * Relasi ke User (Many-to-Many via pendaftarans).
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'pendaftarans')
                    ->withPivot('id', 'status')
                    ->withTimestamps();
    }
}
