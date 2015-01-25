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
		<script src='http://code.jquery.com/jquery-latest.min.js' type='text/javascript'></script>
		<script type='text/javascript'>
			$(window).load(function(){
				jQuery(function($){
				    var $button = $('#new-offense-row'),
				        $row = $('.offense-row').clone();
				    
				    $button.click(function(){
				        $row.clone().insertAfter( $('.offense-row:last') );
				    });
				});
				jQuery(function($){
				    var $button = $('#new-pitching-row'),
				        $row = $('.pitching-row').clone();
				    
				    $button.click(function(){
				        $row.clone().insertAfter( $('.pitching-row:last') );
				    });
				});
			});
		</script>
	</head>
	<body>
		[@NAV]

		<div class="container-fluid">
			<div class="row">
				[@SIDEBAR]
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<h1 class="page-header">Add Game <small>[@team_name]</small></h1>
					<form action="[@WWW_SITE]add_game.php" method="POST">
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
						<table class="table table-bordered" id="offense-table">
							<tr>
								<th>Player</th>
								<th><abbr title="Plate Appearances">PA</abbr></th>
								<th><abbr title="Hits">H</abbr></th>
								<th><abbr title="Walks">BB</abbr></th>
								<th><abbr title="Strikeouts">SO</abbr></th>
								<th><abbr title="Hit by Pitch">HBP</abbr></th>
								<th><abbr title="Doubles">2B</abbr></th>
								<th><abbr title="Triples">3B</abbr></th>
								<th><abbr title="Homeruns">HR</abbr></th>
								<th><abbr title="Runs Batted In">RBI</abbr></th>
								<th><abbr title="Sacrifice Bunts">SH</abbr></th>
								<th><abbr title="Sacrifice Flies">SF</abbr></th>
								<th><abbr title="Runs">R</abbr></th>
								<th><abbr title="Stolen Bases">SB</abbr></th>
								<th><abbr title="Caught Stealing">CS</abbr></th>
								<th><abbr title="Ground into Double Play">GDP</abbr></th>
								<th>Times on Base</th>
							</tr>
							<tr class="offense-row">
								<td>
									<select class="form-control" name="player[]">
										[@select_options_players]
									</select>
								</td>
								<td><input class="form-control" type="number" name="opa[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="oh[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="obb[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="oso[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="ohbp[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="o2b[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="o3b[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="ohr[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="orbi[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="osh[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="osf[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="or[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="osb[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="ocs[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="ogdp[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="otob[]" value="0" min="0" /></td>
							</tr>
						</table>
						<a class="btn btn-primary" id="new-offense-row"><span class="badge"> + </span> Add Player</a>
						<h3>Pitching</h3>
						<table class="table table-bordered" id="pitching-table">
							<tr>
								<th>Player</th>
								<th>Starter?</th>
								<th>Win?</th>
								<th>Loss?</th>
								<th><a target="_blank" href="http://en.wikipedia.org/wiki/Hold_(baseball)">Hold?</a></th>
								<th>Save?</th>
								<th>Blown Save?</th>
								<th><abbr title="Innings Pitched">IP</abbr></th>
								<th><abbr title="Hits">H</abbr></th>
								<th><abbr title="Walks">BB</abbr></th>
								<th><abbr title="Hit Batsman (Hit by Pitch)">HB</abbr></th>
								<th><abbr title="Earned Runs">ER</abbr></th>
								<th><abbr title="Strikeouts">K</abbr></th>
								<th><abbr title="Homeruns Allowed">HR</abbr></th>
								<th>Batters Faced</th>
							</tr>
							<tr class="pitching-row">
								<td>
									<select class="form-control" name="pitcher[]">
										[@select_options_pitchers]
									</select>
								</td>
								<td><input type="hidden" name="pstart[]" value="0" /><input class="form-control" type="checkbox" /></td>
								<td><input type="hidden" name="pw[]" value="0" /><input class="form-control" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value"  /></td>
								<td><input type="hidden" name="pl[]" value="0" /><input class="form-control" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" /></td>
								<td><input type="hidden" name="phold[]" value="0" /><input class="form-control" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" /></td>
								<td><input type="hidden" name="psave[]" value="0" /><input class="form-control" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" /></td>
								<td><input type="hidden" name="pbs[]" value="0" /><input class="form-control" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" /></td>
								<td><input class="form-control" type="text" name="pip[]" placeholder="e.g. 6.2" /></td>
								<td><input class="form-control" type="number" name="ph[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="pbb[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="phb[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="per[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="pk[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="phr[]" value="0" min="0" /></td>
								<td><input class="form-control" type="number" name="pbf[]" value="0" min="0" /></td>
							</tr>
						</table>
						<a class="btn btn-primary" id="new-pitching-row" style="margin-bottom:20px;"><span class="badge"> + </span> Add Player</a>
						<div class="form-group">
							<input type="submit" value="Add Game" class="btn btn-default btn-lg" />
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Add in active class to appropriate sidebar link -->
		[@JS_ACTIVE]
	</body>
</html>
