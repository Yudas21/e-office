<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Divisi extends Model
{
    use SoftDeletes;
    
    protected $table = 'divisi';

    protected $fillable = [
        'name','parent'
    ];
    protected $dates = ['deleted_at'];
}
