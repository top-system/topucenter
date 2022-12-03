<?php

namespace TopSystem\UCenter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use TopSystem\TopAdmin\Contracts\User as UserContract;
use TopSystem\TopAdmin\Traits\AdminUser;
use TopSystem\TopAdmin\Traits\Translatable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements UserContract
{
    use Translatable, HasApiTokens, HasFactory, Notifiable, AdminUser;

    protected $fillable = ['name', 'username', 'mobile', 'password', 'email', 'mobile', 'avatar'];

}
