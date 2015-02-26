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
								<li class="list-group-item" ng-drop="true" ng-drop-success="onDropComplete(-2, $data, $event)">Player <span class="badge">&#8470;</span></li>
								<li class="list-group-item" ng-repeat="player in workingLineup.order" ng-drag="true" ng-drag-data="player" ng-drag-success="noPrevent()" ng-drop="true" ng-drop-success="onDropComplete($index, $data, $event)" style="cursor:move;"> <strong>{{$index + 1}}.</strong> {{player.name}} <span class="badge">#{{player.number}}</span></li>
							</ol>
							<input type="hidden" value="{{lineups}}" name="json" />	
							<button class="btn btn-primary" id="save-button" ng-click="saveLineups()">Save Lineups</button> 
							<button class="btn btn-default" id="delete-button" ng-click="deleteLineup()"><span class="glyphicon glyphicon-remove"></span> <strong>Delete Current Lineup</strong></button>
<span class="text-danger">{{message}}</span>
						</div>
						<div class="col-md-4">
							<h2 id="players-header">Players</h2>
							<ul class="list-group">
								<li class="list-group-item">Player <span class="badge">AVG</span></li>
								<li class="list-group-item" ng-repeat="player in players | orderBy:'avg':true" ng-drag="true" ng-drag-data="player" ng-drag-success="playerListDrag(player)" style="cursor:move;">{{player.name}} <span class="badge">{{player.avg}}</span></li>
							</ul>
						</div>
						<div class="col-md-4">
							<h2 id="lineups-header">Lineups</h2>
							<div class="list-group">
								<a href="" id="lineup-{{lineup.id}}" class="list-group-item" ng-repeat="lineup in lineups" ng-click="switchLineup(lineup.id)">{{lineup.name}}</a>
								<a href="#" id="new-lineup" ng-click="newLineup()" class="list-group-item">New Lineup...</a>
						
							</div>
						</div>
					</div>
				</div>

				</div>
			</div>
		</div>
		<!-- Add in active class to appropriate sidebar link -->
		<script src="[@CSS_DIR]/sorttable.js"></script>
		<script src="[@CSS_DIR]/jquery-latest.min.js"></script>
		<script src="[@CSS_DIR]/angular.min.js"></script>
		[@JS_ACTIVE]
		<script src="[@CSS_DIR]/ngDraggable.js"></script>
		<script type="text/javascript">
			angular.module('baseball', ['ngDraggable']);

			angular.module('baseball').controller('bodyController', function($scope, $http) {
				$scope.lineups = [@js_data];
				console.log($scope.lineups);

				$scope.players = [@js_player_data];

				$scope.workingLineup = $scope.lineups[0];

				$scope.switchLineup = function(lineupId) {
				//	$scope.workingLineup = $scope.lineups[lineupId - 1];
					var lineupIds = $scope.lineups.map(function(obj) {
						return obj.id;
					});
					
					$scope.workingLineup = $scope.lineups[lineupIds.indexOf(lineupId)];

				};

				if ($scope.lineups[0]) $scope.lineup_exists = 1;

				$scope.onDropComplete = function(index, obj, evt) {
					if (index === -2) index = 0;
					if ($scope.preventDrag) {
						$scope.preventDrag = false;
						$scope.message = "You've already inserted that player.";
						return;
					}
					$scope.message = "";
					var playerIds = $scope.workingLineup.order.map(function(obj) {
						return +obj.id;
					});

					if (playerIds.indexOf(obj.id) != -1) {
						$scope.workingLineup.order[playerIds.indexOf(obj.id)] = $scope.workingLineup.order[index];
					}

					$scope.workingLineup.order[index] = obj;
				};

				$scope.playerListDrag = function(player) {
					var playerIds = $scope.workingLineup.order.map(function(obj) {
						return +obj.id;
					});
					if (playerIds.indexOf(+player.id) != -1) $scope.preventDrag = true;
				};

				$scope.noPrevent = function() {
					return;
				};

				$scope.newLineup = function() {
					var newLineup = {};
					newLineup.id = -1;
					newLineup.name = prompt("New lineup name:");
					newLineup.order = [];
					for (var i = 0; i < 9; i++) {
						newLineup.order.push({id: 0});
					}
					newLineup.db = {};
					


					$scope.lineups.push(newLineup);
					$scope.switchLineup($scope.lineups[$scope.lineups.length - 1].id);
				};

				$scope.saveLineups = function() {
					$http.post('[@WWW_SITE]api/workspace.php', $scope.lineups)
					.success(function(data, status, headers, config) {
						$scope.message = 'Lineups saved!';	
					})
					.error(function(data, status, headers, config) {
						$scope.message = 'Lineups saved!';
					});
				};

				$scope.deleteLineup = function() {
					$http.post('[@WWW_SITE]api/delete_lineup.php', $scope.workingLineup.id)
					.success(function(data, status, headers, config) {
						$scope.message = 'Lineup deleted.';

						for (var i = $scope.lineups.length - 1; i >= 0; i--) {
							if ($scope.lineups[i] == $scope.workingLineup) {
								$scope.lineups.splice(i, 1);
								break;
							}
						}
						$scope.workingLineup = $scope.lineups[0];

					});
				};
			});
		</script>
	</body>
</html>
