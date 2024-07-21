<?php 
        session_start();
        $db = mysqli_connect('mysql', 'webdb', 'webdb', 'webdb');

        $name = "";
        $birthplace = "";
        $dateValue = "";
        $birthdate = new DateTime($dateValue);
        //$id = 0;
        $update = false;

        $result = mysqli_query($db, "
          CREATE TABLE IF NOT EXISTS users (
            id int AUTO_INCREMENT PRIMARY KEY,
            name varchar(64),
            birthplace varchar(64),
            birthdate date
          )");
        
        if ( ! $result )
                die ("Hiba lépett fel a készítéskor.");


        if (isset($_POST['save'])) {
                $name = $_POST['name'];
                $birthplace = $_POST['birthplace'];
                $birthdate = $_POST['birthdate'];

                mysqli_query($db, "
                INSERT INTO users (name, birthplace, birthdate) VALUES ('$name', '$birthplace', '$birthdate')"); 
                $_SESSION['message'] = "User created"; 
                header('location: index.php');
        }

        if (isset($_POST['update'])) {
                //$id = $_POST['id'];
                $id = $_GET['id'];
                $name = $_POST['name'];
                $birthplace = $_POST['birthplace'];
                $birthdate = $_POST['birthdate'];
        
                mysqli_query($db, "
                UPDATE users SET name='$name', birthplace='$birthplace', birthdate='$birthdate' WHERE id=$id");
                $_SESSION['message'] = "User updated"; 
                header('location: index.php');
        }

        if (isset($_GET['del'])) {
                $id = $_GET['del'];
                mysqli_query($db, "
                DELETE FROM users WHERE id=$id");
                $_SESSION['message'] = "User deleted"; 
                header('location: index.php');
        }

?>