<?php
require_once 'core/init.php';
require 'includes/head.php';
require 'includes/navigation.php';
include 'includes/header-full.php';
require 'includes/leftbar.php';
$sql="SELECT * FROM schedules WHERE featured =1 AND deleted=0";
$featured=$db->query($sql);
?>
		<div class="col-md-8">
			<div class="row">
				<h2 class="text-center">Available Routes</h2>
				<?php while($schedule=mysqli_fetch_assoc($featured)) :?>
				<div class="col-md-3">
					<h4 style="margin-top: 20px; font-weight: bold;"><?=$schedule['title']?></h4>
					<div><img src="<?=$schedule['image'] ?>" class="img-thumb"> </div>
					<p class="price">Our price <span>#<?=$schedule['price']?></span></p>
					<p> Driver: <?=$schedule['driver'];?></p>
					<button class="btn btn-sm btn-success" onclick="detailsmodal(<?=$schedule['id'];?>)">Book Now</button>
				</div>
			<?php endwhile;?>
			</div>
		</div>
		<?php
		require 'includes/rightbar.php';
		require 'includes/footer.php'; ?>

</html>

