angular.module('baseball', ['ngDraggable']);

			angular.module('baseball').controller('bodyController', function($scope, $http) {
				$scope.lineups = [@js_data];

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
			});