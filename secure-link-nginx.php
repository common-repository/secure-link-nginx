<?php
/*
Plugin Name:  Secure Link for Nginx
Plugin URI:   https://gitlab.com/mhansent/secure-link-nginx
Description:  Shortcode to embed Nginx secure link
Version:      20181120
Author:       mht - DNAV PIP
Author URI:   https://gitlab.com/mhansent
License:      GPLv3 or later
License URI:  https://www.gnu.org/licenses/gpl.html
Text Domain:  secure-link-nginx
Domain Path:

Secure Link for Nginx is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
any later version.

Secure Link for Nginx is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Secure Link for Nginx. If not, see
https://www.gnu.org/licenses/gpl.html.
*/

function sln_create_func( $atts, $content = null ) {
	// array of character that use for searching
    $s = ['+', '/', '='];
    // array of character that use to replace
    $r = ['-', '_', ''];
    // client IP address, use for restriction base on IP
    $ip = $_SERVER['REMOTE_ADDR'];
    // client User Agent, use for restriction base on User Agent
    $ua = $_SERVER['HTTP_USER_AGENT'];
    $a = shortcode_atts( ['slfile' => ''], $atts );
    if ($content) {
        return $content  . '?sln=' . str_replace( $s, $r, base64_encode(md5($content . $ip . $ua, true ) ) );
    }
    else {
        return '?sln=' . str_replace( $s, $r, base64_encode(md5($a['slfile'] . $ip . $ua, true ) ) );
    }
}

add_shortcode( 'sln_create', 'sln_create_func' );
