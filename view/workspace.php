<!DOCTYPE html>
<html lang="en">
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
		<script type="text/javascript">
			var lineups = [@js_data];
			for (var i = 0; i < lineups.length; i++) {
				console.log(lineups[i].name);
				//TODO
			}

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
		
		});
		</script>
	</head>
	<body>
		[@NAV]

		<div class="container-fluid">
			<div class="row">
				[@SIDEBAR]
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<h1 class="page-header">General Manager Workspace <small>[@team_name]</small></h1>
					<div class="row">
						<div class="col-md-4">Text
						</div>
						<div class="col-md-4">
						</div>
						<div class="col-md-4">
							<div class="list-group">
							[@lineup_list]
							</div>
						</div>
					</div>
				</div>

				</div>
			</div>
		</div>
		<!-- Add in active class to appropriate sidebar link -->
		[@JS_ACTIVE]
	</body>
</html>
