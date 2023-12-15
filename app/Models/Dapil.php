<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dapil extends Model
{
    protected $table = 'dapil';

    protected $fillable = [
        'nama_dapil', 'batch_id',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }
}
