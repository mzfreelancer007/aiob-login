<?php

class Aiob_login_db {

  private $wpdb;

  public function __construct(){
    global $wpdb;
    $this->wpdb = $wpdb;
  }

  public function get_all ($table){
    $results = $this->wpdb->get_results( 'SELECT * FROM '.$this->wpdb->prefix.'posts WHERE post_type = "page" AND post_status="publish"',OBJECT);
    return $results;
  }

  public function get_by_id($user_login){
    $results = $this->wpdb->get_results( 'SELECT * FROM '.$this->wpdb->prefix.'users WHERE user_login = "'.$user_login.'"',OBJECT);
    return $results;
  }


}


?>
