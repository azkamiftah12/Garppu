<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class C1 extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'img_c1',
    ];

    // Relasi ke model Userprofile
    public function userprofile()
    {
        return $this->belongsTo(User::class, 'nik', 'nik');
    }
}
