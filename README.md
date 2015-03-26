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

1. PDO instances are all over the place. Rather than do the extra work to have only one instance of PDO, I've decided to instantiate it wherever it was useful. Frankly, there is no good way to do it, and using a bash script on deployment to replace them with the appropriate MariaDB credentials is easier and better than other ways I've seen.
2. I wrote this with the opinion that single page applications are a bit silly. I don't care for them, and as a result the use of AngularJS in this application is not always (or ever) in line with standard usage. 
3. All necessary class files are included in the manager.php file, which must be included in every application page. The reason behind this is that auto-loading is still slower than all of those require statements, and so it just doesn't make switch to transition to that yet, as far as I can tell.
4. The necessary SQL dump is at classes/manager.sql. You probably will need to disable foreign key checking.
