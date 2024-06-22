<header class=" bg-slate-200 py-2 mb-4">
    <div class="flex flex-row justify-between mx-2">
        <div>
            <?php
                $pages = array("./home.php", "./about.php", "./article.php", "./loginpage.php" );
                $label = array("Home", "About", "Articles", "Login");
                for($i=0; $i < 4; $i++){ ?>
                    <a class="basis-1/6 bg-amber-100 px-2 rounded" href="<?=$pages[$i]?>"><?=$label[$i]?></a>
                <?php }
            ?>
        </div>

        <div>
            <?php
                $nameDays = include 'namedays.php';
                $month = date("n"); //mēneša kārtas skaitlis
                $day = date("j"); //date("j, n, Y"); //dienas kārtas skaitlis
                ?>
                <p>Vārda dienas svin: <?php foreach ($nameDays[$month][$day][0] as $name){
                    echo $name . " ";
                } ?> </p>
        </div>
        <?php
            if (isset($_SESSION['name']) && !empty($_SESSION['name'])){ ?>
            <div class="flex flex-row">
                <div class="mr-2 bg-amber-100 px-2 rounded"><?php print_r( "user: " . $_SESSION['name']) ?></div>   
                <form class="border border-black bg-amber-100 px-2 rounded" action="./home.php" method="post">
                    <input type="hidden" name="logout" value="true">
                    <input type="submit" value="Logout">
                </form>
            <?php } else {
                echo '<p class="bg-amber-100 px-2 rounded">Uknown user</p>';
            } ?>     
            </div>
    </div>
</header>