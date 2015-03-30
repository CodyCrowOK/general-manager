<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>General Manager - Pitching Statistics</title>
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
					<h1 class="page-header">Pitching Statistics <small>[@team_name]</small></h1>
					<h3>Standard Statistics</h3>
					<table class="table table-striped sortable">
						<thead>
							<th>Name</th>
							<th>ERA</th>
							<th>IP</th>
							<th>W</th>
							<th>L</th>
							<th>S</th>
							<th>BS</th>
							<th>W-L%</th>
							<th>H</th>
							<th>BB</th>
							<th>HB</th>
							<th>ER</th>
							<th>K</th>
							<th>G</th>
						</thead>
						[@standard_rows]
					</table>
					<h3>Advanced Metrics</h3>
					<table class="table table-striped sortable">
						<thead>
							<th>Name</th>
							<th>WHIP</th>
							<th>H/<span class="innings"></span></th>
							<th>BB/<span class="innings"></span></th>
							<th>K/<span class="innings"></span></th>
							<th>K/BB</th>
							<th>FIP</th>
							<th>Quality Starts</th>
							<th>LOB%</th>
							<th>OBA</th>
							<th>Holds</th>
							<th>Batters Faced</th>
						</thead>
						[@advanced_rows]
					</table>
				</div>
			</div>
		</div>
		<!-- Add in active class to appropriate sidebar link -->
		[@JS_ACTIVE]
		<script src="[@CSS_DIR]/jquery-latest.min.js"></script>
		<script type="text/javascript">
			$(function() {
				$('.innings').text('[@user_innings]');
			});
		</script>
	</body>
</html>
