<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;
use DateTimeZone;

class Controller extends BaseController{
  use AuthorizesRequests, ValidatesRequests;

  public $response=[ "done"=>false, "msg"=>"", "code"=>0, "data"=>[] ];
  public $TZ = 'America/Bogota';
  public $now;
  public $timezone;
  public $now_formatted;

  public function __construct(){
    $this->timezone = new DateTimeZone($this->TZ);
    $this->now = Carbon::now($this->TZ);
    $this->now_formatted = $this->now->format('Y-m-d H:i:s');
  }
  public function createCode( $_largo = 6 ){

    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($permitted_chars), 0, $_largo);    

  }

  public function setTime($_tz = ''){
    //formatee a Y-m-d H:i:s
    if( $_tz != '' ){
      //TODO : validar tz 
      $this->TZ = $_tz;
      $this->timezone = new DateTimeZone($this->TZ);
    }
    
    $this->now = Carbon::now($this->TZ);
    $this->now_formatted = $this->now->format('Y-m-d H:i:s');
  
  }

  public function createHash(  ){
    $r = random_bytes(5);
    return bin2hex($r);
  }

}//fin de controller padre
