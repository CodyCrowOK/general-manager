$(document).ready(function() {
	for (var i = 0; i < lineups.length; i++) {
		$("#new-lineup").before(function() {
			var ret = '<a href="#" id="lineup-';
			ret = ret + lineups[i].id;
			ret = ret + '" class="list-group-item">';
			ret = ret + lineups[i].name;
			ret = ret + '</a>';
			return ret;			
		});
	}
	if (lineups.length > 0) {
		$("#lineup-header").after(function() {
			var ret = '<ol class="list-group">';
			for (var j = 0; i < lineups[0].order.length; j++) {
				ret += lineups[0].order[0].name;
			}
			ret += '</ol>';
			return ret;
		});
	}		
});

