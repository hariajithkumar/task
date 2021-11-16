<?php
	include '../db/dbconfic.php';
	if($_GET["action"]=='save'){
	$id=$_POST['id'];	
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$email=$_POST['email'];
	$pass=$_POST['pass'];
	$conp=$_POST['conp'];
	
	if(!empty($id)){
     $sql="UPDATE `ex` SET `firstname` = '$fname', `lastname` = '$lname', `email` = '$email', `password` = '$pass', `confirmpassword` = '$conp' WHERE `id` = $id";
	}else{
	$sql = "INSERT INTO `ex`( `firstname`,`lastname`,`email`,`password`,`confirmpassword`) VALUES ('$fname','$lname','$email','$pass','$conp')";
	}
	if(mysqli_query($con, $sql)){
		echo "successfully insert";

	} 
	else {
		echo "not insert";
	}
}elseif($_GET["action"]=='edit'){
	$id=$_POST['id'];
	$query="Select * from `ex` where id=$id";
	$spl=mysqli_query($con,$query);
	$fetch=mysqli_fetch_assoc($spl);
	$num= mysqli_num_rows($spl);
	if($num==1){
		echo json_encode($fetch);
	}else{
		echo "not successfully";
	}

}elseif($_GET["action"]=='delete'){

	$id=$_POST['id'];
	$query="Delete from `ex` where id=$id";
	$spl=mysqli_query($con,$query);
	if($spl){
		echo "delete";
	}else{
		echo "not delete";
	}
	
}

?>