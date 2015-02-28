<!DOCTYPE html>
<html lang="en" ng-app="splash">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>General Manager - Free Big League Stats</title>

		<link href="[@CSS_DIR]/cosmo.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="[@CSS_DIR]/splash.css" />

		<style type="text/css">
			.row {
				margin-top:30px;
			}
		</style>

		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body ng-controller="bodyController">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="./">General Manager</a>
					<a href="login.php" class="btn btn-default navbar-btn navbar-right">Sign in</a>
				</div>
			</div>
		</nav>
		<div class="container">
			<h1>About This Site</h1>
			<p>This page is for people who are interested in the software behind the site.</p>
			<p>This website was written entirely by me, <a href="http://cms07.org">Cody Crow</a>. I have looked and looked for something that provided this functionality, and when I couldn't find anything that was compatible with a paper scorebook, I wrote my own.</p>
			<div class="row">
				<div class="col-md-2">
					<img class="img-responsive center-block" src="[@WWW_SITE]images/logos/php.png" alt="PHP logo" />
				</div>
				<div class="col-md-10">
					<p>The vast majority of this website is written in PHP, specifically version 5.5. PHP has taken a lot of heat recently, but most of the common concerns are issues of the past, and PHP is still a very capable language used in many of the largest websites. I personally prefer Perl.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<img class="img-responsive" src="[@WWW_SITE]images/logos/angular.png" alt="AngularJS logo" />
				</div>
				<div class="col-md-10">
					<p>Some of this website's functionality, particularly the workspace, uses AngularJS. AngularJS is a JavaScript library/framework for the front end. Some people build entire applications using it, but I prefer not to.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<img class="img-responsive" src="[@WWW_SITE]images/logos/jquery.png" alt="jQuery logo" />
				</div>
				<div class="col-md-10">
					<p>jQuery is another javascript library that is used for part of the website.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<img class="img-responsive" src="[@WWW_SITE]images/logos/mariadb.png" alt="MariaDB logo" />
				</div>
				<div class="col-md-10">
					<p>The database software used for this website is MariaDB, a fork of MySQL. It could have just as easily been Postgres, which has more features, but MariaDB is faster.</p>
				</div>
			</div>

		</div>
		<footer>
			<ul>
				<li><a href="[@WWW_SITE]about.php">About</a></li>
				<li>·</li>
				<li><a href="http://twitter.com/CodyWins">Twitter</a></li>
				<li>·</li>
				<li><a href="[@WWW_SITE]terms.php">Terms of Service</a></li>
				<li>·</li>
				<li><a href="[@WWW_SITE]privacy.php">Privacy Policy</a></li>
			</ul>
			<p class="text-muted">Currently Version [@VERSION]</p>
		</footer>
		<script src="[@CSS_DIR]/jquery-latest.min.js"></script>
		<script src="[@CSS_DIR]/bootstrap.min.js"></script>
	</body>
</html>
