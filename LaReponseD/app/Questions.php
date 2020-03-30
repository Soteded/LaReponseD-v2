<?php

namespace App;
use App\Quiz;
use App\Questions;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questions';
    protected $primaryKey = 'questionId';

    public $timestamps = false;

    public function quiz()
    {
        return $this->hasOne('App\Quiz');
    }
    
    public function choix()
    {
        return $this->hasOne('App\Choix', 'RQuestionId', 'questionId');
    }

    protected $fillable = [
        'question',
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
        
    ];
}
