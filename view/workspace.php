<!DOCTYPE html>
<html lang="en" ng-app="baseball">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>General Manager - Workspace</title>
		<link href="[@CSS_DIR]/bootstrap.css" rel="stylesheet" />
		<link href="[@CSS_DIR]/dashboard.css" rel="stylesheet" />
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="[@CSS_DIR]/sorttable.js"></script>
		<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.13/angular.min.js"></script>
		<!--script type="text/javascript">
			var lineups = [@js_data];
			for (var i = 0; i < lineups.length; i++) {
				console.log(lineups[i].name);
				//TODO
			}
		</script>
		<script src="[@CSS_DIR]/workspace.js"></script-->
	</head>
	<body ng-controller="bodyController">
		[@NAV]

		<div class="container-fluid">
			<div class="row">
				[@SIDEBAR]
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<h1 class="page-header">General Manager Workspace <small>[@team_name]</small></h1>
					<div class="row">
						<div class="col-md-4">
							<h2 id="lineup-header">Current Lineup <small>{{workingLineup.name}}</small></h2>
							<ol class="list-group" ng-show="lineup_exists"> 
								<li class="list-group-item">Player <span class="badge">&#8470;</span></li>
								<li class="list-group-item" ng-repeat="player in workingLineup.order" ng-drag="true" ng-drag-data="player" ng-drop="true" ng-drop-success="onDropComplete($index, $data, $event)" style="cursor:move;"> <strong>{{$index + 1}}.</strong> {{player.name}} <span class="badge">#{{player.number}}</span></li>
							</ol>
							<button class="btn btn-primary">Save Lineup</button>
						</div>
						<div class="col-md-4">
							<h2 id="players-header">Players</h2>
							<ul class="list-group">
								<li class="list-group-item" ng-repeat="player in players" ng-drag="true" ng-drag-data="player" ng-drag-success="playerListDrag(player)" style="cursor:move;">{{player.name}} <span class="badge">{{player.avg}}</span></li>
							</ul>
						</div>
						<div class="col-md-4">
							<h2 id="lineups-header">Lineups</h2>
							<div class="list-group">
								<a href="#" id="lineup-{{lineup.id}}" class="list-group-item" ng-repeat="lineup in lineups" ng-click="switchLineup(lineup.id)">{{lineup.name}}</a>
								<a href="#" id="new-lineup" class="list-group-item">New Lineup...</a>
						
							</div>
						</div>
					</div>
				</div>

				</div>
			</div>
		</div>
		<!-- Add in active class to appropriate sidebar link -->
		[@JS_ACTIVE]
		<script src="[@CSS_DIR]/ngDraggable.js"></script>
		<script type="text/javascript">
			angular.module('baseball', ['ngDraggable']);

			angular.module('baseball').controller('bodyController', function($scope) {
				$scope.lineups = [@js_data];

				$scope.players = [@js_player_data];

				$scope.workingLineup = $scope.lineups[0];

				$scope.switchLineup = function(lineupId) {
					$scope.workingLineup = $scope.lineups[lineupId - 1];

				};

				if ($scope.lineups[0]) $scope.lineup_exists = 1;

				$scope.onDropComplete = function(index, obj, evt) {
					//if ($scope.workingLineup.order.indexOf(obj) !== -1) return;
					if ($scope.preventDrag) {
						$scope.preventDrag = false;
						return;
					}
					var playerIds = $scope.workingLineup.order.map(function(obj) {
						return +obj.id;
					});
					$scope.workingLineup.order[index] = obj;
				};

				$scope.playerListDrag = function(player) {
					var playerIds = $scope.workingLineup.order.map(function(obj) {
						return +obj.id;
					});
					if (playerIds.indexOf(+player.id) != -1) $scope.preventDrag = true;
				};
			});
		</script>
	</body>
</html>
