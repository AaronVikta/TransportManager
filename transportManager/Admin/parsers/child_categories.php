<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/transportManager/core/init.php';
$parentID= (int)$_POST['parentID'];
$selected=sanitize($_POST['selected']);
$childQuery=$db->query("SELECT * FROM services WHERE parent ='$parentID' ORDER BY services");

ob_start();?>
<option value=""></option>
<?php while($child=mysqli_fetch_assoc($childQuery)):?>
	<option value="<?=$child['id'];?>"<?=(($selected==$child['id'])?' selected':'');?>><?=$child['services'];?></option>
<?php endwhile;?>
<?php echo ob_get_clean();?>
