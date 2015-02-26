<!DOCTYPE html>
<html lang="en" ng-app="splash">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>General Manager - Free Big League Stats</title>

		<link href="[@CSS_DIR]/cosmo.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="[@CSS_DIR]/splash.css" />

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
			<div class="jumbotron">
				<h1>General Manager</h1>
				<p>General Manager is a sane, <strong>free</strong> way to manage your baseball team's statistics.</p>
				<p>
					<a class="btn btn-primary btn-lg" href="[@WWW_SITE]register.php" role="button">Sign Up</a>
				</p>
			</div>
			<div class="row">
				<div class="lead col-md-6">
					<h2 class="h1">Say Hello to Simplicity</h2>
					<p>No more iPad apps. No more touchscreens. The only thing a baseball team should have to worry about during a game is <strong>baseball.</strong></p>
				</div>
				<div class="col-md-6">
					<div class="carousel slide" id="carousel" data-ride="carousel">
						<ol class="carousel-indicators">
							<li ng-repeat="image in images" data-target="#carousel" data-slide-to="{{image.id}}" ng-class="{active: image.active}"></li>
						</ol>
						<div class="carousel-inner" role="listbox">
							<div class="item" ng-class="{active: image.active}" ng-repeat="image in images">
								<img src="[@WWW_SITE]images/screenshots/{{image.src}}" alt="{{image.alt}}" />
							</div>
						</div>
						<a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<h2>Big League Stats</h2>
					<p>Get the latest in baseball statistical analysis. General Manager provides advanced statistics and sabermetrics so you can keep your team on par with the big leagues.</p>
					<p>Immediately at your fingertips will be Base Runs, Runs Created, Isolated Power, Secondary Average, Fielding Independent Pitching, and others.</p>
				</div>
				<div class="col-md-4">
					<h2>Team Management Tools</h2>
					<p>Look no further for easy to use, straightforward team management tools. General Manager compiles your team's statistics and analyzes performance, helping you to plan for future games.</p>
					<p>Our no-gimmick lineup workspace allows you to create, view and edit potential lineups, while our Next Game feature shows you generated lineups and pitching rotations from the best modern techniques.</p>
				</div>
				<div class="col-md-4">
					<h2>Pure Baseball</h2>
					<p>Technology is great most of the time, but in our opinion it has no place on the diamond. All any team should need is a bat, a glove, and a love for the game. We hope you agree.</p>
					<a class="btn btn-primary btn-lg pull-right" href="[@WWW_SITE]register.php" role="button">Sign Up</a>
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
		<script src="[@CSS_DIR]/angular.min.js"></script>
		<script type="text/javascript">
			angular.module('splash', []);
			angular.module('splash').controller('bodyController', function($scope) {
				$scope.images = [
					{
						id: 0,
						src: "pitching.png",
						alt: "Screenshot of the pitching stats interface",
						active: true
					},
					{
						id: 1,
						src: "workspace.png",
						alt: "Screenshot of the lineup workspace feature"
					},
					{
						id: 2,
						src: "add_game.png",
						alt: "Screenshot of the game adding interface"
					},
					{
						id: 3,
						src: "offense.png",
						alt: "Screenshot of the offensive stats interface"
					}
				];
				console.log($scope.images);
			});

		</script>
		<script src="[@CSS_DIR]/jquery-latest.min.js"></script>
		<script src="[@CSS_DIR]/bootstrap.min.js"></script>
	</body>
</html>
