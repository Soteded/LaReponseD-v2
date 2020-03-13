<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choix extends Model
{

    public function question() {
        return $this->hasOne('App\Question');
    }
    
    protected $fillable = [
        'questionId', 'choixJuste', 'choix2', 'choix3', 'choix4'
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
