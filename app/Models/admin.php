<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class admin extends user
{
    public $fillable =[
        'name',
        'email',
        'username',
        'password',
        'phone',
        'is_super',
        'status',
    ];

   use HasFactory, Notifiable;
}