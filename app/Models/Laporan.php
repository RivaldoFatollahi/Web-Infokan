<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Laporan extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = 'laporan';

    protected $fillable = [
        'id_user',
        'judul',
        'kontent',
        'gambar',
        'sentiment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
