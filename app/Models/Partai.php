<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partai extends Model
{
    use HasFactory;

    protected $fillable = ['nama_partai'];

    // Define the relationship with candidates
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
