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

  require_once('settings.php');
  require_once('OAuth2/Client.php');
  require_once('OAuth2/GrantType/IGrantType.php');
  require_once('OAuth2/GrantType/AuthorizationCode.php');
  require_once('api/WP.php');
  require_once('controller/discord.php');
  require_once('controller/SCFRUser.php');
  require_once('controller/DiscordUser.php');
  require_once('helper/APIReturn.php');
  require_once('helper/Hash.php');
  require_once('helper/User.php');
  require_once('helper/Org.php');
  require_once('helper/RSIAPI.php');
  require_once('listener/event.php');

    global $SCFRDiscord;

    class SCFRDiscord {
      public function __construct() {
        $this->event = new listener\Event();
      }

      public function plugin_init() {

      }
    }

    $SCFRDiscord = new SCFRDiscord();



    register_activation_hook(__FILE__, array($SCFRDiscord,'plugin_init'));
?>
