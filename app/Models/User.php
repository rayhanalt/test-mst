<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'nip',
    //     'password',
    // ];
    protected $guarded = ['id'];
    protected $table = 'users';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    // hasOne
    public function HasSiswa()
    {
        return $this->hasOne(siswa::class, 'nis', 'username');
    }
    public function HasGuru()
    {
        return $this->hasOne(guru::class, 'nip', 'username');
    }
}
