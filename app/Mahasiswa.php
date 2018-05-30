<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{

    use Notifiable;
    protected $table = 'mahasiswa';
    protected $fillable = [
        'name','nim','email','password','jurusan_id'
    ];
    protected $guard = 'mahasiswas';

    protected $hidden = [
        'password','remember_token'
    ];

    //
}
