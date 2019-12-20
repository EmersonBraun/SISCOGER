<?php
use Illuminate\Support\Facades\Auth;
if (! function_exists('hasAnyPermission')) 
{
	function hasAnyPermission( $permissions ){
        if(session('permissions')){
            foreach ($permissions as $permission) {
                if(in_array($permission, session('permissions'))) return true; 
            }
            return false;
        } 
    }
}