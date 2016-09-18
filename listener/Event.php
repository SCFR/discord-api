<?php namespace SCFRDiscord\listener;

class Event {
  function __construct() {
    $this->register_hooks();
    $this->api = new \SCFRDiscord\api\WP();
    $this->api = new \SCFRDiscord\api\FrontEnd();
  }

  private function register_hooks() {
    add_filter( 'page_template', array(&$this, "custom_login_page") );
    add_filter( 'init', array(&$this, "add_pages") );
    add_filter( 'init', array(&$this, "redirect_html5"));
  }

  public function custom_login_page( $page_template ) {
    if ( is_page( 'discord' ) ) {
        $page_template = dirname( __FILE__ ) . '/../page/Discord.php';
    }
    return $page_template;
  }

  public function redirect_html5() {
    $url = $_SERVER["REQUEST_URI"];

     $discord_page = \get_page_by_title('discord')->ID;
     add_rewrite_rule( '^Discord\/(.*)?', "index.php?page_id={$discord_page}", 'top' );
    //if(strpos($url, "/Discord/") === 0)
  }

  public function add_pages() {
    if(\get_page_by_title('discord') == NULL) {
      $createPage = array(
        'post_title'    => "Discord",
        'post_slig'     => "discord",
        'post_status'   => 'publish',
        'post_author'   => 2,
        'post_type'     => 'page',
        'post_name'     => "discord"
      );

      \wp_insert_post( $createPage );
    }
  }
}
?>
