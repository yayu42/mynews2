<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $guarded = array('id');
    
    public static $rules = array(
        'title' => 'required',
        'gender' => 'required',
        'body' => 'required',
        'main' => 'required',
    );
}

