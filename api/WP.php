<?php namespace SCFRDiscord\api;
class WP {

  function __construct() {
    global $wpdb;
    $this->db = $wpdb;

    add_action('rest_api_init',array(&$this, 'register_api_endpoints') );
  }

  public function register_api_endpoints() {
    $namespace = 'Discord';

    \register_rest_route( $namespace, '/isValidToken/', array(
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

    \register_rest_route( $namespace, '/User/(?P<id>[a-zA-Z0-9-]+)', array(
      'methods'  => 'GET',
      'callback' => array( &$this, 'get_user' ),
    ) );
  }

  private function exec_if_connected($args, $callable) {
    $error = $valid = false;
    try { $valid = \SCFRDiscord\controller\SCFRUser::check_login($args); }
    catch(\Exception $e) {
      $error = $e->getMessage();
    }
    finally {
      if($valid && !$error) return call_user_func($callable, $args);
      else return \SCFRDiscord\helper\APIReturn::message("", $error);
    }
  }

  public function get_current_user_id() {

  }

  private function return_if_connected($args, $return) {
    return $this->exec_if_connected($args, function(){return \SCFRDiscord\helper\APIReturn::message($return);});
  }


  public function get_user($args) {
    return $this->exec_if_connected($args, array(&$this, "user_info"));
  }

  private function user_info($args) {
    $user = new \SCFRDiscord\controller\DiscordUser($args['id'], "DISCORD");
    return \SCFRDiscord\helper\APIReturn::try_function(array($user, "get_user_info"));
  }


  public function is_connected($args) {
    return $this->exec_if_connected($args,function(){return \SCFRDiscord\helper\APIReturn::message("USER_IS_LOGGED_IN");});
  }

  public function do_login($args) {
    return \SCFRDiscord\controller\SCFRUser::do_login($args);
  }

  public function get_user_info($args) {
    $discord_id = \SCFRDiscord\controller\SCFRUser::get_current_user_id($args);
    if($discord_id > 0) {
      $user = new \SCFRDiscord\controller\DiscordUser($discord_id, "DISCORD");
      return \SCFRDiscord\helper\APIReturn::message($user->get_user_info());
    }
    else return \SCFRDiscord\helper\APIReturn::message("", $discord_id);
  }

}

?>
