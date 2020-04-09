<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

    protected $table = 'reports';
    protected $primaryKey = 'reportId';

    protected $fillable = [
        'idReported',
        'type',
        'message',
    ];
}
