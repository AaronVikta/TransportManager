<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/transportManager/core/init.php';
require 'includes/head.php';
require 'includes/navigation.php';
$sql="SELECT * FROM schedules WHERE deleted =1";
$deleted=$db->query($sql);
	$sql1="SELECT * FROM schedules WHERE deleted = 0";
$presults= $db->query($sql1);
	while($schedule=mysqli_fetch_assoc($presults)) :
		$childID=$schedule[''];
		$catsql="SELECT * FROM services WHERE id='$childID'";
		$result=$db->query($catsql);
		$child=mysqli_fetch_assoc($result);
		$parentID=$child['parent'];
		$psql="SELECT * FROM services WHERE id ='$parentID'";
		$presult=$db->query($psql);
		$parent=mysqli_fetch_assoc($presult);
		$service=$parent['services'].'-'.$child['services'];?>
<?php endwhile;?>

<h2 class="text-center">Archived Schedules</h2>
<table class="table table-bordered table-stripped">
	<thead>
		<tr>
			<th></th>
			<th>Route</th>
			<th>Price</th>
			<td>Service</td>
			<td>Time</td>
		</tr>
	</thead>
	<tbody>

			<?php while($archivedProduct=mysqli_fetch_assoc($deleted)):?>
				<?php $productID=$archivedProduct['id'] ;?>
				<tr>
			<td><a href="archived.php?restore=<?=$productID;?>" class=" btn btn-xs btn-default"><span class="glyphicon glyphicon-refresh"></span></a></td>

			<td><?=$archivedProduct['title'];?></td>
			<td> <?=$archivedProduct['price'];?></td>
			<td> <?=$service;?></td>
			<td>0</td>
				</tr>
		<?php endwhile;
		if (isset($_GET['restore'])) {
	$restoreSql=$db->query("UPDATE schedules SET deleted = 0 WHERE id='$productID'");
	if($restoreSql){
		header('Location:archived.php');
	}

}?>

	</tbody>
</table>
