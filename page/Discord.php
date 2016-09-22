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
  <main class="row-fluid" id="content" role="main" ui-view></main>


  <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
  <?php  get_footer(); ?>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular-animate.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular-aria.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular-messages.min.js"></script>

  <!-- Angular Material Library -->
  <script src="//ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
  <script src="<?php echo plugins_url("/SCFR-Discord/js/StarCitizenFR.discord.js"); ?>"></script>
  <?php  } ?>
