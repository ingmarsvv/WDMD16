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

        $months = array("1" => "janvārī","2" => "februārī","3" => "martā","4" => "aprīlī","5" => "maijā","6" => "jūnijā",
        "7" => "jūlijā","8" => "augustā","9" => "septembrī","10" => "oktobrī","11" => "novembrī","12" => "decembrī",);
        print_r($_POST);
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





    <?php include 'footer.php'; ?>
</body>
</html>