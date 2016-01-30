<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class helpers

{





  public static function phoneFormat($phone)
  {
    $length = strlen($phone);
    if ($length == 9){
      $phone = preg_replace("/[^0-9]/", "", $phone);
      $phone = "(0".substr($phone,0,2).") ".substr($phone,2,3)."-".substr($phone,5);
    }
    if ($length == 10){
      $phone = preg_replace("/[^0-9]/", "", $phone);
      $phone = "(".substr($phone,0,3).") ".substr($phone,3,3)."-".substr($phone,6);
    }
    return $phone;
  }




  public static function currencyFormat($number)
  {
    $length = strlen($number);
    if ($length > 0 ){
      return "R ".number_format($number);;
    }

  }


}
