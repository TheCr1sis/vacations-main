<?php

class UserRegistration
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function registerUser($username, $email, $password, $confirmPassword)
    {
        try {
            $checkUserQuery = "SELECT * FROM users WHERE username = ?";
            $stmtCheckUser = $this->pdo->prepare($checkUserQuery);
            $stmtCheckUser->execute([$username]);

            if ($stmtCheckUser->rowCount() > 0) {
                // User with the same username already exists
                return "This username is already taken!";
            } else {
                if ($password !== $confirmPassword) {
                    return "Passwords do not match!";
                } else {
                    // hash password
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    // Insert user into the database
                    $insertUserQuery = "INSERT INTO users (username, email, password) VALUES (?, ?, ?);";
                    $stmtInsertUser = $this->pdo->prepare($insertUserQuery);
                    $stmtInsertUser->execute([$username, $email, $hashedPassword]);

                    // Get the user ID of the newly inserted user
                    $newUserId = $this->pdo->lastInsertId();

                    // Store user information in the session
                    session_start();
                    $_SESSION['user_id'] = $newUserId;
                    $_SESSION['username'] = $username;

                    // Redirect to the home page
                    header("Location: ../index.php");
                    die();
                }
            }
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }

        return null;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        require_once "dbh.inc.php";

        $userRegistration = new UserRegistration($pdo);

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $confirmPassword = $_POST['password_confirm'];

        $registrationError = $userRegistration->registerUser($username, $email, $password, $confirmPassword);

        if ($registrationError !== null) {
            header("Location: ../pages/register-signin-page.php?registration_error=$registrationError");
            die();
        }
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}
?>