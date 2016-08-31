<?php namespace SCFRDiscord\helper;
  class DiscordUser {

    private $db;
    protected $forum_id, $discord_id;
    protected $user_info;

    function __construct($_id = 0, $is_not_discord = true, $is_wordpress = false) {
      global $wpdb;
      $this->db = $wpdb;

      if($is_not_discord)  {
        if($is_wordpress) $this->forum_id = $this->get_forum_id($_id);
        else $this->forum_id = $_id;
      }
      else $this->discord_id = $_id;

      $this->get_both_ids();
    }

    private function get_forum_id($_id) {
      return (integer) \get_user_meta( $_id , "_wphpbb_forum_user_id" , true);
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

    public function get_user_info() {
      if(!$this->user_info) {
        $sql = "SELECT f.username FROM testfo_users as f, discord_users as d WHERE d.discord_id='{$this->discord_id}' AND forum_id = user_id";
        $q = $this->db->get_results($sql);
        $this->user_info = $q;
      }

      return $this->user_info;
    }

  }
?>
