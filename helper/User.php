<?php namespace SCFRDiscord\helper;
  class User {
    // Common
    public $id, $discord_id, $forum_id;
    // Forum
    public $username, $user_colour;
    // Discord
    public $discriminator;
    // RSI
    public $handle, $org;

    protected $db;

    // Creates an user helper containing every bit of
    // Relevant info as declared in class params.
    // @param {snowflake} Discord id for the user.
    function __construct($discord_id) {
      global $wpdb;

      error_reporting(-1);

      $this->db = $wpdb;
      $this->discord_id = $discord_id;
      $this->get_user_info();
      $this->get_rsi_info();
    }

    private function get_user_info() {
      $sql = "SELECT f.username,f.user_colour, d.* FROM testfo_users as f, discord_users as d WHERE d.discord_id='{$this->discord_id}' AND forum_id = user_id LIMIT 1";
      $user = $this->db->get_row($sql);

      foreach($user as $pp => $val)
        $this->{$pp} = $val;
    }

    // Fetches relevant data for current user.
    // @classParam forum_id NEEDS to be set.
    private function get_rsi_info() {
      $sql = "SELECT pf_handle, pf_handle_public, pf_guild, pf_guild_public FROM testfo_profile_fields_data WHERE user_id='{$this->forum_id}' LIMIT 1";
      $info = $this->db->get_row($sql);
      if($info) {
        $this->handle_handle($info);
        $this->handle_org($info);
      }
    }

    private function handle_handle($info) {
      if($info->pf_handle_public !== "1" || !$info->pf_handle) return false;

      $this->handle = $info->pf_handle;
    }

    private function handle_org($info) {
      if($info->pf_guild_public !== "1" || !$info->pf_guild) return false;

      $this->org = new Org($info->pf_guild);
    }
  }

?>
