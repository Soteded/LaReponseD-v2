<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quiz';
    protected $primaryKey = 'quizId';

    public function user() {
        return $this->hasOne('App\User', 'id', 'CreatorId');
    }
    public function category() {
        return $this->hasOne('App\Category', 'categoryId', 'RCategoryId');
    }

    public function questions() {
        return $this->hasMany('App\Questions', 'RQuizId', 'quizId');
    }

    public function comments() {
        return $this->hasMany('App\UserNoteQuiz', 'RQuizId', 'quizId');
    }

    protected $fillable = [
        'titre',
        'category', 
        'creatorId', 
        'noteAvg',
        'compteur',
        'image',
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
