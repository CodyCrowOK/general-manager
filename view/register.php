<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>General Manager</title>

		<link href="[@CSS_DIR]/cosmo.css" rel="stylesheet" />

		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="[@WWW_SITE]">General Manager</a>
					<a class="btn btn-default navbar-btn navbar-right" href="[@WWW_SITE]login.php">Sign in</a>
				</div>
			</div>
		</nav>
		<div class="container">
			<h1>Sign Up</h1>
			<span class="text-danger">[@message]</span>
			<form action="register.php" method="POST">
				<div class="form-group">
					<label for="name">Your Name:</label>
					<input type="text" class="form-control" id="name" name="name" placeholder="Name" />
				</div>
				<div class="form-group">
					<label for="email">Email Address:</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Email" />
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Password" />
				</div>
				<button type="submit" class="btn btn-large btn-primary">Sign Up</button>


			</form>
		</div>
	</body>
</html>
