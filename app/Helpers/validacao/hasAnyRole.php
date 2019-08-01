<?php

if (! function_exists('hasAnyRole')) 
{
	function hasAnyRole( $roles ){
        if(!session('roles')) Auth::logout(); return redirect()->route('login');
        foreach ($roles as $role) {
            if(in_array($role, session('roles'))) return true; 
        }
        return false;
    }
}