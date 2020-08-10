<?php
    require_once "pdo.php";
    $failure = false;
    $success = false;

?>

<div class="container">
    <div class="jumbotron nocenter">
        <form action="" method="post">
            <?php 
                if($failure !== false){
                    echo('<p class="text-danger">'.htmlentities($failure).'</p>');
                }
                if($success !== false){
                    echo('<p class="text-success">'.htmlentities($success).'</p>');
                }
            ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Make *</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="make" name="make">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Year *</label>
                <input type="number" class="form-control" id="exampleInputEmail1" placeholder="year" name="year">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mileage *</label>
                <input type="number" class="form-control" id="exampleInputEmail1" placeholder="mileage" name="mileage">
            </div>
            <input type="submit" class="btn btn-success btn-lg" value="Add" name="add">
            <input type="submit" class="btn btn-danger btn-lg" value="Logout" name="logout">
            <a ui-sref="database.show"><input type="submit" class="btn btn-primary btn-lg" value="Show Database"></a>
        </form>
    </div>
</div>