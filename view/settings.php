<!DOCTYPE html>
<html lang="en" ng-app="settings">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>General Manager - Settings</title>
		<link href="[@CSS_DIR]/bootstrap.css" rel="stylesheet" />
		<link href="[@CSS_DIR]/dashboard.css" rel="stylesheet" />
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style type="text/css">
			.well {
				padding-top:0px;
				margin-bottom:3em;
			}

			.small-margin-top {
				margin-top:20px;
			}
		</style>
	</head>
	<body ng-controller="bodyController">
		[@NAV]

		<div class="container-fluid">
			<div class="row">
				[@SIDEBAR]
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<div class="row">
						<div class="col-md-6">
							<h1 class="page-header">Settings</h1>
							<h2>Profile</h2>
							<div class="well">
								<h3>Change Name <small>Current: {{userSettings.name}}</small></h3>
								<input type="text" class="form-control" placeholder="John Smith" ng-model="inputName" />

								<h3>Change Email <small>Current: {{userSettings.email}}	</small></h3>
								<input type="email" class="form-control" placeholder="jsmith@gmail.com" ng-model="inputEmail" />

								<h3>Change Password</h3>
								<input type="password" class="form-control" placeholder="hunter2" ng-model="inputPassword" />

								<div class="row small-margin-top">
									<div class="col-md-6">
										<span ng-model="userSettingsMessage"></span>
									</div>
									<div class="col-md-6">
										<button ng-click="saveUserSettings()" class="pull-right btn btn-default">Save Profile Information</button>
									</div>
								</div>
							</div>

							<h2>Team Settings</h2>
							<div class="well">
								<h3>Switch Active Teams</h3>
								<div class="dropdown">
									<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
										Select Team
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
										<li role="presentation" ng-repeat="team in teamSettings.teams"><a role="menuitem" tabindex="-1" href="" ng-click="switchActiveTeams(team.id)">{{team.name}}</a></li>
									</ul>
									<button class="btn btn-default" type="button" data-toggle="modal" data-target="#myModal">Add New Team</button>
								</div>

								<h3>Number of Innings per Game <small><em>In Progress/Non-functional</em></small></h3>
								<p>This is used in the calculation of BB/9, K/9, et al. in place of 9.</p>
								<input type="number" min="1" max="9" placeholder="9" class="form-control" />

								<h3>Make Team Public <small><em>In Progress/Non-functional</em></small></h3>
								<div class="row">
									<div class="col-md-2">
										<input type="checkbox" value="true" class="form-control" />
									</div>
									<div class="col-md-10">
										<p>This will make all of your team's information publicly available at its own <a href="#" target="_blank">team webpage.</a> This allows players and fans to track your team's progress.</p>
									</div>
								</div>
								<div class="row small-margin-top">
									<div class="col-md-6">
										<p class="text-success" ng-bind="teamSettingsMessage"></p>
									</div>
									<div class="col-md-6">
										<button class="pull-right btn btn-default">Save Team Settings</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add New Team</h4>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group">
								<label for="teamName">Team Name</label>
								<input type="text" class="form-control" id="teamName" placeholder="St. Louis Brown Stockings" ng-model="teamName" />
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" ng-click="addTeam()" data-dismiss="modal">Add Team</button>
					</div>
				</div>
			</div>
		</div>

		[@JS_ACTIVE]
		<script src="[@CSS_DIR]/jquery-latest.min.js"></script>
		<script src="[@CSS_DIR]/bootstrap.min.js"></script>
		<script src="[@CSS_DIR]/angular.min.js"></script>
		<script type="text/javascript">
			angular.module('settings', []);
			angular.module('settings').controller('bodyController', function($scope, $http, $window) {
				$scope.userSettings = [@js_user_settings];

				$scope.saveUserSettings = function() {
					console.log($scope.inputName, $scope.inputEmail, $scope.inputPassword);
					var name = {
						key: "name",
						value: $scope.inputName
					};
					console.log(name);
					var email = {
						key: "email",
						value: $scope.inputEmail
					};
					var password = {
						key: "password",
						value: $scope.inputPassword
					};
					if (name.value != undefined) {
						$http.post('[@WWW_SITE]api/user_settings.php', name)
						.then(function() {
							$scope.userSettings.name = name.value;
						});
					}
					if (email.value != undefined) {
						$http.post('[@WWW_SITE]api/user_settings.php', email)
						.then(function() {
							$scope.userSettings.email = email.value;
						});
					}
					if (password.value != undefined) {
						$http.post('[@WWW_SITE]api/user_settings.php', password);
					}

					$scope.userSettingsMessage = "Profile information saved!";

				};

				$scope.teamSettings = [@js_team_settings];
				console.log($scope.teamSettings);
				$scope.switchActiveTeams = function(teamId) {
					$http.post('[@WWW_SITE]api/switch_teams.php', teamId)
					.then(function() {
						$scope.teamSettingsMessage = "Switched active team.";
					});
				};


				$scope.addTeam = function() {
					var obj = {
						name: $scope.teamName
					};
					console.log($scope.teamName);
					$http.post('[@WWW_SITE]api/add_team.php', obj).
					then(function() {
						$window.location.reload();
					});
				};
			});
		</script>
	</body>
</html>
