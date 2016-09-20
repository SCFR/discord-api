app.config(["$stateProvider", "$locationProvider", "$urlRouterProvider", function($stateProvider, $locationProvider, $urlRouterProvider) {

  var LOCAL_PATH = HUBPATH+"../../../plugins/SCFR-Discord/app/template/";

  //$locationProvider.html5Mode(true);


  $stateProvider.state('Discord', {
    url:'',
    abstract:true,
    controller: "DiscordMain",
    templateUrl: LOCAL_PATH+"/main.html",
  });

  $stateProvider.state('Discord.index', {
    url: '/Discord/',
    templateUrl: LOCAL_PATH+"/accueil.html",
  });

  $stateProvider.state('Discord.authorize', {
    url: '/Discord/Authorize/?code',
    templateUrl: LOCAL_PATH+"/authorize.html",
    controller: "DiscordAuthorize",
  });

  $urlRouterProvider.otherwise('/Discord/');
}]);
