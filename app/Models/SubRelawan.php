<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubRelawan extends Model
{
    protected $table = 'sub_relawans';
    protected $primaryKey = 'nikSubRelawan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'nikSubRelawan', 'name', 'nik', 'telephone'
        // Add other columns as needed
    ];

    // Relationships
    public function userprofile()
    {
        return $this->belongsTo(User::class, 'nik', 'nik');
    }
}

