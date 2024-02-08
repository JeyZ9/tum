
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
    require 'Connect.php';
if(isset($_GET['food_id'])){
    $sqlse = 'SELECT * FROM food WHERE food_id = ?';
    $stmt_se = $conn->prepare($sqlse);
    // $stmt_se->bindParam(":food_id",$_GET["food_id"]);
    $stmt_se->execute([$_GET['food_id']]);
    $r = $stmt_se->fetch(PDO::FETCH_ASSOC);
}
    
    
    $sqlses = 'SELECT * FROM menu';
    $stmt_s = $conn->prepare($sqlses);
    $stmt_s->execute();
    ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="Style.css"/>

    <title>Document</title>
</head>
<body>
    <form action="UpdateFood.php" method="POST" class="flex flex-col items-center h-screen justify-center">
    <!-- <form action="Index.php" method="post" > -->
        <input type="hidden" name="food_id" value=<?= $r['food_id']?> />
        <div class="flex flex-col items-center justify-center gap-4">
            <h1 class="text-[2rem] font-semibold">EDIT FOOD</h1>
            <div class="flex flex-col w-[20vw]">
                <label for="">NAME</label>
                <input type="text" value="<?= $r['food_name'] ?>" required name="food_name" class="border border-gray-500 outline-none">
        </div>
        <div class="flex flex-col w-[20vw]">
            <label for="">PRICE</label>
            <input type="number" value="<?= $r['food_price'] ?>" required name="food_price" class="border border-gray-500 outline-none">
        </div>
        <div class="flex flex-col w-[20vw]">
            <label for="">MENU NAME</label>
            <select name="menu_id" id="" class="border border-gray-500 outline-none">
                <?php while($result = $stmt_s->fetch(PDO::FETCH_ASSOC)){?>
                    <option value="<?= $result["menu_id"]?>"><?= $result['menu_name'] ?></option>
                    <?php }?>
                </select>
            </div>
        </form>
        <div class="">
            <button type="submit" name="submit" class="bg-orange-500 text-white w-[20vw]">submit</button>
        </div>
    </div>
</body>
</html>