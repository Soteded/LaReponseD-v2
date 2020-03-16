<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questions';
    protected $primaryKey = 'questionsId';

    public function quiz()
    {
        return $this->hasOne('App\Quiz');
    }
    
    public function choix()
    {
        return $this->hasOne(Choix::class, 'questionId', 'id');
    }

    protected $fillable = [
        'question', 'quizId'
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
        
    ];
}
