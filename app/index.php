<?php include('php_code.php'); ?>
<?php 
        if (isset($_GET['edit'])) {
                $id = $_GET['edit'];
                $update = true;
                $record = mysqli_query($db, "
                SELECT * FROM users WHERE id=$id");

                $n = mysqli_fetch_array($record);
                $name = $n['name'];
                $birthplace = $n['birthplace'];
                $birthdate = $n['birthdate'];
        }
?>
<!DOCTYPE html>
<html>
<head>
        <title>RTT beadandó</title>
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
        <?php if (isset($_SESSION['message'])): ?>
                <div class="msg">
                        <?php 
                                echo $_SESSION['message']; 
                                unset($_SESSION['message']);
                        ?>
                </div>
        <?php endif ?>
        <?php $results = mysqli_query($db, "
        SELECT * FROM users"); ?>

        <table>
                <thead>
                        <tr>
                                <th>Név</th>
                                <th>Születési hely</th>
                                <th>Születési idő</th>
                                <th colspan="2">Műveleti gombok</th>
                        </tr>
                </thead>
        
                <?php while ($row = mysqli_fetch_array($results)) { ?>
                        <tr>
                               <td>
                                      <?php echo $row['name']; ?>
                                </td>
                                <td>
                                       <?php echo $row['birthplace']; ?>
                                </td>
                                <td>
                                       <?php echo $row['birthdate']; ?>
                                </td>
                                <td>
                                        <a href="index.php?edit=<?php echo $row['id']; ?>" class="editButton" >Módosítás</a>
                                </td>
                                <td>
                                        <a href="php_code.php?del=<?php echo $row['id']; ?>" class="deleteButton">Törlés</a>
                               </td>
                        </tr>
                <?php } ?>
        </table>

                <form method="post" action="php_code.php" >
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="inputGroup">
                                <label>Név:</label>
                                <input type="text" name="name" value="<?php echo $name; ?>">
                        </div>
                        <div class="inputGroup">
                                <label>Születési hely:</label>
                                <input type="text" name="birthplace" value="<?php echo $birthplace; ?>">
                        </div>
                        <div class="inputGroup">
                                <label>Születési dátum:</label>
                                <input type="text" name="birthdate" value="<?php echo $birthdate; ?>">
                        </div>
                        <div class="inputGroup">
                                <?php if ($update == true): ?>
                                <button class="button" type="submit" name="update" >Frissítés</button>
                                <?php else: ?>
                                <button class="button" type="submit" name="save" >Mentés</button>
                                <?php endif ?>
                        </div>
                </form>
</body>
</html>