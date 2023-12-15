<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
use HasFactory;

protected $fillable = ['name', 'nomor_urut', 'batch_id', 'id_dapil'];

// Define the relationship with the batch
public function batch()
{
    return $this->belongsTo(Batch::class);
}

public function dapil()
    {
        return $this->belongsTo(Dapil::class, 'id_dapil');
    }

// Define the relationship with votes
// public function votes()
// {
//     return $this->hasMany(Vote::class);
// }
}
