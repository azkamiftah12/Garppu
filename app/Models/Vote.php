<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vote extends Model
{

    use HasFactory;

    protected $fillable = [
        'nik',
        'candidate_id',
        'jumlah_vote',
        'status_acc',
    ];

    // Relasi ke model Candidate
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }

    // Relasi ke model User
    public function userprofile()
    {
        return $this->belongsTo(User::class, 'nik', 'nik');
    }
}
