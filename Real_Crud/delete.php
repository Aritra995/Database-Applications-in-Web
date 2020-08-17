<?php
    session_start();
    require_once "pdo.php";

    if( !isset($_SESSION['name']) ){
        die('ACCESS DENIED');
    }

    if( isset($_POST['delete']) && isset($_POST['autos_id'])){
        $sql = "DELETE FROM auto WHERE autos_id = :zip";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':zip' => $_POST['autos_id']
        ));
        $_SESSION['success'] = 'Record Deleted';
        header('Location: index.php');
        return;
    }


    if( !isset($_GET['autos_id']) ){
        $_SESSION['error'] = 'Missing Automobile data';
        header('Location: index.php');
        return;
    }

    $sql = "SELECT make,autos_id FROM auto where autos_id = :xyz";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':xyz' => $_GET['autos_id']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if( $row === false ){
        $_SESSION['error'] = 'Bad value of Autos Id';
        header('Location: index.php');
        return;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aritra Kumar DattaChaudhury's App</title>
    <?php require_once "bootstrap.php";  ?>
</head>
<body>
<nav class="navbar navbar-primary bg-primary">
  <!-- Navbar content -->
  <h1>Welcome to Autos Database</h1>

</nav>
    <div class="container">
        
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Confirm <strong>Deleting</strong>!</h4>
            <p> <?php echo ($row['make'] ); ?> </p>
            <hr>
            <p class="mb-0">Data once deleted cannot be retrieved.</p>
        </div>
        
        <form action="" method="post">
            <input type="hidden" name="autos_id" value=" <?php echo htmlentities( htmlentities($row['autos_id']));  ?>  ">
            <input type="submit" value="Delete" class="btn btn-lg btn-outline-danger my-2 my-sm-0" name="delete">
            <a href="index.php" class="btn btn-lg btn-outline-secondary my-2 my-sm-0">Cancel</a>
        </form>
    </div>

</body>
</html>