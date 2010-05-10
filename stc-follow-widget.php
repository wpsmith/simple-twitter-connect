<?php
/*
Plugin Name: STC - Follow Button Widget
Plugin URI: http://ottopress.com/wordpress-plugins/simple-facebook-connect/
Description: Create a follow button in your sites sidebar.
Author: Otto
Version: 0.10
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

// checks for stc on activation
function stc_follow_activation_check(){
	if (function_exists('stc_version')) {
		if (version_compare(stc_version(), '0.7', '>=')) {
			return;
		}
	}
	deactivate_plugins(basename(__FILE__)); // Deactivate ourself
	wp_die("The base STC plugin must be activated before this plugin will run.");
}
register_activation_hook(__FILE__, 'stc_follow_activation_check');

// output the button
function stc_follow_button($user) {
?>
<div id="stcFollow-<?php echo $user; ?>"></div>
<script type="text/javascript">
	twttr.anywhere(function (twitter) {
		twitter('#stcFollow-<?php echo $user; ?>').followButton("<?php echo $user; ?>");
	});
</script>
<?php 
}

class STC_Follow_Widget extends WP_Widget {
	function STC_Follow_Widget() {
		$widget_ops = array('classname' => 'widget_stc-follow', 'description' => 'Twitter Follow Button');
		$this->WP_Widget('stc-follow', 'Twitter Follow Button (STC)', $widget_ops);
	}

	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<?php stc_follow_button($instance['user']); ?>
		<?php echo $after_widget; ?>
		<?php
	}

	function update($new_instance, $old_instance) {
		$options = get_option('stc_options');
		if (empty($options['autotweet_name'])) $defaultuser = '';
		else $defaultuser = $options['autotweet_name'];
		
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '', 'user' => $defaultuser) );
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['user'] = strip_tags($new_instance['user']);
		return $instance;
	}

	function form($instance) {
		$options = get_option('stc_options');
		if (empty($options['autotweet_name'])) $defaultuser = ''; 
		else $defaultuser = $options['autotweet_name'];
		
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'user' => $defaultuser) );
		$title = strip_tags($instance['title']);
		$user = strip_tags($instance['user']);
		?>
<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> 
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</label></p>
<p><label for="<?php echo $this->get_field_id('user'); ?>"><?php _e('Username:'); ?> 
<input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo $user; ?>" />
</label></p>
		<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("STC_Follow_Widget");'));

