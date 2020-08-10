<?php
    require_once "pdo.php";

    $failure = false;
    $success = false;

    if( !isset($_GET['name'])){
        die("Name parameter missing");
    }elseif( isset($_POST['logout']) && $_POST['logout'] == 'Logout'){
        header("Location: index.php");
    }elseif( isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']) ){
        $failure = false;
        $success = false;

        if(!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])){
            $failure = 'year and mileage must be numeric';
        }elseif(strlen($_POST['make']) <1){
            $failure = 'Make is required!';
        }else{
            $sql = "INSERT INTO autos (make,year,mileage)
                    VALUES (:make,:year,:mileage)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':make' => $_POST['make'],
                ':year' => $_POST['year'],
                ':mileage' => $_POST['mileage']
            ));
            $success = 'Record Inserted!';
        }
    }
?>

<!DOCTYPE html>
<html lang="en" ng-app="DatabaseApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aritra's Database</title>
    <?php require_once "bootstrap.php"  ?>
    <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="autos.css">
    <script src="angular/angular.min.js"></script>
    <script src="angular/angular-ui-router.min.js"></script>
    <script src="app.js"></script>
</head>
<body>
    <nav class="navbar noopa">
        <div class="container-fluid">
            <div class="navbar-header">

            </div>
        </div>
    </nav>
    <div class="container ">
        <div class="jumbotron nocenter">
            <h1 class="text-center">Tracking data </h1>
            <h1 class="text-center">for  </h1>
            <h1 class="text-center"> <?php  echo($_GET['name']); ?></h1>
        </div>
    </div>
    <!-- uiview -->
    <ui-view></ui-view>

    
</body>
</html>