<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>General Manager - Offensive Statistics</title>
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
					<h1 class="page-header">Offensive Statistics <small>[@team_name]</small></h1>
					<h3>Standard Statistics</h3>
					<table class="table table-striped sortable">
						<thead>
							<th>Name</th>
							<th>AVG</th>
							<th>OBP</th>
							<th>SLG</th>
							<th>H</th>
							<th>AB</th>
							<th>RBI</th>
							<th>2B</th>
							<th>3B</th>
							<th>HR</th>
							<th>SO</th>
							<th>G</th>
						</thead>
						[@standard_rows]
					</table>
					<h3>Advanced Metrics</h3>
					<table class="table table-striped sortable">
						<thead>
							<th>Name</th>
							<th><abbr title="Batting Average">AVG</abbr></th>
							<th><abbr title="On Base plus Slugging">OPS</abbr></th>
							<th>Runs Created</th>
							<th>RC/G</th>
							<th>Base Runs</th>
							<th>Isolated Power</th>
							<th>Secondary Average</th>
							<th>BB/K</th>
							<th>wOBA</th>
							<th>Times on Base</th>
						</thead>
						[@advanced_rows]
					</table>
				</div>
			</div>
		</div>
		<!-- Add in active class to appropriate sidebar link -->
		[@JS_ACTIVE]
	</body>
</html>
