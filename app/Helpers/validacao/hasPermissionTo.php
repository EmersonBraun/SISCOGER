<?php

if (! function_exists('hasPermissionTo')) 
{
	function hasPermissionTo( $permission ){
        if(!session('permissions')) Auth::logout(); return redirect()->route('login');
        if(in_array($permission, session('permissions'))) return true; 
        return false;
    }
}