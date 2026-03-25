<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportReply extends Model
{
    protected $fillable = [
        'id_laporan',
        'id_user',
        'parent_id',
        'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function children()
    {
        return $this->hasMany(ReportReply::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(ReportReply::class, 'parent_id');
    }
}
