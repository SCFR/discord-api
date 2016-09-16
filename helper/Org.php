<?php namespace SCFRDiscord\helper;
  class Org {

    public $SSID, $logo, $title;

    private $db;

    public function __construct($_ssid) {
      global $wpdb;
      $this->db = $wpdb;
      $this->SSID = $_ssid;
      $this->process_org();
    }

    private function process_org() {
        
    }


  }
?>
