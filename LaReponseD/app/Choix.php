<?php

namespace App;
use App\Questions;
use Illuminate\Database\Eloquent\Model;

class Choix extends Model
{
    protected $table = 'choix';
    protected $primaryKey = 'choixId';

    public $timestamps = false;

    public function question() {
        return $this->hasOne('App\Questions');
    }
    
    protected $fillable = [
        'choixJuste', 'choix2', 'choix3', 'choix4'
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
