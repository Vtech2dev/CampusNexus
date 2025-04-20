<?php
require "DataBase.php";
$db = new DataBase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required POST fields are set
    if (
        isset($_POST['table']) &&
        isset($_POST['fullname']) &&
        isset($_POST['email']) &&
        isset($_POST['phone_number']) &&
        isset($_POST['gender']) &&
        isset($_POST['dob']) &&
        isset($_POST['reg_no']) &&
        isset($_POST['enrollment_year']) &&
        isset($_POST['course_program']) &&
        isset($_POST['department']) &&
        isset($_POST['year_of_study']) &&
        isset($_POST['password'])
    ) {
        $table = $_POST['table']; // The table name provided by the user

        if ($db->dbConnect()) {
            // Attempt to sign up the user
            if (
                $db->signUp(
                    $table,
                    $_POST['fullname'],
                    $_POST['email'],
                    $_POST['phone_number'],
                    $_POST['gender'],
                    $_POST['dob'],
                    '', // Profile photo can be left empty for now
                    $_POST['reg_no'],
                    $_POST['enrollment_year'],
                    $_POST['course_program'],
                    $_POST['department'],
                    $_POST['year_of_study'],
                    $_POST['password'] // Password will be hashed in the signUp function
                )
            ) {
                echo "Sign Up Successful";
            } else {
                echo "Sign Up Failed";
            }
        } else {
            echo "Error: Database connection";
        }
    } else {
        echo "All fields are required";
    }
} else {
    // Form is not submitted yet, show the signup form
?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>
    <h2>Signup Form</h2>
    <form action="signup.php" method="post">
        <label for="table">Table Name:</label><br>
        <input type="text" id="table" name="table" required><br><br>

        <label for="fullname">Full Name:</label><br>
        <input type="text" id="fullname" name="fullname" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone_number">Phone Number:</label><br>
        <input type="text" id="phone_number" name="phone_number" required><br><br>

        <label for="gender">Gender:</label><br>
        <select id="gender" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br><br>

        <label for="dob">Date of Birth:</label><br>
        <input type="date" id="dob" name="dob" required><br><br>

        <label for="reg_no">Registration Number:</label><br>
        <input type="text" id="reg_no" name="reg_no" required><br><br>

        <label for="enrollment_year">Enrollment Year:</label><br>
        <input type="number" id="enrollment_year" name="enrollment_year" required><br><br>

        <label for="course_program">Course/Program:</label><br>
        <input type="text" id="course_program" name="course_program" required><br><br>

        <label for="department">Department:</label><br>
        <input type="text" id="department" name="department" required><br><br>

        <label for="year_of_study">Year of Study:</label><br>
        <input type="number" id="year_of_study" name="year_of_study" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Sign Up">
    </form>
</body>
</html>
<?php
}
?>
