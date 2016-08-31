<?php namespace SCFRDiscord\api;

class WP {

  function __construct() {
    global $wpdb;
    $this->db = $wpdb;
    add_action('init', array(&$this, "setCurrentUser"));
    add_action('rest_api_init',array(&$this, 'register_api_endpoints') );
  }

  public function setCurrentUser() {
      global $current_user;
      $this->user = $current_user;
      $this->loggedIn = $this->user->data->ID > 0 ? true : false;
      $this->userId = $this->user->data->ID;
  }

  public function register_api_endpoints() {
    $namespace = 'Discord';

    \register_rest_route( $namespace, '/isLoggedIn/', array(
      'methods' => 'GET',
      'callback' => array( &$this, 'is_connected' ),
    ) );

    \register_rest_route( $namespace, '/GetUserInfo/', array(
      'methods' => 'GET',
      'callback' => array( &$this, 'get_user_info' ),
    ) );

    \register_rest_route( $namespace, '/Delete/', array(
      'methods' => 'POST',
      'callback' => array( &$this, 'test' ),
    ) );
  }

  private function error_connected() {
    if($this->loggedIn) return false;
    else return "USER_NOT_LOGGED_IN";
  }

  public function is_connected() {
    header("Access-Control-Allow-Origin: *");
      return \SCFRDiscord\helper\APIReturn::message($this->loggedIn);
  }

  public function get_user_info() {
    $user = new \SCFRDiscord\helper\DiscordUser($this->userId, true, true);

    return \SCFRDiscord\helper\APIReturn::message($user->get_user_info(), $this->error_connected());
  }

}

?>
