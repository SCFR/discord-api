app.config(["$stateProvider", "$locationProvider", function($stateProvider, $locationProvider) {

  var LOCAL_PATH = HUBPATH+"../../../plugins/SCFR-Discord/app/template/";

  //$locationProvider.html5Mode(true);

  $stateProvider.state('Discord', {
    url: '/Discord/',
    templateUrl: LOCAL_PATH+"/main.html",
    controller: "DiscordMain",
  });

  $stateProvider.state('Discord.bn', {
    url: 'bn',
    templateUrl: LOCAL_PATH+"/main.html",
    controller: "DiscordMain",
  });

  $stateProvider.state('Discord.authorize', {
    url: 'Authorize/?code',
    templateUrl: LOCAL_PATH+"/main.html",
    controller: "DiscordAuthorize",
  });

}]);
