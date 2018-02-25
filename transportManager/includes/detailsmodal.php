
<?php
//require the essentials
require_once '../core/init.php';
//get variables
$id=$_POST['id'];
$id=(int)$id;
$sql="SELECT * FROM schedules WHERE id='$id'";
$result=$db->query($sql);
$service=mysqli_fetch_assoc($result);
$brand_id=$service['id'];
$sizestring=$service['available'];
$sizestring=trim($sizestring);
$size_array=explode(',', $sizestring);
$seat= array(01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16 );
$seats=array_rand($seat);
// echo "$seat";
?>
//get the php object stream
<?php
ob_start(); ?>
<div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" arial-labeyby="details-1" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" onclick="closeModal()" arial-label="close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title text-center"># <?php echo $service['title'];
				$busId= $service['title'];?></h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
							<div class="center-block">
								<img src="<?php echo $service['image'];?>" alt="<?php echo $service['title'];?>" class="details img-responsive">
							</div>
						</div>
						<div class="col-sm-6">
							<p> <?=$service['description'];
							$description=$service['description'];?></p>
							<hr>
							<p><b>price per ticket</b>:N<?php echo $service['price'];
							$ticketPrice=$service['price'];
							$driver=$service['driver'];
							?></p>
							<p> Bus Number: #<?php $bus=$service['Bus'];
						 echo $bus; ?></p>
							<form id="form1" action="../transportManager/ticket.php" method="post">
								<div class="form-group">
									<label for="name">Name</label>
									<input type="text" name="name" id="name" class="form-control">
									<input type="hidden" name="bus" value="<?=$bus;?>">
								</div>
								<div class="form-group">
									<label for="phone">phone Number</label>
									<input type="hidden" name="price" value="<?=$ticketPrice;?>">
									<input type="number" name="phone" id="phone" class="form-control">
								</div>
								<div class="form-group">
									<label for="Email">Email</label>
									<input type="email" name="email" id="email" class="form-control">
									<input type="hidden" name="driver" value="<?=$driver;?>">
								</div>
								<div class="form-group">
									<label for="quantity">Travel time</label>
									<input type="hidden" name="date" value="<?=$service['DepartureTime'];?>">
									<input type="time" name="yourtime" id="yourtime" class="form-control">
								</div>
								<div class="form-group">
									<label for="seats">Seat Number</label>
									<input type="number" name="seats" id="seats" class="form-control" value="<?php 	echo "$seats";;?>">
								</div>
								<div class="form-group">
									<label for="quantity">Assumed Luggage weight</label>
									<input type="number" name="weight" id="weight" class="form-control">
								</div>
								<button class=" btn btn-warning pull-right" type="submit" name="booked"><span class="glyphicon glyphicon-shopping-cart"> Confirm </span></button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<?php
				//$ticketID = $_POST['ticket_id']; ?>
				<button  class="btn btn-default" onclick="closeModal()">Close</button>
			</div>
		</div>
		</div>
	</div>
	<script type="text/javascript">
		function closeModal() {
			jQuery('#details-modal').modal('hide');
			setTimeout(function(){
				jQuery('#details-modal').remove();
				// jQuery('.modal-backdrop').remove();
			},500)
		}
	</script>
	<?php echo  ob_get_clean(); ?>
