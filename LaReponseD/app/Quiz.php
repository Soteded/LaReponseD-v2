<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quiz';
    protected $primaryKey = 'quizId';

    public function user() {
        return $this->hasOne('App\User');
    }
    public function category() {
        return $this->hasOne('App\Category');
    }

    public function questions() {
        return $this->hasMany('App\Questions', 'RQuizId', 'quizId');
    }

    protected $fillable = [
        'titre',
        'category', 
        'creatorId', 
        'noteAvg',
        'compteur',
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
        'CreateAt' => 'datetime',
        'UpdateAt' => 'datetime',
    ];
}
