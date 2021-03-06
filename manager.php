<?php
/*
 * This is the project include file. It defines important things for the
 * project, and includes classes that are used throughout.
 */

/*
 Pages should set the `NAV_ACTIVE_ID` template variable if they want
 an active navigation link.
*/
define("SITE", "/var/www/html/manager/");
define("WWW_SITE", "/manager/");
define("VERSION", "0.95");

require_once "classes/Template.php";
require_once "classes/Session.php";
require_once "classes/User.php";
require_once "classes/Team.php";
require_once "classes/Player.php";
require_once "classes/Game.php";
require_once "classes/Site.php";
require_once "classes/GameBatter.php";
require_once "classes/GamePitcher.php";
require_once "classes/BatterStats.php";
require_once "classes/PitcherStats.php";
require_once "classes/OffenseWorkspace.php";
require_once "classes/Lineup.php";
require_once "classes/Settings.php";
require_once "classes/UserSettings.php";
require_once "classes/TeamSettings.php";
$template = new Template();
$session = new Session();
session_set_save_handler($session, true);
session_start();

if (@$_SESSION["is_logged"]) {
	$user = new User($_SESSION["uid"]);
}

$template->set("CSS_DIR", WWW_SITE . "view/css");

$nav_html = '<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="[@WWW_SITE]">General Manager</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="[@WWW_SITE]">Dashboard</a></li>
						<li id="settings-top"><a href="[@WWW_SITE]settings.php">Settings</a></li>
						<!--li><a href="#">Help</a></li-->
						<li><a href="[@WWW_SITE]logout.php">Sign out</a></li>
					</ul>
					<!--form class="navbar-form navbar-right">
						<input type="text" class="form-control" placeholder="Search...">
					</form-->
				</div>
			</div>
		</nav>';

$template->set("NAV", $nav_html);

$sidebar_html = '<div class="col-sm-3 col-md-2 sidebar">
					<ul class="nav nav-sidebar">
						<li id="overview"><a href="[@WWW_SITE]">Overview</a></li>
						<li id="add-game"><a href="[@WWW_SITE]add_game.php">Add Game</a></li>
						<li id="recent-games"><a href="[@WWW_SITE]recent_games.php">Recent Games</a></li>
					</ul>
					<ul class="nav nav-sidebar">
						<li id="offense"><a href="[@WWW_SITE]offense.php">Team Offensive Statistics</a></li>
						<li id="pitching"><a href="[@WWW_SITE]pitching.php">Team Pitching Statistics</a></li>
					</ul>
					<ul class="nav nav-sidebar">
						<li id="workspace"><a href="[@WWW_SITE]workspace.php">General Manager Workspace</a></li>
						<li id="next-game"><a href="[@WWW_SITE]next_game.php">Next Game</a></li>
					</ul>
				</div>';

$template->set("SIDEBAR", $sidebar_html);

$template->set("WWW_SITE", WWW_SITE);

$js_active_html = '<script type="text/javascript">
			var active = document.getElementById("[@NAV_ACTIVE_ID]");
			active.classList.add("active");
		</script>';
$template->set("JS_ACTIVE", $js_active_html);

$template->set("VERSION", VERSION);

?>
