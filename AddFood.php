<?php
    require 'Connect.php';

    $sql_m = "SELECT * FROM menu";
    $stmt_m = $conn->prepare($sql_m);
    $stmt_m->execute();

    if(isset($_POST['submit'])){
        $uploadFile = $_FILES['image']['name'];
        $tmpFile = $_FILES['image']['tmp_name'];
        echo " upload file = " . $uploadFile;
        echo " tmp file = " . $tmpFile;

        $sql = 'INSERT INTO food VALUES(:food_id, :food_name, :food_price, :menu_id, :image)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":food_id",$_POST['food_id']);
        $stmt->bindParam(":food_name",$_POST['food_name']);
        $stmt->bindParam(":food_price",$_POST['food_price']);
        $stmt->bindParam(":menu_id",$_POST['menu_id']);
        $stmt->bindParam(':image', $uploadFile);
        echo "image = " . $uploadFile;


        $fullpath = "./image/" . $uploadFile;
        echo " fullpath = " . $fullpath;
        move_uploaded_file($tmpFile, $fullpath);

        echo '
            <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

        try {
            if ($stmt->execute()) :
                //$message = 'Successfully add new customer';
                echo '
                    <script type="text/javascript">        
                    $(document).ready(function(){
                
                        swal({
                            title: "Success!",
                            text: "Successfuly add customer",
                            type: "success",
                            timer: 2500,
                            showConfirmButton: false
                        }, function(){
                                window.location.href = "Index.php";
                        });
                    });                    
                    </script>
                ';
            else :
                $message = 'Fail to add new customer';
            endif;
            // echo $message;
        } catch (PDOException $e) {
            echo 'Fail! ' . $e;
        }
        $conn = null;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="Style.css" />
</head>
<body>
    <div class="flex items-center justify-center h-screen">
        <form action="AddFood.php" method="post" enctype="multipart/form-data" class="flex flex-col items-center justify-between text-gray-600 h-[60vh]">
            <div class="flex flex-col items-center">
                <div class="">
                    <h1 class="text-[2rem] font-semibold">CREATE FOOD</h1>
                </div>
                <div class="w-[20vw]  ">
                    <label for="food_id">Enter: Food_id</label>
                    <input name="food_id" type="text" class="w-full border border-gray-500 outline-none">
                </div>
                <div class="w-[20vw]  ">
                    <label for="">Enter: Name</label>
                    <input type="text" name="food_name" class="w-full border border-gray-500 outline-none">
                </div>
                <div class="w-[20vw]  ">
                    <label for="">Enter: Price</label>
                    <input type="number" name="food_price" class="w-full border border-gray-500 outline-none">
                </div>
                <div class="w-[20vw] ">
                    <label for="">Enter: Menu_id</label>
                    <select name="menu_id" class="w-full border border-gray-500 outline-none">
                        <?php while ($cc = $stmt_m->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $cc['menu_id']; ?>">
                                <?php echo $cc['menu_name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="w-[20vw] ">
                    <label for="">Image</label>
                    <input type="file" name="image" id="image" required class="block w-full bg-orange-200 text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50 focus:outline-none">
            </div>
            </div>

            <div class="">
                <button type="submit" name="submit" class="w-[20vw] bg-orange-500 text-white p-1" >ADD</button>
            </div>
        </form>
    </div>

</body>
</html>