<?php

namespace App;

use Illuminate\Auth\Authenticatable;  
use Illuminate\Database\Eloquent\Model;  
use Illuminate\Auth\Passwords\CanResetPassword;  
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;  
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class usuarios extends Model implements AuthenticatableContract, CanResetPasswordContract 
{
	use Authenticatable, CanResetPassword;  

   protected $table='usuarios';
   protected $primaryKey='username';

    public $timestamps=false;

 	protected $fillable=['username','linea','password'];

 	protected $hidden=[''];
}
