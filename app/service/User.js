app.service("discord.service.user", ["$http", "$q",  function($http, $q) {
  var service = {
    userStatus: "USER_NOT_LOGGED_IN",
  };

  if (typeof location.origin === 'undefined') location.origin = location.protocol + '//' + location.host;
  var BASE_URL = location.origin + "/wp-json/Discord/";

  console.log(BASE_URL);

  service.getUserStatus = function() {
    var p = $http.get(BASE_URL+"OAuthStatus").then(function(data) {
      service.userStatus = data.data;
      return service.userStatus;
    });

    return p;
  };



  return service;
}]);
