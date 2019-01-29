<?php

if (! function_exists('hasPermission')) 
{
	function hasPermission( $user, $permission ){
        try{
            return $user->hasPermissionTo( $permission  );
        } catch ( Exception $e ){
            return false;
        }
    }
}