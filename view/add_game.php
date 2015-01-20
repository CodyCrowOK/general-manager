<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>General Manager - Recent Games</title>
		<link href="[@CSS_DIR]/bootstrap.css" rel="stylesheet" />
		<link href="[@CSS_DIR]/dashboard.css" rel="stylesheet" />
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		[@NAV]

		<div class="container-fluid">
			<div class="row">
				[@SIDEBAR]
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<h1 class="page-header">Add Game <small>[@team_name]</small></h1>
					<form action="[@WWW_SITE]add_game.php" method="GET">
						<h3>Game Information</h3>
						<div class="form-group">
							<label for="date">Date:</label>
							<input id="date" class="form-control" name="date" type="date" />
						</div>
						<div class="form-group">
							<label for="opponent">Opponent:</label>
							<input id="opponent" class="form-control" name="opponent" type="text" placeholder="Bedrock Boulders" />
						</div>
						<div class="form-group">
							<label for="result">
							<input id="result" class="form-control" name="result" type="checkbox" /> Win? </label>
						</div>
						<h3>Offense</h3>
						
					</form>
				</div>
			</div>
		</div>
		<!-- Add in active class to appropriate sidebar link -->
		[@JS_ACTIVE]
	</body>
</html>
