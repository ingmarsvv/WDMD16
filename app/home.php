<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Vārda diena</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php 
        if (isset($_POST["logout"]) &&  $_POST["logout"] == 'true'){
            session_unset();
            session_destroy();
        }

// Vārda dienu meklētājs
        $months = array("1" => "janvārī","2" => "februārī","3" => "martā","4" => "aprīlī","5" => "maijā","6" => "jūnijā",
        "7" => "jūlijā","8" => "augustā","9" => "septembrī","10" => "oktobrī","11" => "novembrī","12" => "decembrī",);
        $searchName = !empty($_POST["nameday"]) ? $_POST["nameday"] : "";
        $isFound = false;
        $dayNr = $monthName = $listName = "";
        if (isset($_POST["nameday"])){
            $nameDays = file_exists('namedays.php') ? include 'namedays.php' : [];
            foreach ($nameDays as $monthNr => $month){
                foreach( $month as $dayDate => $day){
                    foreach($day as $listIndex => $list){
                        foreach($list as $value){
                            if ( strcasecmp($searchName, $value) == 0){
                                foreach ($months as $month => $name){
                                    if ($monthNr == $month){
                                        $monthName = $name;
                                    } 
                                }
                                if ($listIndex == "0"){
                                    $listName = "tradicionālajā";
                                } else {
                                    $listName = "paplašinātajā";
                                }
                                $dayNr = $dayDate;
                                $isFound = true;
                                break;
                            } 
                        }
                    }
                }
            }
        }

        include 'header.php';
    ?>
    <div class="flex flex=col">
        <form action="./home.php" method="post" class="flex flex-col justify-center max-w-80 m-auto">
            <label for="name">Meklē vārda dienu</label>
            <input class="border border-black mb-2 rounded-md" type="text" name="nameday">
            <input class="border border-black rounded-md p-1 bg-lime-200" type="submit" value="Search">
        </form>
    </div>
    <div class="flex max-w-80 m-auto my-4">
        <?php if ( isset($_POST["nameday"]) && $isFound == true){
            echo $searchName . " savu vārda dienu svin " . $dayNr . ". " . $monthName . ". Vārds atrodas " . $listName . " sarakstā."; 
           } else if (isset(($_POST["nameday"])) && !empty(($_POST["nameday"]))) {
            echo $searchName . " savu vārda dienu svin 22. maijā ";
           }   ?>
    </div>


<!-- Kalendārs -->
    <div>
        <div class="text-center"><p class="font-bold text-3xl mt-1">June</p></div>
        <table class="m-auto border border-separate border-slate-400 border-spacing-2 w-4/6">
            <tr>
                <th class="border border-slate-400 p-1 w-64">Monday</th>
                <th class="border border-slate-400 p-1 w-64">Tuesday</th>
                <th class="border border-slate-400 p-1 w-64">Wednesday</th>
                <th class="border border-slate-400 p-1 w-64">Thursday</th>
                <th class="border border-slate-400 p-1 w-64">Friday</th>
                <th class="border border-slate-400 p-1 w-64">Saturday</th>
                <th class="border border-slate-400 p-1 w-64">Sunday</th>
            </tr>
            <?php 
                $dayNr = 1;
                for ($i=0; $i<5; $i++){ ?>
                <tr>
                    <?php for ($j=0; $j<7; $j++){ ?>
                        <td class="border border-slate-400 p-1 w-64">
                            <?php if ($i < 1 && $j < 5){
                            } else { ?>
                                 <p class="font-semibold text-center text-xl mt-1"><?= $dayNr ?></p>
                                 <?php foreach ($nameDays[6][$dayNr][0] as $name){ ?>
                                    <p class="text-center"><?= $name ?></p>
                                 <?php }
                                 $dayNr++;
                            }
                            ?>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>