<?php

if (! function_exists('hasRole')) 
{
	function hasRole( $user, $role ){
        try{
            return $user->hasRole( $role  );
        } catch ( Exception $e ){
            return false;
        }
    }
}