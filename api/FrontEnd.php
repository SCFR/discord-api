<?php namespace SCFRDiscord\api;
class FrontEnd {

  function __construct() {
    global $wpdb;
    $this->db = $wpdb;
    error_reporting(-1);
    add_action('init', array(&$this, "setCurrentUser"));
    add_action('rest_api_init', array(&$this, 'register_api_endpoints') );
  }

  public function register_api_endpoints() {
    $namespace = 'Discord';

    \register_rest_route( $namespace, '/Connect/', array(
      'methods' => 'GET',
      'callback' => array( &$this, 'connect' ),
    ) );

    \register_rest_route( $namespace, '/Authorize/', array(
      'methods' => 'GET',
      'callback' => array( &$this, 'authorize' ),
    ) );

    \register_rest_route( $namespace, '/RefreshDiscord/', array(
      'methods' => 'GET',
      'callback' => array( &$this, 'update_discord_data' ),
    ) );

    \register_rest_route( $namespace, '/OAuthStatus/', array(
      'methods' => 'GET',
      'callback' => array( &$this, 'oauth_status' ),
    ) );

  }

  public function setCurrentUser() {
    global $current_user;
    $this->user = $current_user;
  }

  public function get_forum_id() {
    if($this->user->data->ID > 0) return \get_user_meta( $this->user->data->ID , "_wphpbb_forum_user_id" , true);
    else return false;
  }

  public function oauth_status() {
    $user_id = $this->get_forum_id();
    if($user_id) {
      $token = $this->get_token();
      if($token) {
        $data = $this->fetch_discord_data();
        if($data['id']) return "USER_OKAY";
      }
      return "USER_NO_TOKEN";
    }
    return "USER_NOT_LOGGED_IN";
  }

  public function connect() {
    $client = new \OAuth2\Client(\SCFRDiscord\Settings::DISCORD_ID, \SCFRDiscord\Settings::DISCORD_PRIVATE);
    $auth_url = $client->getAuthenticationUrl("https://discordapp.com/api/oauth2/authorize", \SCFRDiscord\Settings::DISCORD_URI, array("scope" => "identify guilds"));
    header('Location: ' . $auth_url);
    die('Redirect');
  }

  public function authorize($args) {
    $user_id = $this->get_forum_id();
    if($user_id) {
      $client = new \OAuth2\Client(\SCFRDiscord\Settings::DISCORD_ID, \SCFRDiscord\Settings::DISCORD_PRIVATE);
      $params = array('code' => $args['code'], 'redirect_uri' => \SCFRDiscord\Settings::DISCORD_URI);
      $response = $client->getAccessToken("https://discordapp.com/api/oauth2/token", 'authorization_code', $params);

      $info = $response["result"];
      if($info["access_token"]) {
        $sql = "INSERT INTO discord_users (forum_id,token,discord_id,username,discriminator) VALUES ('{$user_id}', '{$info['access_token']}', '', '', '')
        ON DUPLICATE KEY UPDATE token = '{$info['access_token']}'";

        $this->db->query($sql);

        return $this->update_discord_data();
      }
      else return $response;
    }
  }

  public function update_discord_data() {
    $user_id = $this->get_forum_id();
    if($user_id) {
      $data = $this->fetch_discord_data();

      $sql = "UPDATE discord_users SET discord_id='{$data['id']}', username='{$data['username']}', discriminator='{$data['discriminator']}', avatar='{$data['avatar']}' WHERE forum_id='{$user_id}'";

      $this->db->query($sql);
      return $data;
    }

  }

  public function fetch_discord_data() {
    $token = $this->get_token();
    if($token) {
      $client = new \OAuth2\Client(\SCFRDiscord\Settings::DISCORD_ID, \SCFRDiscord\Settings::DISCORD_PRIVATE);

      $client->setAccessToken($token);
      $client->setAccessTokenType(\OAuth2\Client::ACCESS_TOKEN_BEARER);
      $response = $client->fetch('https://discordapp.com/api/users/@me');
      return $response["result"];
    }
  }

  public function get_token() {
    $user_id = $this->get_forum_id();
    if($user_id) {
      $sql = "SELECT token FROM discord_users WHERE forum_id='{$user_id}'";
      $result = $this->db->get_row($sql);

      return $result->token;
    }
    return false;
  }

}

?>
