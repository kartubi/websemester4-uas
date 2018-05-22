<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Model
{

    use Notifiable;
    protected $table = 'mahasiswa';
    protected $fillable = [
        'name','nim','email','password','jurusan_id'
    ];
    protected $hidden = [
        'password','remember_token'
    ];

    //
}
