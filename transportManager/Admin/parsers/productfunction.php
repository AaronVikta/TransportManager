<table class="table table-bordered table-condensed table-stripped">
	<thead>
		<th></th>
		<th>Product</th>
		<th>Price</th>
		<th>Categories</th>
		<th>Featured</th>
		<th>Sold</th>
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
					&nbsp <?=(($product['featured']==1)?' Featured Schedules':'');?>
				</td>
				<td>0</td>
			</tr>
		<?php endwhile;?>
	</tbody>
</table>
