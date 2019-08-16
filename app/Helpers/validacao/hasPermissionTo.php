<?php
use Illuminate\Support\Facades\Auth;
if (! function_exists('hasPermissionTo')) 
{
	function hasPermissionTo( $permission, $dd=false){
        if(!session('permissions')) {
            Auth::logout(); return redirect()->route('login');
        }
        if($dd) dd(in_array($permission, session('permissions')));
        if(in_array($permission, session('permissions'))) return true; 
        return false;
    }
}