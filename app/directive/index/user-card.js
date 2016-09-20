app.directive("discordMainUserCard", function() {
  return {
    templateUrl: DISCORD_APP_URL+"template/common/user-card.html",
    restrict:'E',
    controller:'DiscordUserCard',
    replace: true,
  };
});
