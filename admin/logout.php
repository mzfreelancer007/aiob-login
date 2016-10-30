<?php

function wpse_44020_logout_redirect($logouturl, $redir)
    {
      if(get_option('aiob_login_sett_logout')){
        $aiob_login_logout_url = get_permalink( get_option('aiob_login_sett_logout') );
      } else {
        $aiob_login_logout_url = get_permalink();
      }
        return $logouturl . '&amp;redirect_to='.$aiob_login_logout_url;
    }
add_filter('logout_url', 'wpse_44020_logout_redirect', 10, 2);

?>
