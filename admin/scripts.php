<?php

// Add script to plugin
function aiob_add_script_to_plugin (){
  // Add style
  wp_enqueue_style( 'aiob_login_style', AIOB_L_PLUGIN_URL.'css/style.css');
  // Add script
  wp_enqueue_script( 'aiob_login_script', AIOB_L_PLUGIN_URL.'js/script.js', array ( 'jquery' ), 1.7, true);
}
add_action('wp_enqueue_scripts','aiob_add_script_to_plugin');

function aiob_login_admin_style() {
    wp_enqueue_style('aiob_login_default_style', AIOB_L_PLUGIN_URL.'admin/src/css/admin_style.css', __FILE__);
    wp_enqueue_style('aiob_login_bootstrap', AIOB_L_PLUGIN_URL.'admin/src/css/bootstrap.css', __FILE__);
    wp_enqueue_script( 'aiob_login_bootstrap_script', AIOB_L_PLUGIN_URL.'admin/src/js/bootstrap.js', array ( 'jquery' ), true);
    wp_enqueue_script( 'aiob_login_script', AIOB_L_PLUGIN_URL.'admin/src/js/admin_script.js', array ( 'jquery' ), 1.7, true);
}
add_action('admin_enqueue_scripts', 'aiob_login_admin_style');

?>
