<?php

 function aiob_login_form () {

  if ( is_user_logged_in() ) {
    $current_user = wp_get_current_user();
    $output = '<p>Welcome to our site, <strong>'.$current_user->user_login.'</strong></p>';
  } else {
    ?>
    <?php if(isset($_GET['error_msg']))echo $_GET['error_msg'];?>
    <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
      <input type="text" name="username" value="">
      <input type="password" name="pass" value="">
      <input type="submit" name="name" value="Login">
      <input type="hidden" name="action" value="aiob_login_ac">
    </form>
    <?php
  }

 }


 //[aiob-login]
 function aiob_login_shortcode(){
 	return aiob_login_form();
 }
 add_shortcode( 'aiob-login', 'aiob_login_shortcode' );





 function prefix_send_email_to_admin() {
   $redirect_link     = (get_option('aiob_login_sett_redirect') ? get_option('aiob_login_sett_redirect') : '/');
   $redirect_link     = get_permalink($redirect_link);
   $login             = $_POST['username'];
   $login_pass        = $_POST['pass'];

   (get_option('aiob_login_notif_login')) ?
   $notif_login = get_option('aiob_login_notif_login') : $notif_login = 'Username is empty';
   (get_option('aiob_login_notif_pass')) ?
   $notif_pass = get_option('aiob_login_notif_pass') : $notif_pass = 'Password is empty';
   (get_option('aiob_login_notif_loginpass')) ?
   $notif_loginpass = get_option('aiob_login_notif_loginpass') : $notif_loginpass = 'Username and Password are empty';
   (get_option('aiob_login_notif_loginpass_w')) ?
   $notif_loginpass_w = get_option('aiob_login_notif_loginpass_w') : $notif_loginpass_w = 'Username or Password is wrong';

   if(empty($login) && !empty($login_pass)){wp_redirect('/wordpress/testlogin?error_msg='.urlencode($notif_login));exit;};
   if(empty($login_pass) && !empty($login)){wp_redirect('/wordpress/testlogin?error_msg='.urlencode($notif_pass));exit;};
   if(empty($login_pass) && empty($login)){wp_redirect('/wordpress/testlogin?error_msg='.urlencode($notif_loginpass));exit;};
   if(!empty($login) && !empty($login_pass)){
     if(username_exists( $login )){
       wp_redirect('/wordpress/testlogin?error_msg='.urlencode($notif_loginpass_w));exit;
     }
    $user_info = get_user_by('login',$login);
    wp_hash_password($login_pass);
    $wp_hasher = new PasswordHash(8, TRUE);
    if($wp_hasher->CheckPassword($login_pass, $user_info->data->user_pass)) {
      // check redirect link from plugin admin
      $user_data = get_userdata ($user_info->data->ID);
      wp_set_auth_cookie ($user_data->ID, true);
      do_action ('wp_login', $user_data->user_login, $user_data);
      wp_redirect($redirect_link);
      exit;
    } else {
      wp_redirect('/wordpress/testlogin?error_msg="Username or Password is wrong"');exit;
    }
   }

 }
 add_action( 'admin_post_nopriv_aiob_login_ac', 'prefix_send_email_to_admin' );
 add_action( 'admin_post_aiob_login_ac', 'prefix_send_email_to_admin' );


?>
