<!DOCTYPE html>
<html lang="en" ng-app="index">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>General Manager - Overview</title>
		<link href="[@CSS_DIR]/bootstrap.css" rel="stylesheet" />
		<link href="[@CSS_DIR]/dashboard.css" rel="stylesheet" />
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="[@CSS_DIR]/sorttable.js"></script>
	</head>
	<body>
		[@NAV]

		<div class="container-fluid">
			<div class="row">
				[@SIDEBAR]
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<h1 class="page-header">Team Overview <small>[@team_name] &mdash; Pythagorean Win Percentage: [@pythag] </small></h1>
					<h3>Position Players <button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="badge"> + </span> Add Player</button></h3>
					<table class="table sortable">
						[@position_player]
					</table>
					<h3>Pitchers</h3>
					<table class="table sortable">
						[@pitchers]
					</table>
				</div>
			</div>
		</div>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="playerController">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add Position Player</h4>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group">
								<label for="playerName">Name</label>
								<input ng-model="playerName" type="text" class="form-control" id="playerName" placeholder="Shoeless Joe Jackson" />
							</div>
							<div class="form-group">
								<label for="playerNumber">Number</label>
								<input ng-model="playerNumber" type="number" class="form-control" id="playerNumber" placeholder="8" min="0" max="99" />
							</div>
							<div class="form-group">
								<label for="isPitcherInput">Pitcher:</label>
								<input ng-model="isPitcher" type="checkbox" id="isPitcherInput" value="1" />
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" ng-click="addPlayer()" data-dismiss="modal">Save changes</button>
					</div>
				</div>
			</div>
		</div>


		<!-- Add in active class to appropriate sidebar link -->
		[@JS_ACTIVE]
		<script src="[@CSS_DIR]/jquery-latest.min.js"></script>
		<script src="[@CSS_DIR]/bootstrap.min.js"></script>
		<script src="[@CSS_DIR]/angular.min.js"></script>
		<script src="[@CSS_DIR]/angular-route.min.js"></script>
		<script type="text/javascript">
			angular.module('index', []);
			angular.module('index').controller('playerController', function($scope, $http, $window) {
				$scope.playerName = "";
				$scope.playerNumber = "";
				$scope.isPitcher = 0;

				$scope.addPlayer = function() {
					var player = {
						name: $scope.playerName,
						number: $scope.playerNumber,
						is_pitcher: $scope.isPitcher
					};
					$http.post('[@WWW_SITE]api/add_player.php', player).
					then(function(res) {
						$scope.playerName = "";
						$scope.playerNumber = "";
						$window.location.href = "[@WWW_SITE]";
					});
				};

			});
		</script>
	</body>
</html>
