<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    protected $guarded = [];
// Relation ship with khats tabel
    public function khat()
    {
        return $this->belongsTo(Khat::class);
    }
// Relation ship with users tabel
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
