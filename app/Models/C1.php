<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class C1 extends Model
{

    protected $table = 'c1';

    protected $fillable = [
        'nik',
        'img_c1',
        'batch_id'
    ];

    // Relasi ke model Userprofile
    public function userprofile()
    {
        return $this->belongsTo(User::class, 'nik', 'nik');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id', 'id');
    }
}
