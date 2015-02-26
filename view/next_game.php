<!DOCTYPE html>
<html lang="en" ng-app="next-game">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>General Manager - Next Game</title>
		<link href="[@CSS_DIR]/bootstrap.css" rel="stylesheet" />
		<link href="[@CSS_DIR]/dashboard.css" rel="stylesheet" />
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="[@CSS_DIR]/sorttable.js"></script>
	</head>
	<body ng-controller="bodyController">
		[@NAV]

		<div class="container-fluid">
			<div class="row">
				[@SIDEBAR]
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<h1 class="page-header">Next Game <small>[@team_name]</small></h1>
					<div class="row">
						<h2>Offensive Analysis</h2>	
						<div class="col-md-7">
							<div class="col-md-6">
								<h3>Traditional Lineup</h3>
								<ol class="list-group">
									<li class="list-group-item">Player <span class="badge">AVG</span></li> 
									[@simple_lineup]
								</ol>
								<button class="pull-right btn btn-default" ng-click="useLineup()">Use Traditional Lineup</button>
							</div>
							<div class="col-md-6">
								<h3>Tango Lineup</h3>
								<ol class="list-group">
									<li class="list-group-item">Player <span class="badge">AVG</span></li>
									[@tango_lineup]
								</ol>
								<button class="pull-right btn btn-default" ng-click="useTangoLineup()">Use Tango Lineup</button>
							</div>
						</div>
						<div class="col-md-5">
							<h3>Lineup Generation Methods</h3>
							<div class="col-md-12 panel panel-default">
								<h3>Traditional Lineup</h3>
								<div class="panel-body">The traditional lineup computes the best possible lineup based on traditional batting orders. Specifically, it seeks to place the best all-around hitter in the third position, the best power hitter in the cleanup spot, the two hitters with the best on-base percentage in the first and second positions, and the next five batters in the remaining spots in order.</div>
							
								<h3>Tango Lineup</h3>
								<div class="panel-body">
								<p>The Tango lineup is based off of principles stated in <a href="http://www.insidethebook.com"><em>The Book</em></a>, which states that, generally, one should place their best batters in the fourth, first, and second positions in the order, with fifth and third containing the next best two, and the next four in the sixth, seventh, eighth, and ninth positions.</p>
								<p>The Tango lineup uses wOBA, weighted on-base average, as the measure of a player's total offensive output.</p>
								<p><em>Note: These methods are not endorsed by anyone, including Tom Tango, and these suggestions should be used with the consideration that small samples of data can make these suggestions unreliable.</em></p>
								</div>
							</div>
						</div>
					</div>
				<div class="row">
					<h2>Pitching Analysis</h2>
					<div class="col-md-7">
						<div class="col-md-6">
							<h3>WHIP Rotation</h3>
								<ol class="list-group">
									<li class="list-group-item">Pitcher <span class="badge">ERA</span></li>
									[@whip_rotation]
								</ol>

						</div>
						<div class="col-md-6">
							<h3>FIP Rotation</h3>
								<ol class="list-group">
									<li class="list-group-item">Pitcher <span class="badge">ERA</span></li>
									[@fip_rotation]
								</ol>

						</div>
					</div>
						<div class="col-md-5">
							<h3>Pitching Rotation Generation Methods</h3>
							<div class="col-md-12 panel panel-default">
								<h3>WHIP Rotation</h3>
								<div class="panel-body">The WHIP Rotation values pitchers purely by their WHIP (Walks plus Hits per Inning Pitched). WHIP has the advantages of being easy to understand and well respected. It has been said that WHIP is one of the few sabermetric measurements accepted by the general public, for better or worse.</div>
							
								<h3>FIP Rotation</h3>
								<div class="panel-body">
								<p>The FIP rotation is calculated using FIP (Fielding Independent Pitching), a sabermetric measure originally conceived by Tom Tango in <a href="http://www.insidethebook.com"><em>The Book</em></a>. FIP is derived from homeruns allowed, walks, strikeouts, and innings pitched, and intends to be a fielding independent metric. The formula used for calculating FIP is usually on a similar scale to ERA, and in our formula, 3.1 is considered average.</p>
								<p><em>Note: These methods are not endorsed by anyone, including Tom Tango, and these suggestions should be used with the consideration that small samples of data can make these suggestions unreliable.</em></p>
								</div>
							</div>
						</div>
					
					</div>
				</div>

				</div>
			</div>
		</div>
		<!-- Add in active class to appropriate sidebar link -->
		[@JS_ACTIVE]
		<script src="[@CSS_DIR]/angular.min.js"></script>
		<script type="text/javascript">
			angular.module('next-game', []);

			angular.module('next-game').controller('bodyController', function($scope, $window, $http) {
				$scope.lineup = [@js_lineup];
				$scope.tangoLineup = [@js_tango_lineup];
				$scope.whipRotation = [@js_whip_rotation];
				$scope.fipRotation = [@js_fip_rotation];

				$scope.useLineup = function() {
					var orderArray = [];
					angular.forEach($scope.lineup, function(element) {
						orderArray.push(element);
					});
					var lineup = {
						name: "Traditional Lineup",
						id: -1,
						order: orderArray
					};
					$http.post('[@WWW_SITE]api/workspace.php', [lineup])
					.success(function() {
						$window.location.href = 'workspace.php';
					});
				}

				$scope.useTangoLineup = function() {
					var orderArray = [];
					angular.forEach($scope.tangoLineup, function(element) {
						orderArray.push(element);
					});
					var lineup = {
						name: "Tango Lineup",
						id: -1,
						order: orderArray
					};
					$http.post('[@WWW_SITE]api/workspace.php', [lineup])
					.success(function() {
						$window.location.href = 'workspace.php';
					});
				}


			});
		</script>
	</body>
</html>
