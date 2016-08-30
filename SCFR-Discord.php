<?php
/*
Plugin Name: SCFR Discord
Author URI: http://www.starcitizen.fr
Description: Discord API Star Citizen
Version: 1.0
Author: SCFR Team
Author URI: http://www.starcitizen.fr
License: Private
*/
namespace SCFRDiscord;

error_reporting(-1);
  require_once('settings.php');
  require_once('OAuth2/Client.php');
  require_once('OAuth2/GrantType/IGrantType.php');
  require_once('OAuth2/GrantType/AuthorizationCode.php');
  require_once('controller/discord.php');

    global $SCFRDiscord;

    class SCFRDiscord {
      function __construct() {

      }

      public function plugin_init() {

      }
    }

    $SCFRDiscord = new SCFRDiscord();

    $test = new controller\Discord();
    die();


    register_activation_hook(__FILE__, array($SCFRDiscord,'plugin_init'));
?>
