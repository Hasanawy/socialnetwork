<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthContract;

class User extends Model implements AuthContract 
{
    //
     use Authenticatable;
     public function posts()
     {
     	return $this->hasMany('App\Post');
     }

      public function likes()
    {
    	return $this->hasMany('App\Like');
    }
	
}
