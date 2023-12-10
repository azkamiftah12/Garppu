<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = ['vote_type'];

    // Define the relationship with candidates
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
