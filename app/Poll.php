<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable=array('name','email','favorite_browser_code','user_browser_code','reason');
}
