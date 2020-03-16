<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNoteQuiz extends Model
{
    protected $table = 'usernotequiz';
    protected $primaryKey = 'usernotequizId';

    public function user() {
        return $this->hasOne('App\User');
    }

    public function quiz() {
        return $this->hasOne('App\Quiz');
    }
    
    protected $fillable = [
        'note','titre','corps'
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
