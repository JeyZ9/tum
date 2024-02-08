<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
<?php
require 'Connect.php';

$sql_select = 'select * from menu';
$stmt_s = $conn->prepare($sql_select);
$stmt_s->execute();
echo "food_id = ".$_GET['food_id'];

if (isset($_GET['food_id'])) {
    $sql_select_customer = 'SELECT * FROM food WHERE food_id=?';
    $stmt = $conn->prepare($sql_select_customer);
    $stmt->execute([$_GET['food_id']]);
    echo "get = ".$_GET['food_id'];
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Update customer </title>
  </head>
  <body>


    
<div class="container">
      <div class="row">
        <div class="col-md-4"> <br>
          <h3>ฟอร์มแก้ไขข้อมูลลูกค้า</h3>
          <form action="testCode.php" method="POST">
           <input type="hidden" name="food_id" value="<?= $result['food_id'];?>">
            
                <label for="name" class="col-sm-2 col-form-label"> ชื่อ:  </label>
              
                <input type="text" name="food_name" class="form-control" required value="<?= $result['food_name']?>">           
           
            
                <label for="name" class="col-sm-2 col-form-label"> อีเมล์ :  </label>
             
                <input type="text" name="food_price" class="form-control" required value="<?= $result['food_price']?>">
          
            <br> <button type="submit" name="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
          </form>
        </div>
      </div>
    </div>

  </body>
</html>