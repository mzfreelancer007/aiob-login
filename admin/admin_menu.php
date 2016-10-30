<?php
require_once(AIOB_L_PLUGIN_PATH.'admin/include/db_crud.php');
add_action('admin_menu', 'aiob_login_setup_menu');

function aiob_login_setup_menu(){
        add_menu_page(__( 'AIOB menu page', 'aiob-login' ), 'AIOB Login', 'manage_options', 'aiob_login', 'aiob_loign_menu_init' );
        //call register settings function
        add_submenu_page( 'aiob_login', 'Notifications', 'Notifications', 'manage_options', 'aiob_login_notifications', 'aiob_login_notification_page');
	      add_action( 'admin_init', 'register_aiob_login_option' );
}

function register_aiob_login_option() {
	//register settings for aiob login main page
	register_setting( 'aiob-login-settings-group', 'aiob_login_sett_redirect' );
  register_setting( 'aiob-login-settings-group', 'aiob_login_sett_logout' );

  //register settings for aiob login subpage
  // Notifications
  register_setting( 'aiob-login-notification-group', 'aiob_login_notif_login' );
  register_setting( 'aiob-login-notification-group', 'aiob_login_notif_pass' );
  register_setting( 'aiob-login-notification-group', 'aiob_login_notif_loginpass' );
  register_setting( 'aiob-login-notification-group', 'aiob_login_notif_loginpass_w' );
}

function aiob_loign_menu_init(){
  //$aiob_all_pages_list = get_pages($args);
  $aiob_db = new Aiob_login_db();
  $all_pages = $aiob_db->get_all('posts');?>



  <h1 class="aiob_login_title">All In One Box Login</h1>
  <div class="container">
    <div class="row">
      <div class="col-md-2">
       <ul class="nav nav-pills nav-stacked" id="aiob_login_sidebar_menu">
         <li role="presentation" class="active"><a href="?page=aiob_login">Settings</a></li>
         <li role="presentation"><a href="?page=aiob_login_notifications">Notifications</a></li>
       </ul>
     </div>

     <div class="col-md-10" style="border-left:1px dotted #cdcdcd">

     <form method="post" action="options.php">
        <?php settings_fields( 'aiob-login-settings-group' ); ?>
        <?php do_settings_sections( 'aiob-login-settings-group' ); ?>
       <div class="form-group">
         <label for="redirect_link">After Login Redirect</label>
         <div style="clear:both"></div>
         <select name="aiob_login_sett_redirect" value="" \>
          <?php foreach ($all_pages as $page) {?>
            <option <?php if(get_option('aiob_login_sett_redirect')==$page->ID) echo "selected"?> value="<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></option>
          <?php } ?>
         </select>
         <p class="help-block">Default value : "Your Homepage"</p>
       </div>
       <div class="form-group">
         <label for="redirect_link">After Logout Redirect</label>
         <div style="clear:both"></div>
         <select name="aiob_login_sett_logout" value="" \>
          <?php foreach ($all_pages as $page) {?>
            <option <?php if(get_option('aiob_login_sett_logout')==$page->ID) echo "selected"?> value="<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></option>
          <?php } ?>
         </select>
         <p class="help-block">Default value : "Your current page"</p>
       </div>
       <input type="submit" value="save">
       </form>
     </div>



   </div>
  </div>
  <?php
}



//Notification subpage

function aiob_login_notification_page(){
  ?>
  <h1 class="aiob_login_title">All In One Box Login</h1>
  <div class="container">
    <div class="row">
      <div class="col-md-2">
       <ul class="nav nav-pills nav-stacked" id="aiob_login_sidebar_menu">
         <li role="presentation"><a href="?page=aiob_login">Settings</a></li>
         <li role="presentation" class="active"><a href="?page=aiob_login_notifications">Notifications</a></li>
       </ul>
     </div>

     <div class="col-md-10" style="border-left:1px dotted #cdcdcd">

     <form method="post" action="options.php">
        <?php settings_fields( 'aiob-login-notification-group' ); ?>
        <?php do_settings_sections( 'aiob-login-notification-group' ); ?>
       <div class="form-group">
         <label for="redirect_link">If Username is empty</label>
         <div style="clear:both"></div>
         <input type="text" name="aiob_login_notif_login" value="<?php if(get_option('aiob_login_notif_login'))echo get_option('aiob_login_notif_login');?>">
         <p class="help-block">Default value : "Username is empty"</p>
       </div>
       <div class="form-group">
         <label for="redirect_link">If Password is empty</label>
         <div style="clear:both"></div>
         <input type="text" name="aiob_login_notif_pass" value="<?php if(get_option('aiob_login_notif_pass'))echo get_option('aiob_login_notif_pass');?>">
         <p class="help-block">Default value : "Password is empty"</p>
       </div>
       <div class="form-group">
         <label for="redirect_link">If Username and Password are both empty</label>
         <div style="clear:both"></div>
         <input type="text" name="aiob_login_notif_loginpass" value="<?php if(get_option('aiob_login_notif_loginpass'))echo get_option('aiob_login_notif_loginpass');?>">
         <p class="help-block">Default value : "Username and Password are empty"</p>
       </div>
       <div class="form-group">
         <label for="redirect_link">If Username and Password is wrong</label>
         <div style="clear:both"></div>
         <input type="text" name="aiob_login_notif_loginpass_w" value="<?php if(get_option('aiob_login_notif_loginpass_w'))echo get_option('aiob_login_notif_loginpass_w');?>">
         <p class="help-block">Default value : "Username or Password is wrong"</p>
       </div>
       <input type="submit" value="save">
       </form>
     </div>



   </div>
  </div>
  <?php
}
?>
