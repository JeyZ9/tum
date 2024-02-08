<?php
 require 'Connect.php';
 echo $_GET['food_id'];
 $sql = "DELETE FROM food WHERE food_id = :food_id";
 $stmt = $conn->prepare($sql);
 $stmt->bindParam(":food_id",$_GET["food_id"]);
 //  $stmt->execute();

 echo '
 <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

if ($stmt->execute()) {
 echo '
 <script type="text/javascript">
 
 $(document).ready(function(){
 
     swal({
         title: "Success!",
         text: "Successfuly update customer information",
         type: "success",
         timer: 2500,
         showConfirmButton: false
       }, function(){
             window.location.href = "Index.php";
       });
 });
 
 </script>
 ';
}
$conn = null;
?>