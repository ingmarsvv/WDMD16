<?php 
    session_start();
    include 'functions.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Cool website!</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen">
    <?php
        if(isset($_POST["type"]) && ($_POST["type"] == "newArticle")){
            insertArticles($_POST);
        }

        if(isset($_GET["delete"])){
            $id = $_GET["delete"];
            deleteArticle($id);
        }

        if (isset($_GET["edit"])){
            $article = editArticle($_GET);
        }
        
        if(isset($_POST["type"]) && !empty($_POST["id"]) && $_POST["type"] == "updateArticle"){
            updateArticle($_POST);
        }
    ?>

    <?php include 'header.php'; ?>
    <div class="flex flex-col gap-8 flex-grow">
        <?php 
            $result = getArticles(); ?>
            <div class="w-4/5 m-auto">
                <table class="table-fixed">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>URL</th>
                        </tr>
                    </thead>
                <?php while($row = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td class="border border-slate-300 p-1"><?= $row["id"]; ?></td>
                    <td class="border border-slate-300 p-1"><?= $row["title"]; ?></td>
                    <td class="border border-slate-300 p-1"><?= $row["body"]; ?></td>
                    <td class="border border-slate-300 p-1 max-w-28 break-words"><?= $row["image_url"]; ?></td>
                    <td class="border border-slate-300 p-1"><a href="?edit=<?= $row['id']?>"><button class="mx-auto block border border-black rounded-md w-1/5 min-w-min p-2 bg-lime-200">Edit</button></a></td>
                    <td class="border border-slate-300 p-1"><a href="?delete=<?= $row['id']?>"><button class="mx-auto block border border-black rounded-md w-1/5 min-w-min p-2 bg-lime-200">Delete</button></a></td>
                </tr>
                <?php } ?>
                </table>
            </div>
        
        <h3 class="text-lg text-center">MySQL edit</h3>
            <form class="mx-auto bg-slate-300 p-3 rounded"  action="./article.php" method="POST">
                <input type="hidden" name="type" value="updateArticle">
                <label for="id">ID</label>
                <input type="text" name="id" value="<?= $article['id'] ?? '' ?>">
                <label for="title">Title</label>
                <input type="text" name="title" value="<?= $article['title'] ?? '' ?>">
                <label for="image_url">URL</label>
                <input type="text" name="image_url" value="<?= $article['image_url'] ?? '' ?>">
                <label class="block" for="contents">Content</label>
                <textarea class="w-full h-96" name="contents" id=""><?= $article['body'] ?? '' ?></textarea>
                <input class="mx-auto block border border-black rounded-md w-1/5 min-w-min p-1 bg-lime-200" type="submit" value="Update">
            </form>


        <div class="w-3/5 max-w-xl mx-auto p-3 text-center text-lg rounded">
            Add your article to the database!
        </div>
            <form class="w-3/5 max-w-xl mx-auto bg-slate-300 p-3 rounded" action="./article.php" method="POST">
                <input type="hidden" name="type" value="newArticle">
                <label class="block" for="title">Title</label>
                <input class="border border-black mb-2 rounded-md w-1/2" type="text" name="title">
                <label class="block" for="body">Body</label>
                <textarea class="border border-black mb-2 rounded-md w-full h-16" type="text-area" name="body"></textarea>
                <label class="block" for="imageurl">Image url</label>
                <input class="border border-black mb-4 rounded-md w-1/2" type="text" name="imageurl">
                <input class="mx-auto block border border-black rounded-md w-1/5 min-w-min p-2 bg-lime-200" type="submit" value="Submit">
                <?php if(isset($_POST["type"]) && $_POST["type"] == "newArticle" && (!isset($_SESSION["name"]))){ ?>
                    <p class="text-red-600">You are not authorized to submit articles, please log in first! </p>
                <?php } ?>
            </form>
        </div>
    </div>
    <div class="mb-0 ml-0"><?php include 'footer.php'; ?></div>
</body>
<?php mysqli_close($db); ?>
</html>