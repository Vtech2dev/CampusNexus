<?php
require "DataBase.php";
$db = new DataBase();

if (
    isset($_POST['fullname']) &&
    isset($_POST['email']) &&
    isset($_POST['phone_number']) &&
    isset($_POST['gender']) &&
    isset($_POST['dob']) &&
    isset($_POST['profile_photo']) &&
    isset($_POST['reg_no']) &&
    isset($_POST['enrollment_year']) &&
    isset($_POST['course_program']) &&
    isset($_POST['department']) &&
    isset($_POST['year_of_study']) &&
    isset($_POST['password'])
) {
    if ($db->dbConnect()) {
        if (
            $db->signUp(
                "CollegeStudents",
                $_POST['fullname'],
                $_POST['email'],
                $_POST['phone_number'],
                $_POST['gender'],
                $_POST['dob'],
                $_POST['profile_photo'],
                $_POST['reg_no'],
                $_POST['enrollment_year'],
                $_POST['course_program'],
                $_POST['department'],
                $_POST['year_of_study'],
                $_POST['password']
            )
        ) {
            echo "Sign Up Success";
        } else {
            echo "Sign up Failed";
        }
    } else {
        echo "Error: Database connection";
    }
} else {
    echo "All fields are required";
}
?>
