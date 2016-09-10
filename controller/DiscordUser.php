<?php namespace SCFRDiscord\controller;
  class DiscordUser {

    private $db;
    public $forum_id, $discord_id;
    public $user_info;

    // @param $_id : id user
    // @param $user_type : type of user for given id
    function __construct($_id = 0, $user_type = "") {
      global $wpdb;
      $this->db = $wpdb;


      switch($user_type) {
        case "":
        case "DISCORD":
        $this->discord_id = $_id;
        break;
        case "FORUM":
        $this->forum_id = $_id;
        break;
        case "WORDPRESS":
        $this->forum_id = $this->get_forum_id($_id);
        break;
        case "INTERNAL":
        $this->get_internals($_id);
        default:
        throw new \Exception("UserType unvalid");
        break;
      }

      $this->get_both_ids();
    }

    private function get_forum_id($_id) {
      return (integer) \get_user_meta( $_id , "_wphpbb_forum_user_id" , true);
    }

    private function get_internals($_id) {
      $sql = "SELECT * FROM discord_users WHERE id='{$_id}' LIMIT 1";
      $ids = $this->db->get_results($sql);
      if($ids[0]->id = $_id) {
        $this->forum_id = $ids[0]->forum_id;
        $this->discord_id = $ids[0]->discord_id;
      }
    }

    private function get_both_ids() {
      if($this->forum_id > 0) {
        $w = "forum_id";
        $d = $this->forum_id;
      }
      else {
        $w = "discord_id";
        $d = $this->discord_id;
      }

      $sql = "SELECT forum_id, discord_id FROM discord_users WHERE {$w}='{$d}'";
      $ids = $this->db->get_results($sql);
      $this->forum_id = $ids[0]->forum_id;
      $this->discord_id = $ids[0]->discord_id;
    }

    public function is_authorized() {
      return (isset($this->forum_id) && isset($this->discord_id));
    }

    public function get_user_info() {
      if(!$this->user_info) {
        $sql = "SELECT f.username, d.* FROM testfo_users as f, discord_users as d WHERE d.discord_id='{$this->discord_id}' AND forum_id = user_id";
        $q = $this->db->get_results($sql);
        $this->user_info = $q;
      }

      return $this->user_info;
    }

  }
?>
