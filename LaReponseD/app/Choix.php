<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choix extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'QuestionId', 'ChoixJuste', 'Choix2', 'Choix3', 'Choix4'
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
