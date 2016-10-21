<?php
/**
 * Plugin Name: all-in-one-box-login
 * Plugin URI: http://softhandy.com
 * Description: This plugin helps you to create a easy login system.
 * Version: 1.0.0
 * Author: Ashek Al Mahmud
 * Author URI: http://softhandy.com
 * License: GPL2
 */

 // Add script to plugin
 function add_script_to_plugin (){
   wp_enqueue_style( 'aiob-style', plugin_dir_url( __FILE__ ).'css/style.css');
   wp_enqueue_script( 'aiob-script', plugin_dir_url( __FILE__ ).'js/script.js', array ( 'jquery' ), 1.1, true);
 }
 add_action('wp_enqueue_scripts','add_script_to_plugin');

 //Add style to plugin


 function aiob_login_form () {

  if ( is_user_logged_in() ) {
    $current_user = wp_get_current_user();
    $output = '<p>Welcome to our site, <strong>'.$current_user->user_login.'</strong></p>';
  } else {
    $output = '<div class="login_box">';
    $output .= '<form method="post" action="'.get_site_url().'/wp-login.php" class="wp-user-form">';
    $output .= '<div class="username">';
    $output .= '<label for="user_login">Username :</label>';
    $output .= '<input type="text" name="log" value="" size="20" id="user_login" tabindex="11" />';
    $output .= '</div>';
    $output .= '<div class="password">';
    $output .= '<label for="user_pass">Password :</label>';
    $output .= '<input type="password" name="pwd" value="" size="20" id="user_pass" tabindex="12" />';
    $output .= '</div>';
    $output .= '<div class="login_fields">';
    $output .= '<div class="rememberme">';
    $output .= '<label for="rememberme">';
    $output .= '<input type="checkbox" name="rememberme" value="forever" checked="checked" id="rememberme" tabindex="13" /> Remember me';
    $output .= '</label>';
    $output .= '</div>';
    $output .= do_action("login_form");
    $output .= '<input type="submit" name="user-submit" value="Login" tabindex="14" class="user-submit" />';
    $output .= '<input type="hidden" name="redirect_to" value="'.$_SERVER["REQUEST_URI"].'" />';
    $output .= '<input type="hidden" name="user-cookie" value="1" />';
    $output .= '</div>';
    $output .= '</form>';
    $output .= '</div>';
  }
   return $output;

 }


 //[foobar]
 function aiob_login_shortcode(){
 	return aiob_login_form();
 }
 add_shortcode( 'aiob-login', 'aiob_login_shortcode' );
