<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/transportManager/core/init.php';
require 'includes/head.php';
require 'includes/navigation.php';

//get the driver array from the database
$driver= "SELECT * FROM drivers ORDER BY RAND() Limit 1 ";
$driverquery= $db->query($driver);
while ($drivers = mysqli_fetch_assoc($driverquery)) {
	$driver = $drivers['name'];
	//$currentDriver= array_rand($driver,1);
	//echo $driver;

}

//the following lines of code deletes schedule
if (isset($_GET['delete'])) {
	$id=sanitize($_GET['delete']);
	$db->query("UPDATE schedules SET deleted=1 WHERE id='$id'");
	header('Location:schedules.php');
}
$dbpath='';
//handling the add event
if (isset($_GET['add'])|| isset($_GET['edit'])) {
$brandQuery=$db->query("SELECT * FROM routes ORDER BY routes");
$parentQuery=$db->query("SELECT * FROM services WHERE parent = 0 ORDER BY services" );
//the add variables
$title=((isset($_POST['title']) && $_POST['title']!='')? sanitize($_POST['title']):'');
	$brand=((isset($_POST['brand'])&& !empty($_POST['brand']))?sanitize($_POST['brand']):'');
	$parent=((isset($_POST['parent'])&& !empty($_POST['parent']))?sanitize($_POST['parent']):'');
	$service=((isset($_POST['child'])&& !empty($_POST['child']))?sanitize($_POST['child']):'');
	$price=((isset($_POST['price']) && $_POST['price']!='')? sanitize($_POST['price']):'');
	$list_price=((isset($_POST['list_price']) && $_POST['list_price']!='')? sanitize($_POST['list_price']):'');
	$description=((isset($_POST['description']) && $_POST['description']!='')? sanitize($_POST['description']):'');
     $drivername=((isset($_POST['drivername']) && $_POST['drivername']!='')? sanitize($_POST['drivername']):'');
        $bus=((isset($_POST['bus']) && $_POST['bus']!='')? sanitize($_POST['bus']):'');

		$sizes=((isset($_POST['sizes']) && $_POST['sizes']!='')? sanitize($_POST['sizes']):'');
		$sizes=rtrim($sizes,',');
		$saved_image='';
if (isset($_GET['edit'])) {
	$edit_id=(int)$_GET['edit'];
	$productResults=$db->query("SELECT * FROM schedules WHERE id='$edit_id'");
	$product=mysqli_fetch_assoc($productResults);
	if(isset($_GET['delete_image'])){
		$image_url=$_SERVER['DOCUMENT_ROOT'].$product['image'];
		unlink($image_url);
		$db->query("UPDATE schedules SET image WHERE id='$edit_id'");
		header('Location:schedules.php?edit='.$edit_id);
	}
	$service=((isset($_POST['child']) && $_POST['child'] !='')?sanitize($_POST['child']): $product['categories']);
$title=((isset($_POST['title']) && $_POST['title'] !='')?sanitize($_POST['title']):$product['title']);
$brand=((isset($_POST['brand']) && $_POST['brand'] !='')?sanitize($_POST['brand']):$product['brand']);
$parentQ=$db->query("SELECT * FROM services WHERE id ='$service'");
$parentResult=mysqli_fetch_assoc($parentQ);
$parent=((isset($_POST['parent']) && $_POST['parent'] !='')?sanitize($_POST['parent']):$parentResult['parent']);
$price=((isset($_POST['price']) && $_POST['price'] !='')?sanitize($_POST['price']):$product['price']);
$list_price=((isset($_POST['list_price']) && $_POST['list_price'] !='')?sanitize($_POST['list_price']):$product['list_price']);
$description=((isset($_POST['description']) && $_POST['description'] !='')?sanitize($_POST['description']):$product['description']);
$sizes=((isset($_POST['sizes']) && $_POST['sizes'] !='')?sanitize($_POST['sizes']):$product['sizes']);
$drivername=((isset($_POST['drivername']) && $_POST['drivername'] !='')?sanitize($_POST['drivername']):$drivers['name']);
$bus=((isset($_POST['bus']) && $_POST['bus'] !='')?sanitize($_POST['bus']):$product['bus']);

$sizes=rtrim($sizes,',');
$saved_image=(($product['image'] !='')?$product['image']:'');
$dbpath=$saved_image;
}
if (!empty($sizes)) {
		$sizeString=sanitize($sizes);
		$sizeString=rtrim($sizeString,',');
		$sizesArray=explode(',', $sizeString);
		$sArray=array();
		$qArray=array();
		foreach ($sizesArray as $ss) {
			$s=explode(':', $sizeString);
			$sArray[]=$s[0];
			$qArray[]=$s[1];
		}
	}
	else {$sizesArray=array();}
// $sizesArray=array();
if ($_POST) {

	$dbpath='';

	$required= array('title', 'brand', 'price', 'parent', 'child', 'sizes','drivername');
	foreach ($required as $field) {
		if ($_POST[$field]=='') {
			@$errors[]='All asterisked fields are required';

			break;
		}
	}
	if (!empty($_FILES)) {
		var_dump($_FILES);//for development purposes
		$photo=$_FILES['photo'];
		$name=$photo['name'];
		$nameArray=explode('.', $name);
		$fileName=$nameArray[0];
		$fileExt=$nameArray[1];
		$mime=explode('/', $photo['type']);
		$mimeType=$mime[0];
		$mimeExt=$mime[1];
		$temploc=$photo['tmp_name'];
		$fileSize=$photo['size'];
		$allowed=array('png','jpg','gif');
		$uploadName=md5(microtime()).'.'.$fileExt;
		$uploadPath=BASEURL.'images/schedules/'.$uploadName;
		$dbpath='/transportManager/images/schedules/'.$uploadName;
		if ($mimeType!='image') {
			$errors[] ="the file must be an image";
		}
		if (!in_array($fileExt, $allowed)) {
			$errors[]=" the file extension must be a png, jpg, or gif";
		}
		if($fileSize>1000000){
			$errors[]="The file size must be under 26mb";
		}
	if ($fileExt!=$mimeExt &&($mimeExt=='jpeg' && $fileExt !='jpg')) {
		$errors[]="File extension does not match file type";
	}
	}
		if (!empty($errors)) {
			echo display_errors($errors);
		}
		else{
			// this lines of codes from line 111 to 117 uploads file and insert into database
			move_uploaded_file($temploc, $uploadPath);
			$insertSql="INSERT INTO schedules (`title`,`price`,`DepartureTime`, `routes`,`services`, `available`,`image`,`description`,`driver`,`Bus`) VALUES
			('$title','$price','$list_price','$route','$service','$sizes','$dbpath','$description','$drivername','$bus')";
			if (isset($_GET['edit'])) {
				$insertSql="UPDATE schedules SET title='$title', price='$price', DepartureTime='$list_price',routes='$brand',services='$service', available='$sizes',image='$dbpath', description='$description',driver='$drivername','Bus=$bus' WHERE id ='$edit_id'";
			}
			$db->query($insertSql);
			header('Location:schedules.php');
	}
}
?>
<h2 class="text-center"><?=((isset($_GET['edit']))?'Edit':'Add A New');?> Schedule</h2>
<hr>
<div class="container-fluid">
<form action="schedules.php?add=<?=((isset($_GET['edit'])?'edit='.$edit_id:'add=1'));?>" method="POST" enctype="multipart/form-data">
	<div class="form-group col-md-3">
		<label for="title" class="text-center">Bus Details*</label>
		<input type="text" name="title" id="title" value="<?=$title;?>" class="form-control">
	</div>
	<div class="form-group col-md-3">
		<label for="brand" class="text-center">Routes*</label>
		<select class="form-control" id="brand" name="brand">
			<option value="" <?=(($brand=='')?' selected':'');?></option>
			<?php while($b= mysqli_fetch_assoc($brandQuery)):?>
				<option value="<?=$b['id'];?>"<?=(($brand==$b['id'])?' selected':'');?>><?=$b['routes'];?></option>

			<?php endwhile;?>
		</select>
	</div>
	<div class="form-group col-md-3">
		<label for="parent" class="text-center">Services*</label>
		<select class="form-control" id="parent" name="parent">
			<option value=""<?=(($parent == '')?' selected':'');?>></option>
			<?php while ($p= mysqli_fetch_assoc($parentQuery)): ?>
				<option value="<?=$p['id'];?>"<?=(($parent ==$p['id'])?' selected':'');?>><?=$p['services'];?></option>
			<?php endwhile;?>
		</select>
	</div>

	<div class="form-group col-md-3">
		<label for="child" class="text-center">Schedules*</label>
		<select class=" form-control" id="child" name="child">
			<option value=""></option>
		</select>
	</div>
	<div class="form-group col-md-3">
		<label for="price" class="text-center">Ticket Price*</label>
		<input type="text" name="price" class="form-control" id="price" value="<?=$price;?>">
	</div>
	<div class="form-group col-md-3">
		<label for="list_price" class="text-center">Depature Time</label>
		<input type="date" name="list_price" class="form-control" id="price" value="<?=$list_price;?>">
	</div>
	<div class="form-group col-md-3">
		<label for="Quantity&sizes" class="text-center">Available Tickets*</label>
		<button class="btn btn-default form-control" onclick="jQuery('#sizesModal').modal('toggle'); return false;"></button>
	</div>
	<div class="form-group col-md-3">
		<label for="sizes" class="text-center"> Tickects Preview</label>
		<input type="text" name="sizes" id="sizes" class="form-control" value="<?=$sizes;?>" readonly>
	</div>

<div class="form-group col-md-3">
	<?php if($saved_image!=''):?>
		<div class="saved-image" ><img src="<?=$saved_image;?>" alt="Saved image">
			<br>
			<a href="schedules.php?delete_image=1&edit=<?=$edit_id;?>" class="text-danger">Delete Image</a>
		</div>
	<?php else :?>
	<label for="photo"class="text-center">Route picture</label>
	<input type="file" id="photo" name="photo" class="form-control">
<?php endif;?>
</div>
<div class="form-group col-md-3">
		<label for="list_price" class="text-center">Driver</label>
		<input type="text" name="drivername" class="form-control" id="drivername" value="<?=$driver;?>">
	</div>
	<div class="form-group col-md-3">
		<label for="bus" class="text-center">Bus Number</label>
		<input type="number" name="bus" class="form-control" id="bus" value="<?=$driver;?>">
	</div>

<div class="form-group col-md-3">
	<label for="description"class="text-center"> Routes Description</label>
	<textarea class="form-control" rows="6" id="description" name="description">
		<?=$description;?>
	</textarea>
</div>
<div class="form-group pull-right">
	<a href="schedules.php" class="btn btn-default ">Cancel</a>
	<input type="submit" name="add" class="btn btn-success" value="<?=((isset($_GET['edit'])?'Edit':'Add '));?> schedules">
</div>
</div>
</form>
<!--modal-->
<div class="modal fade " id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="sizesModalLabel">Tickets Available</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
			<?php for($i=1;$i<=6;$i++):?>
				<div class="form-group col-md-4">
					<label for="size <?=$i;?>">Schedule Type</label>
					<input type="text" class="form-control" name=size"<?=$i;?>" id="size<?=$i;?>" value="<?=((!empty($sArray[$i-1]))?$sArray[$i-1]:'');?>">
				</div>
				<div class="form-group col-md-2">
					<label for="size <?=$i;?>">Available</label>
					<input type="number" class="form-control" name="qty<?=$i;?>" id="qty<?=$i;?>" min="0" value="<?=((!empty($qArray[$i-1]))?$qArray[$i-1]:'');?>">
				</div>
			<?php endfor;?>
		</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary" onclick="updateSizes();jQuery('#sizesModal').modal('toggle'); return false;">Save Changes</button>
		</div>
		</div>
	</div>
</div>
<?php
}
else{
$sql="SELECT * FROM schedules WHERE deleted = 0";
$presults= $db->query($sql);
if (isset($_GET['featured'])&& !empty($_GET['featured'])) {
	$id=(int)$_GET['id'];
	$featured=(int)$_GET['featured'];
	$featuredsql="UPDATE schedules SET featured='$featured' WHERE id='$id'";
	$db->query($featuredsql);
	header('Location:schedules.php');
}
?>
<h2 class="text-center">Tickets</h2>
<!--form for adding products-->
<a href="schedules.php?add=1" class="btn btn-success pull-right" id="add-schedule-btn">Add schedules</a>
<div class="clearfix"></div>
<hr>
<!-- this path of the page displays your uploaded Transport Schedule-->
<table class="table table-bordered table-condensed table-stripped">
	<thead>
		<th></th>
		<th>schedule</th>
		<th>Price</th>
		<th>Service</th>
		<th>Featured</th>
		<th>Available</th>
	</thead>
	<tbody>
		<?php while($product=mysqli_fetch_assoc($presults)) :
		$childID=$product['services'];
		$catsql="SELECT * FROM services WHERE id='$childID'";
		$result=$db->query($catsql);
		$child=mysqli_fetch_assoc($result);
		$parentID=$child['parent'];
		$psql="SELECT * FROM services WHERE id ='$parentID'";
		$presult=$db->query($psql);
		$parent=mysqli_fetch_assoc($presult);
		$service=$parent['services'].'-'.$child['services'];
		?>
			<tr>
				<td>
					<a href="schedules.php?edit=<?=$product['id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="schedules.php?delete=<?=$product['id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
				</td>
				<td><?=$product['title']?></td>
				<td><?=money($product['price']);?></td>
				<td><?=$service;?></td>
				<td><a href="schedules.php?featured=<?=(($product['featured'] == 0)?'1':'0');?> &id=<?=$product['id'];?>"  class=" btn btn-xs btn-default">
					<span class="glyphicon glyphicon-<?=(($product['featured']==1)?'minus':'plus');?>"></span></a>
					&nbsp <?=(($product['featured']==1)?' Featured Schedule':'');?>
				</td>
				<td>0</td>
			</tr>
		<?php endwhile;?>
	</tbody>
</table>
<?php }
include 'includes/footer.php';
?>
<script type="text/javascript">
	jQuery('document').ready(function(){
		get_child_options('<?=$service;?>');
	});
</script>
