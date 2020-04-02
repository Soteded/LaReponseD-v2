<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Profile extends Model
{
    protected $table = 'profile';
    protected $primaryKey = 'profileId';

    public function user() {
        return $this->hasOne('App\User', 'id', 'userId');
    }

    public function userSince() {
        $now = Carbon::now();
        $time = date_diff($now, $this->created_at);

        $rep = "";

        switch ($time->y) {
            case 0:
                break;
            case 1:
                $rep .= "1 an,";
                break;
            default:
                $rep .= $time->y." ans, ";
                break;
        }

        switch ($time->m) {
            case 0:
                break;
            default:
                $rep .= " ".$time->m." mois et ";
                break;
        }

        switch ($time->d) {
            case 0:
                break;
            case 1:
                $rep .= "1 jour";
                break;
            default:
                $rep .= $time->d." jours";
                break;
        }

        return $rep;
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
