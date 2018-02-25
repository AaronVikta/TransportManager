<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/transportManager/core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
require_once 'categoriesfunction.php';
?>
<h2 class="text-center">Services</h2>
<hr>
<div class="row">
	<!--this is our form-->
	<div class="col-md-6" style="margin-top: -20px;" >
		<form class="form" action="services.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="POST">
			<legend><?=((isset($_GET['edit']))?'Edit ':'Add A ');?> Service</legend>
			<div id="errors"></div>
			<div class="form-group">
				<label for="parent">Parent</label>
				<select class="form-control" name="parent" id="parent">
					<option value="0"<?=(($parent_value == 0)?' selected="selected"':'');?>>Parent</option>
					<?php while($parent=mysqli_fetch_assoc($result)):?>
						<option value="<?=$parent['id'];?>"<?=(($parent_value==$parent['id'])?' selected="selected"':'');?>><?=$parent['services'];?></option>
					<?php endwhile;?>
				</select>
			</div>
			<div class="form-group">
				<label for="category">Service</label>
				<input type="text" name="category" id="category" class="form-control" value="<?=$services_value;?>">
			</div>
			<div class="form-group">
				<input type="submit" name="Addcategory" class="btn btn-success" value="<?=((isset($_GET['edit']))?'Edit ':'Add A ');?>Service">
			</div>
		</form>
	</div>
	<!--this is our category table-->
	<div class="col-md-6">
		<table class="table table-bordered">
			<thead>
				<th>Services</th>
				<th>Parent</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php
				$presult=$db->query($sql);
				 while($parent=mysqli_fetch_assoc($presult)):
				$parent_id=$parent['id'];
				$sql2="SELECT * FROM services WHERE parent='$parent_id'";
				$cresult=$db->query($sql2);?>
				<tr class="bg-primary">
					<td><?=$parent['services']?></td>
					<td>parent</td>
					<td>
						<a href="services.php?edit=<?=$parent['id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
						<a href="services.php?delete=<?=$parent['id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
					</td>
				</tr>
					<?php while($child=mysqli_fetch_assoc($cresult)) :?>
					<tr class="bg-info">
						<td><?=$child['services']?></td>
					<td><?=$parent['services'] ?></td>
						<td>
							<a href="services.php?edit=<?=$child['id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
							<a href="services.php?delete=<?=$child['id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
						</td>
				    </tr>
					<?php endwhile;?>
			<?php endwhile;?>
			</tbody>
		</table>
	</div>
</div>

<?php
include 'includes/footer.php';
?>
