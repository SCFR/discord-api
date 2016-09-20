app.service("discord.service.user", ["$http", "$q",  function($http, $q) {
  var service = {
    userStatus: "USER_NOT_LOGGED_IN",
    discord: false,
  };

  service.getUserData = function() {
    var p = $http.get(DISCORD_API_URL+"RefreshDiscord").then(function(data) {
      service.discord = data.data;

      return service.user;
    });

    return p;
  };

  service.getUserStatus = function() {
    var p = $http.get(DISCORD_API_URL+"OAuthStatus").then(function(data) {
      service.userStatus = data.data;
      if(service.userStatus === "USER_OKAY") service.getUserData();
      return service.userStatus;
    });

    return p;
  };

  service.authorizeCode = function(code) {
    var p = $http.get(DISCORD_API_URL+"Authorize", {params: {code: code}}).then(function(data) {
      if(data.data.id) {
        service.discord = data.data;
        service.userStatus = "USER_OKAY";
        return true;
      }
      return false;
    });

    return p;
  };

  init = function() {
    service.getUserStatus();
  };

  init();


  return service;
}]);
