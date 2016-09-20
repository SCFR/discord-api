app.controller("DiscordUserCard", ["$scope", "$state", "discord.service.user", "$stateParams", function($scope, $state, user, $stateParams) {
  $scope.user = user;


  $scope.status = function() {
    if(user.userStatus === "USER_OKAY") return "Votre compte discord est connecté à votre compte SC.FR. Vous pouvez profiter pleinement de nos services et plugins.";
    else if($stateParams.code) return "Traitement en cours...";
    else if(user.userStatus === "USER_NO_TOKEN") return "Clickez sur le bouton discord pour connecter votre compte Discord à SC.FR";
    return "Veuillez vous connectez.";
  };

  $scope.getDiscordCode = function() {
    document.location.href = DISCORD_API_URL+"Connect";
  };

  handleCode = function() {
    $scope.busy = true;
    user.authorizeCode($stateParams.code).then(function(ok) {
      if(ok) {
        $stateParams.code = false;
        $scope.busy = false;
      }
    });
  };

  if($stateParams.code) handleCode();

}]);
