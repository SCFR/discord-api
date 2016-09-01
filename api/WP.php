<?php namespace SCFRDiscord\api;

class WP {

  function __construct() {
    global $wpdb;
    $this->db = $wpdb;

    add_action('rest_api_init',array(&$this, 'register_api_endpoints') );
    add_action('rest_api_init',array(&$this, 'setCurrentUser') );
  }

  public function setCurrentUser() {
    $this->user = new \SCFRDiscord\api\SCFRUser();

    $this->loggedIn = $this->user->check_login();
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

    \register_rest_route( $namespace, '/Login/', array(
      'methods'  => 'GET',
      'callback' => array( &$this, 'do_login' ),
    ) );
  }

  public function register_api_forum_endpoints() {
    $namespace = 'Discord';


  }


  private function error_connected() {
    if($this->loggedIn) return false;
    else return "USER_NOT_LOGGED_IN";
  }

  public function validate_html() {

  }

  public function is_connected() {
    header("Access-Control-Allow-Origin: *");
      return \SCFRDiscord\helper\APIReturn::message($this->loggedIn);
  }

  public function do_login($args) {



    $phpbb = new \WPHPBB\Controller\Phpbb();
    $phpbb->make_phpbb_env();

    if()

    if($phpbb->user->data['is_registered']) {
       return \SCFRDiscord\helper\APIReturn::message("USER_LOGGED_IN");
    }
    else {
       //if ($result['status'] == LOGIN_SUCCESS) return \SCFRDiscord\helper\APIReturn::message("USER_LOGGED_IN");
       //else return \SCFRDiscord\helper\APIReturn::message("USER_LOGGED_IN", $result['error_msg']);

       return get_relevant_header();
    }
  }

  public function get_user_info() {
    $user = new \SCFRDiscord\helper\DiscordUser($this->userId, true, true);

    return \SCFRDiscord\helper\APIReturn::message($user->get_user_info(), $this->error_connected());
  }

}

?>
