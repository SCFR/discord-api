<?php namespace SCFRDiscord\helper;
  class User {
    // Common
    public $id, $discord_id, $forum_id;
    // Forum
    public $username, $user_colour;
    // Discord
    public $discriminator;

    protected $db;

    // Creates an user helper containing every bit of
    // Relevant info as declared in class params.
    // @param {snowflake} Discord id for the user.
    function __construct($discord_id) {
      global $wpdb;

      $this->db = $wpdb;
      $this->discord_id = $discord_id;
      $this->get_user_info();
    }

    private function get_user_info($_id) {
      $sql = "SELECT f.username,f.user_colour, d.* FROM testfo_users as f, discord_users as d WHERE d.discord_id='{$this->discord_id}' AND forum_id = user_id LIMIT 1";
      $user = $this->db->get_row($sql);

      foreach($user as $pp => $val)
        $this->{$pp} = $val;
    }
  }

?>
