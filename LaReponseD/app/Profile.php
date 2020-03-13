<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    public function user() {
        return $this->hasOne('App\User');
    }

    protected $fillable = [
        'userId', 'avatar', 'pseudo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];
}
