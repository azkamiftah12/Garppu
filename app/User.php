<?php



namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'userprofile';
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'nik', 'nama', 'noTelp', 'password', 'userRole',
    ];
}
