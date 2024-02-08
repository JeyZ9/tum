<?php
    require 'Connect.php';

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM food inner join menu on menu.menu_id = food.menu_id WHERE food.menu_id = :menu_id";
        $stmt_th = $conn->prepare($sql);
        $stmt_th->bindParam(':menu_id',$_POST['menu_id']);
        if($stmt_th->execute()){
            echo 'Nice!';
        }

        $sql = "SELECT * FROM food inner join menu on menu.menu_id = food.menu_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="styleSheet" href="Style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <form action="Index.php" method="post">

    <div class="flex items-center justify-center gap-5">
        <div class="flex justify-center items-center my-5">
            <h1 class="font-bold text-[2rem] border-b-2 border-gray-500 text-gray-700">เมนูอาหาร</h1>
        </div>
        <div class="flex items-center bg-orange-500 rounded-[5px] h-full text-white text-sm">
            <a href="AddFood.php" class="px-2 py-1"><i class="fa-solid fa-plus"></i>เพิ่มรายการ</a>
        </div>
    </div>
    <table class="border border-gray-700 m-auto w-[50vw] bg-[#ffffff90]">
        <thead class='border border-gray-500 text-center'>
            <tr>
                <th class="border border-gray-500 w-[25vw]">รายการอาหาร</th>
                <th class="border border-gray-500">ราคา</th>
                <th class="px-4 flex">
                    <label>ประเภท:</label>
                    <select name="menu_id" class="outline-none w-[100%]" type="submit" id="">
                        <option value="">All</option>
                        <?php while($r = $stmt_th->fetch(PDO::FETCH_ASSOC)){?>
                            <option value="<?= $r['menu_id'] ?>"><?= $r['menu_name'] ?></option>
                        <?php }?>
                    </select>
                </th>
                <th class="border border-gray-500 w-[4vw]">แก้ไข</th>
                <th class="border border-gray-500 w-[4vw]">ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php $stmt->execute(); while($result = $stmt->fetch(PDO::FETCH_ASSOC)){?>
                <tr class='border-b border-gray-500'>
                    <td class='px-4 py-2 flex gap-5 items-center border-r border-gray-500'>
                        <img src="./image/<?= $result['image']?>" class="w-[2vw] rounded-[5px] hover:scale-[2]" alt="">
                        <p><?= $result['food_name']?></p>
                    </td>
                    <td class='px-4 py-2 text-center'>
                        <p><?= $result['food_price']?>฿</p>
                    </td>
                    <td class='px-4 py-2 border border-gray-500'>
                        <p class="text-center"><?= $result['menu_name']?></p>
                    </td>
                    <td class='px-4 py-2 border border-gray-500'>
                        <a href="updateFoodForm.php?food_id=<?= $result['food_id'] ?>" class="flex justify-center items-center"><i class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                    <td class='px-4 py-2 border border-gray-500'>
                        <a href="DeleteFood.php?food_id=<?= $result['food_id'] ?>" class="flex justify-center items-center"><i class="fa-solid fa-trash-can"></i></i></a>
                    </td>
                </tr>
            <?php }?>
        </tbody>
    </table>
    </form>
    
    
</body>
</html>