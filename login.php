<?php
require "DataBase.php";
$db = new DataBase();

if (isset($_POST['identifier']) && isset($_POST['password'])) {
    if ($db->dbConnect()) {
        // Attempt login with email or registration number as the identifier
        if ($db->logIn("Students", $_POST['identifier'], $_POST['password'])) {
            echo "Login Success";
        } else {
            echo "Email/Reg No or Password is incorrect";
        }
    } else {
        echo "Error: Database connection";
    }
} else {
    echo "All fields are required";
}
?>
