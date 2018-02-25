<?php
$sql="SELECT * FROM services WHERE parent= 0";
$result=$db->query($sql);
$errors=array();
$post_parent='';

//edit category
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
	$edit_id=(int)$_GET['edit'];
	$edit_id=sanitize($edit_id);
	$edit_sql="SELECT * FROM services WHERE id='$edit_id'";
	$edit_result=$db->query($edit_sql);
	$edit_services=mysqli_fetch_assoc($edit_result);
}
//delete category
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
	$delete_id=(int)$_GET['delete'];
	$delete_id=sanitize($delete_id);
	$sql="SELECT * FROM services WHERE id='$delete_id'";
	$result=$db->query($sql);
	$service=mysql_fetch_assoc($result);
	if ($service['parent'] == 0) {
		$sql="DELETE FROM services WHERE id = '$delete_id'";
		$db->query($sql);
	}
	$dsql="DELETE FROM services WHERE id ='$delete_id'";
	$db->query($dsql);
	header('Location:services.php');
}
//process form
if (isset($_POST) && !empty($_POST)) {
	$post_parent=sanitize($_POST['parent']);
	$service=sanitize($_POST['category']);
	$sqlform="SELECT * FROM services WHERE services='$service' AND parent='$post_parent'";
	if (isset($_GET['edit'])) {
		$id=$edit_category['id'];
		$sqlform="SELECT * FROM services WHERE services='$service' AND parent='$post_parent' AND id !='$id";
	}
	$fresult=$db->query($sqlform);
	$count=mysqli_num_rows($fresult);
	//if category is blank
	if ($service =='') {
		$errors[].='The service field cannot be left blank.';
	}

	//if exist in the datbase
	if ($count>0) {
		$errors[].=$service.' Already Exist choose a new service';
	}
	//display errors or update database
	if (!empty($errors)) {
		# display errors
		$display=display_errors($errors); ?>
		<script type="text/javascript">
			jQuery('document').ready(function(){
				jQuery('#errors').html('<?=$display;?>');
			});
		</script>
		<?php
		 }
		 else {
		# update database
		 	$updatesql="INSERT INTO services (services, parent) VALUES ('$service',$post_parent)";
		 	if (isset($_GET['edit'])) {
		 		$updatesql="UPDATE services SET services = '$service', parent= '$post_parent' WHERE id='$edit_id'";
		 	}
		 	$db->query($updatesql);
		 	header('Location:services.php');
	}
}
$services_value='';
$parent_value=0;
if (isset($_GET['edit'])) {
	$services_value=$edit_services['services'];
	$parent_value=$edit_services['parent'];
}
else{
	if (isset($_POST)) {
		$services_value=@$service;
		$parent_value=$post_parent;
	}
}
