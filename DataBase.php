<?php

require "dbconfig.php";

class DataBase
{
    private $connect;
    private $sql;
    private $servername;
    private $username;
    private $password;
    private $databasename;

    public function __construct()
    {
        $this->connect = null;
        $this->sql = null;

        $dbc = new DataBaseConfig();
        $this->servername = $dbc->servername;
        $this->username = $dbc->username;
        $this->password = $dbc->password;
        $this->databasename = $dbc->databasename;

        // Automatically connect when the class is instantiated
        $this->dbConnect();
    }

    // Establish a database connection
    private function dbConnect()
    {
        $this->connect = new mysqli($this->servername, $this->username, $this->password, $this->databasename);

        if ($this->connect->connect_error) {
            die("Database connection failed: " . $this->connect->connect_error);
        }
    }

    // Sanitize user input
    private function prepareData($data)
    {
        return $this->connect->real_escape_string(trim($data));
    }

    // Log in user with prepared statements
    public function logIn($table, $username, $password)
    {
        $username = $this->prepareData($username);

        $stmt = $this->connect->prepare("SELECT * FROM $table WHERE username = ?");
        $stmt->bind_param("s", $username);

        if (!$stmt->execute()) {
            return false; // Query execution failed
        }

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $dbPassword = $row['password'];

            if (password_verify($password, $dbPassword)) {
                return true; // Login successful
            }
        }

        return false; // Login failed
    }

    // Sign up user with prepared statements
    public function signUp($table, $fullname, $email, $username, $password)
    {
        $fullname = $this->prepareData($fullname);
        $email = $this->prepareData($email);
        $username = $this->prepareData($username);
        $password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

        $stmt = $this->connect->prepare("INSERT INTO $table (fullname, email, username, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullname, $email, $username, $password);

        if ($stmt->execute()) {
            return true; // Sign up successful
        } else {
            return false; // Sign up failed
        }
    }

    // Execute custom SQL queries
    public function executeQuery($query)
    {
        $result = $this->connect->query($query);
        if ($result === false) {
            die("Query failed: " . $this->connect->error);
        }

        return $result;
    }

    // Destructor to close the database connection
    public function __destruct()
    {
        if ($this->connect) {
            $this->connect->close();
        }
    }
}

?>
