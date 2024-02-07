<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model implements Authenticatable
{
    protected $table = 'userprofile';
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'nik', 'nama', 'noTelp', 'password', 'userRole',
        'kelurahan', 'rt', 'rw', 'no_tps', 'rekening_bank', 'no_rekening', 'id_dapil',
    ];

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'nik';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    public function subRelawans(): HasMany
    {
        return $this->hasMany(SubRelawan::class, 'nik', 'nik');
    }
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class, 'nik', 'nik');
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->{$this->getRememberTokenName()};
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->{$this->getRememberTokenName()} = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function getNamaDapilAttribute()
    {
        // Assuming 'id_dapil' is the foreign key linking to the dapil table
        // Adjust the relationship and column names based on your actual structure
        return $this->dapil->nama_dapil;
    }
    public function dapil()
    {
        return $this->belongsTo(Dapil::class, 'id_dapil')->with('batch');
    }
}
