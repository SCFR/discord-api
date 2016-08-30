<?php namespace SCFRDiscord\controller;
global $settings;
class Discord {

  const CLIENT_ID = \SCFRDiscord\Settings::CLIENT_ID;
  const CLIENT_SECRET = \SCFRDiscord\Settings::CLIENT_SECRET;

  const AUTHORIZATION_ENDPOINT = 'https://discordapp.com/api/oauth2/authorize';
  const TOKEN_ENDPOINT         = 'https://discordapp.com/api/oauth2/token';

  const REDIRECT_URI         = 'http://www.scfr.fr';

  private $client;

  function __construct() {
    $client = new \OAuth2\Client(SELF::CLIENT_ID, SELF::CLIENT_SECRET);
    if (!isset($_GET['code'])) {
      $auth_url = $client->getAuthenticationUrl(SELF::AUTHORIZATION_ENDPOINT, SELF::REDIRECT_URI, array("scope" => "identify"));
      print_r($auth_url);
    }
    else {
      $params = array('code' => $_GET['code'], 'redirect_uri' => SELF::REDIRECT_URI, array("scope" => "identify"));
      $response = $client->getAccessToken(SELF::TOKEN_ENDPOINT, 'authorization_code', $params);
      print_r($response);
      parse_str($response['result'], $info);
      $client->setAccessToken($info['access_token']);
      $response = $client->fetch('https://discordapp.com/api/users/me');
      var_dump($response, $response['result']);
    }

  }

}
?>
