<?php namespace SCFRDiscord\listener;

class Event {
  function __construct() {
    $this->register_hooks();
    $this->api = new \SCFRDiscord\api\WP();
  }

  private function register_hooks() {

  }
}
?>
