<?php 

use Illuminate\Support\Facades\Auth;



function getGuardName(){
    $guards = array_keys(config('auth.guards')) ;
    foreach($guards as $guard){
        if(auth()->guard($guard)->check()){
                return $guard;
        }
    }
}