<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/transportManager/core/init.php';
require 'includes/head.php';
require 'includes/navigation.php';
//get routes from database
$sql="SELECT * FROM routes ORDER BY routes";
$result=$db->query($sql);
$errors=array();

//Edit Brand
if (isset($_GET['edit'])&&!(empty($_GET['edit']))) {
	$edit_id=(int)$_GET['edit'];
	$edit_id=sanitize($edit_id);
	$sql2="SELECT * FROM routes WHERE id='$edit_id'";
	$edit_result=$db->query($sql2);
	$ebrand=mysqli_fetch_assoc($edit_result);
}

//delete brand
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
	$delete_id=(int)$_GET['delete'];
	$delete_id=sanitize($delete_id);
	// echo $delete_id;
	$sql="DELETE FROM routes WHERE id='$delete_id'";
	$db->query($sql);
	header('Location: routes.php');
}
//if add form is submitted
if (isset($_POST['add_submit'])) {
	$routes= sanitize($_POST['routes']);
	//check if brand is blank
	if ($_POST['routes']=='') {
		$errors[].="you must enter a route";
	}
	//check if brand exist in the database
	$sql="SELECT * FROM routes WHERE routes='$routes'";
	if (isset($_GET['edit'])) {
		$sql="SELECT * FROM routes WHERE routes='$routes' AND id != '$edit_id'";

	}
	$result=$db->query($sql);
	$count= mysqli_num_rows($result);
	if ($count>0) {
		$errors[].=$routes." already exists please choose another route name";
	}
	//display error
	if (!empty($errors)) {
		echo display_errors($errors);
	}
	else{
		$sql="INSERT INTO routes (routes) VALUES ('$routes')";
		if (isset($_GET['edit'])) {
			$sql="UPDATE routes SET routes= '$routes' WHERE id ='$edit_id'";
		}
		$db->query($sql);
		header('Location: routes.php');
	}
}
?>

<h2 class="text-center">Routes</h2><hr>
<!--brand form-->
<div class="text-center">
	<form class="form-inline" action="routes.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post">
		<div class="form-group">
			<?php
			$routes_value='';
			if (isset($_GET['edit'])) {
				$routes_value=$ebrand['routes'];
			}
			else{
				if (isset($_POST['routes'])) {
					$routes_value=sanitize($_POST['routes']);
				}
			}
			?>
			<label for="routes"><?=(isset($_GET['edit'])?'Edit ':'Add A '); ?>Route</label>
			<input type="text" name="routes" id="routes" value="<?=$routes_value; ?>">
			<?php if (isset($_GET['edit'])) : ?>
				<a href="routes.php" class="btn btn-default">Cancel</a>
		<?php endif; ?>
			<input type="submit" name="add_submit" value="<?=(isset($_GET['edit'])?'Edit ':'Add ');?>Route" class="btn btn-success">
		</div>
	</form>

</div>
<hr>
<table class="table table-bordered table-stripped  table-condensed">
	<thead><th>Edit</th><th class="text-center">Route</th><th>Delete</th></thead>
	<tbody>
		<?php while($routes=mysqli_fetch_assoc($result)) : ?>
		<tr>
			<td><a href="routes.php?edit=<?=$routes['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a></td>
			<td class="text-center"><?= $routes['routes'];?></td>
			<td><a href="routes.php?delete=<?=$routes['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
		</tr>
		<?php endwhile; ?>
	</tbody>
</table>
<?php include 'includes/footer.php';?>
