<?php 
    require_once "pdo.php";

    $stmt = $pdo->query("SELECT auto_id,make,year,mileage FROM autos");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <div class="jumbotron nocenter">
        <table class="table">
            <thead>
                <tr>
                    <th>Auto Id</th>
                    <th>Make</th>
                    <th>Year</th>
                    <th>Mileage</th>
                </tr>
            </thead>
            <tbody class="table-hover">
                
                    <?php 
                        foreach($rows as $row){
                            echo('<tr><th scope="row">'.$row['auto_id'].'</th>');
                            echo('<td>'.$row['make'].'</td>');
                            echo('<td>'.$row['year'].'</td>');
                            echo('<td>'.$row['mileage'].'</td></tr>');
                        }
                    ?>
                
            </tbody>
        </table>
 
    <a ui-sref="database.add"><input type="submit" class="btn btn-primary btn-lg" value="Add to the database"></a>
    </div>
</div>