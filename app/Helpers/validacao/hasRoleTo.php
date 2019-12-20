<?php
use Illuminate\Support\Facades\Auth;
if (! function_exists('hasRoleTo')) 
{
	function hasRoleTo( $role, $dd=false){
        
        if(session('roles')) {
            if($dd) dd(in_array($role, session('roles')));
            if(in_array($role, session('roles'))) return true; 
        } 

    }
}