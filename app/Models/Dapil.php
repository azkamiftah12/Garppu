<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dapil extends Model
{
    protected $table = 'dapil'; // Sesuaikan dengan nama tabel yang Anda gunakan

    protected $fillable = [
        'nama_dapil', 'provinsi', 'batch_id',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }
}
