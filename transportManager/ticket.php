<?php
require_once 'core/init.php';
require_once 'includes/head.php';

 ?>
 <?php
if (isset($_POST['booked'])) {
	$name=$_POST['name'];
	$email=$_POST['email'];
	$time=$_POST['yourtime'];
	$seat=$_POST['seats'];
	$weight=$_POST['weight'];
	$date=$_POST['date'];
	$phone=$_POST['phone'];
	$price=$_POST['price'];
	//$totalPrice= $price*$seat;
	$driver=$_POST['driver'];
	$bus= $_POST['bus'];


	

	//sql to insert into the database the ticket details

	if (isset($_GET['confirmed'])) {
			$ticketSql = "INSERT INTO ticket (`name`,`email`,`phone`,`travel_time`,seat_number,`luggage` ) VALUES ('$name','$email','$phone','$time','$seat','$weight')";
			$db->query($ticketSql);
	}

}
 ?>
<SCRIPT LANGUAGE="JavaScript">
if (window.print) {
document.write('<form> '
+ '<input type=button name=print value="Print" class="btn btn-primary pull-right" '
+ 'onClick="javascript:window.print()"></form>');
}
// End -->
</script>

<div class="col-md-12"><h2 class="text-center" > Ticket Details</h2>
<div class="container" id="display">
	<p class="text-center"> Bus Number:&nbsp; #<b> <?php echo "$bus"; ?></b></p>
	<div class="col-md-4 col-md-offset-4 text-center"> 
		 <p class="form-control">Customer Name:&nbsp; &nbsp; <b> <?php echo "$name"; ?></b></p>
		 <p class="form-control"> Customer Email:&nbsp; &nbsp; <b> <?php echo "$email"; ?></b></p>
		<p class="form-control"> Departure Date:&nbsp; &nbsp; <b> <?php echo "$date"; ?></b></p>
		<p class="form-control"> Phone: <b> <?php echo "$phone"; ?></b></p>
	<p class="form-control"><b>	Your Preferred Time:&nbsp; &nbsp;  <?php echo "$time"; ?></b></p>
		 <p class="form-control">Luggage Weight:&nbsp; &nbsp; <b><?php echo "$weight"; ?>Kg</b></p>
		  <p class="form-control">Unit price:&nbsp; &nbsp; <b>N<?php echo "$price"; ?></b></p>
		   <p class="form-control">seat Number:&nbsp; &nbsp; <b><?php echo "$seat"; ?></b></p>
		  <p class="form-control">The driver: &nbsp; &nbsp; <b><?php echo "$driver"; ?></b></p>
		  <!-- <p class="form-control">Bus Choosen: <b><?php //echo "$choice"; ?>Kg</b></p>  -->
		  <button class="btn btn-default pull-left" name="confirmed">OK</button>

<button class="btn btn-default pull-right" name="confirmes">Decline</button>

	</div>
</div>

</div>
