<?php 
//require_once 'control.class.php';

class view extends control 
{   
    
    public function uDetails()
    { if (isset($_SESSION['details'])) {
      $cUSER= $_SESSION['details'];
        $currentUser= $this->userInfo($cUSER);
         if ($currentUser === false) {
         echo parent::erMsg("erro__r user not found/invalid details*");
         header('location: ../includes/logout.in.php');
        } else{
            return $currentUser;}}
    }
  
}

// if (!isset($_SESSION['details'])) {
//         header("location: index.php");
//     } else{
//         $cUSER=$_SESSION['details'];
//         $currentUser= $this->userInfo($cUSER);
//         if ($currentUser === false) {
//          echo parent::erMsg("erro__r session details error");
//         } else{
//             return $currentUser;
//             //echo $currentUser['User'];
           
//         }
     
//     }

 ?>