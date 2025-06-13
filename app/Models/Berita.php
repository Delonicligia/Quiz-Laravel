<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = ['judul', 'isi', 'foto', 'user_id'];

    // Relasi ke model User (penulis berita)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
