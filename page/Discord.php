<?php //$index = SCFR\GameFeatures\helper\Index::get_main_infos();
if(get_query_var( 'callback', false ) == "json") {
  header('Content-Type: application/json');
  print_r(json_encode($index));
}
else {
  get_header();  ?>
  <script>
  // To prevent double call, give JSON directly.
  //var CURRENT_INDEX = <?php print_r(json_encode($index)); ?>;
  </script>

  <base href="/">
  <main class="row-fluid" id="content" role="main" ng-controller="DiscordMain" ui-view></main>



  <?php  get_footer(); ?>
  <script src="<?php echo plugins_url("/SCFR-Discord/js/StarCitizenFR.discord.js"); ?>"></script>
  <?php  } ?>
