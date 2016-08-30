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

  require_once("php/db.class.php");
  require_once("php/api.class.php");
  require_once("php/selector.class.php");
  require_once("php/Keyboard.class.php");

    global $KEYBOARD;
    $KEYBOARD = new Keyboard();


    register_activation_hook(__FILE__, array($KEYBOARD,'plugin_init'));
?>
