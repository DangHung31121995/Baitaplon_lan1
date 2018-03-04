<?php
	$conn =mysqli_connect("localhost","root","");
	mysqli_select_db($conn,'roombooking');
	mysqli_set_charset($conn,"utf8");
	
	$key=$_POST['id'];

	if($key==-1){
		?>
		<option selected="selected"  value="-1">Tỉnh Thành</option>
		<?php
	}
	else{
		$sql ="select * from hotel where idCity=$key";
		$query= mysqli_query($conn,$sql);
		while($row =mysqli_fetch_array($query)){
	?>
			<option  value="<?php echo $row['id'] ?>" > <?php echo $row['name']?> </option>
	<?php
		}

}	
?>