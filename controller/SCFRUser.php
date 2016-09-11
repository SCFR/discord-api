<?php namespace SCFRDiscord\controller;

class SCFRUser {
  function __construct() {
    global $wpdb;

    $this->db = $wpdb;

  }

  public static function do_login($args) {
      if(isset($args['scfr-token'])) return SELF::handle_login_token($args);
      else return SELF::handle_login_auth($args);
  }

  private static function handle_login_auth($args) {
    global $auth, $user;

    $forum = new \WPHPBB\controller\Phpbb();
    $forum->make_phpbb_env();

    // User is already connected
    if($user->data['is_registered']) {
        return \SCFRDiscord\helper\APIReturn::message("USER_IS_LOGGED_IN");
    }
    else {
      // Let's connect the user
      $username = $args['username'];
      $password = $args['password'];

      $result = $auth->login($username, $password);
      if($result['error_msg']) return \SCFRDiscord\helper\APIReturn::message("", $result['error_msg']);
      else {
        $user = new \SCFRDiscord\controller\DiscordUser($result["user_row"]["user_id"], "FORUM");
        if($user->is_authorized()) return \SCFRDiscord\helper\APIReturn::message(array('status' => 'USER_TOKEN',
          'token' => \SCFRDiscord\helper\Hash::hash_player($user->discord_id)));
        else return \SCFRDiscord\helper\APIReturn::message("","USER_NOT_DISCORD_AUTHORIZED");
      }
    }
  }

  private static function handle_login_token($args) {
    $error = false;
    try {
      $valid = SELF::is_valid_token($args);
    }
    catch(\Exception $e) {
      $error = \SCFRDiscord\helper\APIReturn::message("",$e->getMessage());
    }
    finally {
      if($valid) return \SCFRDiscord\helper\APIReturn::message("USER_IS_LOGGED_IN", $error);
      else return $error;
    }
  }

  public static function is_valid_token($_token = false) {
    if(isset($_token["scfr-token"])) $token = $_token["scfr-token"];
    else if(is_string($_token)) $token = $_token;
    else throw new \Exception("NO_TOKEN");
    $user_id = false;
    $user_id = \SCFRDiscord\helper\Hash::un_hash_player($token);

    if(is_numeric($user_id) && $user_id > 1) {
      $user = new \SCFRDiscord\controller\DiscordUser($user_id, 'DISCORD');
      if($user->is_authorized()) return true;
      else  throw new \Exception("USER_NOT_DISCORD_AUTHORIZED");
    }
    else throw new \Exception("INVALID_TOKEN");
  }

  public static function check_login($args = false) {
    return SELF::is_valid_token($args);
  }

  public static function get_current_user_id($args = false) {
    $valid = $error = false;
    try {
      $valid = SELF::is_valid_token($args);
    }
    catch(\Exception $e) {
      $error = $e->getMessage();
    }
    finally {
      if(!$error && $valid) {
        $user_id = \SCFRDiscord\helper\Hash::un_hash_player($args['scfr-token']);
        return $user_id;
      }
      else return $error;
    }
  }

}
