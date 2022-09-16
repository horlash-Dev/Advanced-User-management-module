<?php 
require_once '../classes/conn.class.php';
$ins = new insert();

if (isset($_POST['input']) && $_POST['input'] == "show") {

	$fname =  htmlspecialchars($_POST['fname']);
	$lname =  htmlspecialchars($_POST['lname']);
	$email =  htmlspecialchars($_POST['mail']);
	$user =  htmlspecialchars($_POST['users']);

	$ins->getn($fname,$lname,$email,$user);
	
	exit();


    // Swal.fire({
        //                 title: "are u sure",
        //                 text: "you want update yhis file"
        //                 icon: "warning"
        //                 showCancelButton: true;
        //                 confirmButtonColor: "#3085d6",
        //                 cancelButtonColr:'#d33',
        //                 confirmButtonText: "yes update it"


        //                }).then((result)=>{
        //                 if (result.value) {
        //                     Swal.fire(
        //                         "deletred",
        //                         "yr file",
        //                         "success")
        //                 }
        //                }) 
 } ?>

 <?php 
require_once '../classes/conn.class.php';
$read = new read();
$rows = new Row();
$ins = new insert();
$detail = new details();
$update = new update();
$del = new del();
if (isset($_POST['info']) && $_POST['info'] == "show") {
    $data = $read->get();
    if ($rows->get()> 0) {
        $result = '
        <table class="table table-bodered table-striped">
                    <thead>
                        <tr class="text-center">

                            <th>id</th>
                            <th>firstname</th>
                            <th>lastname</th>
                            <th>email</th>
                            <th>username</th>
                            <th>social networks</th>
                            <th>actions</th>
                        </tr>
                    </thead>
                    ';
                    foreach ($data as $row) {
                        $result .='
                        <tbody>
                   
                        <tr class="text-center text-secondary">
                            <td>'.$row['id'].'</td>
                            <td>'.$row['Fname'].'</td>
                            <td>'.$row['Lname'].'</td>
                            <td>'.$row['Email'].'</td>
                            <td>'.$row['User'].'</td>
                            <td>
                                <a href="" class="text-primary"><i class="fab fa-facebook-messenger m-1 "></i></a>
                                <a href="" class="text-primary"><i class="fab fa-twitter m-1"></i></a>
                                <a href="" class="text-primary"><i class="fab fa-instagram m-1"></i></a>
                            </td>
                            <td>      
                <a href="" class="text-info"><i class="fas fa-info-circle infoBtn"id="'.$row['id'].'"></i>&nbsp;</a>
                <a href="" class="text-success editBtn" id="'.$row['id'].'" data-toggle="modal" data-target="#showModal2"><i class="fas fa-pen-fancy m-1"></i></a>
                <a href="" class="text-danger delBtn" id="'.$row['id'].'"><i class="fas fa-trash-alt m-1"></i></a> 
                            </td>
                        </tr></tbody>';    
                    }
                    $result .='</table>';
                    echo $result;
    } else{
        die("<h3 class='lead'>no user inside database</h3>");
    
    }
} 
// else{
//  die("<h3 class='lead'>db conn erro-r</h3>");
//  return false;
// }

if (isset($_POST['input']) && $_POST['input'] == "show") {
    $fname =  htmlspecialchars($_POST['fname']);
    $lname =  htmlspecialchars($_POST['lname']);
    $email =  htmlspecialchars($_POST['mail']);
    $user =  htmlspecialchars($_POST['users']);

    $ins->getn($fname,$lname,$email,$user);
    
    exit();
}

if (isset($_POST['edit'])) {
    $Data = $_POST['edit'];
    $row = $detail->detail($Data);
    echo json_encode($row);
}

if (isset($_POST['input']) && $_POST['input'] == "update") {
    $id =  htmlspecialchars($_POST['id']);
    $fname =  htmlspecialchars($_POST['fname']);
    $lname =  htmlspecialchars($_POST['lname']);
    $email =  htmlspecialchars($_POST['mail']);
    $user =  htmlspecialchars($_POST['users']);

    $update->updt($fname,$lname,$email,$user,$id);
    exit();
}

if (isset($_POST['delNo'])) {
    $Data = $_POST['delNo'];
    $delete = $del->delt($Data);
}

if (isset($_POST['info'])) {
    $data = $_POST['info'];
    $inf = $detail->detail($data);
   echo json_encode($inf);
    
}

 ?>
