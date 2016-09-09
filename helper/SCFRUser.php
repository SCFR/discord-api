<?php namespace SCFRDiscord\helper;

class SCFRUser {
  function __construct() {
    global $wpdb;

    $this->db = $wpdb;

  }

  public static function raw_is_token($raw, $token) {
    global $db, $user, $phpbb_root_path, $phpEx, $phpbb_container;
    global $phpbb_dispatcher;

    $provider_collection = $phpbb_container->get('auth.provider_collection');
    $provider = $provider_collection->get_provider();
    $passwords_manager = $this->accessProtected($provider, "passwords_manager");

    return $passwords_manager->check($raw, $token);
  }

  private function accessProtected($obj, $prop) {
    $reflection = new \ReflectionClass($obj);
    $property = $reflection->getProperty($prop);
    $property->setAccessible(true);

    return $property->getValue($obj);
  }

  public function check_token($user_id = "2", $token = "") {
    $sql = "SELECT username, user_password FROM testfo_users WHERE user_id='{$user_id}' LIMIT 1";
    $db = $this->db->get_results($sql);

    if($db && $db->user_password === $token) return true;
    return false;
  }

  public function check_login() {
    if (!function_exists('getallheaders'))  {
      function getallheaders()  {
        $headers = '';
        foreach ($_SERVER as $name => $value) {
          if (substr($name, 0, 5) == 'HTTP_') {
            $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
          }
        }
      return $headers;
      }
    }

  //  print_r(getallheaders());

  }

}
