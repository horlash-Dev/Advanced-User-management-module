<?php 
if (isset($_POST['fileSubmit'])) {
	//print_r($_FILES['profileImage']['name']);
	 $filename= $_FILES['profileImage']['name'];
	 $filesize= $_FILES['profileImage']['size'];
	 $filedir= $_FILES['profileImage']['tmp_name'];
	 $filerror= $_FILES['profileImage']['error'];

	 $Ext= explode(".", $filename);
	 $filext= strtolower(end($Ext));
	 $type = array('jpg','png','jpeg','gif');
	 if (!in_array($filext, $type)) {
	 	echo "no";
	 } else {
	 	if (!$filesize < 50000) {
	 		if ($filerror != true) {
	 			$DESt= "uploads/profile" . uniqid() . ".$filext";
	 			move_uploaded_file($filedir, $DESt);
	 			header("location: users/profile.php?success");
	 		} else {
	 			echo "nAHH";
	 		}
	 	} else {
	 		echo "nooo";
	 	}
	 	
	 }
	 
}


 ?>