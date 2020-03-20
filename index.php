<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */
/*$ip = $_SERVER["REMOTE_ADDR"];
//echo $ip; die;
$ipCoger = '10.147.214';
$ips_com_acesso = [
	"$ipCoger.11",
	"$ipCoger.53",//Braun
	"$ipCoger.24",//Costa
	"$ipCoger.43",//Ten Ziemmermann
	"$ipCoger.162",//Maj Heitor
    "$ipCoger.163",//Maj Heitor
	"$ipCoger.186", // Ten. Carolina.
	"$ipCoger.31", // Ten. Titão.
];
// if(!in_array($ip, $ips_com_acesso)) header('Location: http://10.22.9.210/sjd/');
if(!in_array($ip, $ips_com_acesso)) die("Temporariamente fora do ar. Vide notícias na Intranet.");*/
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';
