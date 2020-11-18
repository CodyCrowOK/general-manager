# [General Manager](http://generalmanagerstats.com) 

General Manager is a baseball statistics and team management web application written written primarily in PHP.

Easily keep track of pitchers' and position players' performances over time. General Manager was created to provide amateur teams with the ability to keep track of statistics and sabermetrics without having to abandon the paper scorebook in favor of a closed source, proprietary iPad app.

It provides the following features:

* Keep track of game results/stats
* Show basic stats and advanced metrics of position players over a season
* Show basic stats and advanced metrics of pitchers over a season
* Generate potential lineups based on an algorithmic approach
* Create and keep track of user-generated lineups on a team-by-team basis
* Tailor metrics to each team's game length, e.g. 7 innings for a high school team (on metrics which are per game)

## Design Concerns
This website was written in PHP with MariaDB, using AngularJS and jQuery whenever they were useful.

1. The necessary SQL dump is at classes/manager.sql. You probably will need to disable foreign key checking.
2. This was originally built several years ago (at the time of writing), so the architectural choices are not always great. That said, there's no point in rewriting it now.
