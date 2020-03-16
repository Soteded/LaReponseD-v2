<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    use Notifiable, HasRoles;

    public function assignRole(Role $role) {
        return $this->roles()->save($role);
    }

    public function profile() {
        return $this->hasOne('App\Profile', 'userId');
    }

    public function quiz() {
        return $this->hasMany('App\Quiz', 'CreatorId');
    }

    public function usernotequiz() {
        return $this->hasMany('App\UserNoteQuiz', 'userPostId');
    }

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
