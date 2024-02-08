<?php
if (isset($_POST['food_id'])) {
    require 'Connect.php';

    $food_id = $_POST["food_id"];
    $food_name = $_POST["food_name"];
    $food_price = $_POST["food_price"];
    $menu_id = $_POST["menu_id"];

    echo 'test : ' . $food_name;
    echo 'test : ' . $food_price;
    echo 'test : ' . $menu_id;

    $stmt = $conn->prepare(
        "UPDATE food SET food_name=:food_name,food_price=:food_price,menu_id=:menu_id WHERE food_id=:food_id"
    );

    $stmt->bindParam(":food_id", $food_id);
    $stmt->bindParam(":food_name", $food_name);
    $stmt->bindParam(":food_price", $food_price);
    $stmt->bindParam(":menu_id", $menu_id);
    $stmt->execute();

    echo '
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    if ($stmt->rowCount() >= 0) {
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
    echo "success!";
}