<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = ['vote_type'];

    // Define the relationship with candidates
    public function dapil()
    {
        return $this->hasMany(Dapil::class);
    }

    public function c1()
    {
        return $this->hasMany(C1::class);
    }
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
