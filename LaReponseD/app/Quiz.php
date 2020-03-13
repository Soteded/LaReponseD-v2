<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{

    public function user() {
        return $this->hasOne('App\User');
    }
    public function questions() {
        return $this->hasMany(Question::class, 'quiz_id', 'id');
    }

    protected $fillable = [
        'Titre',
        'Category', 
        'CreatorId', 
        'NoteAvg'
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
