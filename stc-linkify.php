<?php
/*
Plugin Name: STC - Linkify
Plugin URI: http://ottopress.com/wordpress-plugins/simple-twitter-connect/
Description: Automatically link @usernames to twitter, anywhere on the whole site.
Author: Otto
Version: 0.8
Author URI: http://ottodestruct.com
License: GPL2

    Copyright 2010  Samuel Wood  (email : otto@ottodestruct.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2, 
    as published by the Free Software Foundation. 
    
    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    
    The license for this software can likely be found here: 
    http://www.gnu.org/licenses/gpl-2.0.html
    
*/

/*
	This is really a sort of demo plugin, to show how to use @anywhere with STC.
	Feel free to make your own STC @anywhere plugin using this code as an example.
	More info on @anywhere script is here: http://dev.twitter.com/anywhere/begin

*/
// checks for stc on activation
function stc_linkify_activation_check(){
	if (function_exists('stc_version')) {
		if (version_compare(stc_version(), '0.7', '>=')) {
			return;
		}
	}
	deactivate_plugins(basename(__FILE__)); // Deactivate ourself
	wp_die("The base stc plugin must be activated before this plugin will run.");
}
register_activation_hook(__FILE__, 'stc_linkify_activation_check');


// add the simple javascript to the footer
add_action('wp_footer','stc_linkify');
function stc_linkify() {
?>
<script type="text/javascript">
	twttr.anywhere(function (twitter) {
		twitter.linkifyUsers();
	});
</script>
<?php
}
