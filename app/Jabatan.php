<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jabatan extends Model
{
    use SoftDeletes;
    
    protected $table = 'jabatan';

    protected $fillable = [
        'name'
    ];
    protected $dates = ['deleted_at'];
}
