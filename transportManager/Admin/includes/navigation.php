<?php
$sql="SELECT * FROM categories WHERE parent = 0";
$pquery=$db->query($sql);
?>
<!--top navbar-->
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#famabmenu" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="/transportManager/Admin/index.php" class="navbar-brand">Transport Admin</a>
			</div>
			<div class="collapse navbar-collapse" id="famabmenu">
					<ul class="nav navbar-nav">
				<li><a href="routes.php">Routes</a></li>
				<li><a href="services.php">Services</a></li>
				<li><a href="schedules.php">Schedule</a></li>
				<li><a href="archived.php">Archived</a></li>
				<li><a href="drivers.php">Drivers</a></li>
			</ul>
			</div>
		</div>
	</nav>
