app.controller("DiscordMain", ["$scope", "$state", function($scope, $state) {
  console.log($state.params);

  $scope.appURL = DISCORD_APP_URL;
  //ngMaterial
}]);
