<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Cool website!</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php
    $db = mysqli_connect('db', 'user', 'secret', 'rcs16-db');
    $result = mysqli_query($db,'SELECT * FROM `articles`');
    //mysqli_query($db, "INSERT INTO `articles` (`title`, `image_url`, `body`) VALUES ('Generated article', '', '" .date('d.m.Y H:i:s'). "')");
    mysqli_close($db);
    //var_dump($obj);
?>
    <?php include 'header.php'; ?>
    <div class="flex flex-row gap-x-2 mt-10">
        <div class="flex flex-col basis-1/2">
            <img class="mb-6" src="./images/constr1.jpg" alt="">
            <img class="mb-6" src="./images/constr2.avif" alt="">
            <img class="mb-6" src="./images/constr3.jpeg" alt="">
        </div>
        <div class="flex flex-col basis-1/2">
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
            <p class="mb-14"><?= $row['body'] ?></p>     
        <?php } ?>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>