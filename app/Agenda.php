<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = "agenda";
    public $primaryKey = "id";
    public $timestamps = false;
}
