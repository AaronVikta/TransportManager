<?php
$sql="SELECT * FROM services WHERE parent = 0";
$pquery=$db->query($sql);
?>


	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#famabmenu" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="/transportManager/index.php" class="navbar-brand">TransportManager</a>
			</div>
			<div class="collapse navbar-collapse" id="famabmenu">
				<ul class="nav navbar-nav">
				<?php while($parent=mysqli_fetch_assoc($pquery)) : ?>
					 <?php
					$parent_id=$parent['id'];
					$sql2="SELECT * FROM services WHERE parent ='$parent_id'";
					$cquery=$db->query($sql2);
					?>
				<li class="dropdown">
				<a href="/transportManager/index.php" class="dropdown-toggle" data-toggle="dropdown"><?php echo $parent['services'];?><span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<?php while($child=mysqli_fetch_assoc($cquery)) : ?>
					<li><a href="#"><?php echo $child['services']; ?></a></li>
				<?php endwhile; ?>
				</ul>
				</li>
			<?php endwhile; ?>
		</ul>
			</div>
		</div>
	</nav>
