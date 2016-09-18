require("./routes.js");

app.config(["$stateProvider", "$locationProvider", function($stateProvider, $locationProvider) {
  $('a').each(function(){
    $a = $(this);
    if ($a.is('[target]') || $a.is('[ng-href]')){
    } else {
      $a.attr('target', '_self');
    }
  });
  
  $locationProvider.html5Mode(true);
}]);
