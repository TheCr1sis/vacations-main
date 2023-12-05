<?php
session_start();

class LoginHandler
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function attemptLogin($username, $password)
    {
        try {
            // Check if the user with the provided username exists
            $checkUserQuery = "SELECT * FROM users WHERE username = ?";
            $stmtCheckUser = $this->pdo->prepare($checkUserQuery);
            $stmtCheckUser->execute([$username]);

            if ($stmtCheckUser->rowCount() > 0) {
                // User with the provided username exists
                $user = $stmtCheckUser->fetch(PDO::FETCH_ASSOC);

                // Verify the password
                if (password_verify($password, $user['password'])) {
                    // Password is correct, establish the session and redirect
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];

                    return true;
                } else {
                    // Password is incorrect
                    return false;
                }
            } else {
                // User with the provided username does not exist
                return false;
            }
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }

        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate user input
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];

    require_once "dbh.inc.php";
    $loginHandler = new LoginHandler($pdo);

    if ($loginHandler->attemptLogin($username, $password)) {
        // Login successful, redirect to the home page
        header("Location: ../index.php");
        die();
    } else {
        // Login failed, redirect with error messages
        $usernameError = "User with that username doesn't exist!";
        $passwordError = "Incorrect password!";
        header("Location: ../pages/register-signin-page.php?username_error=$usernameError&password_error=$passwordError");
        die();
    }
} else {
    // Redirect if the form is not submitted
    header("Location: ../index.php");
}
?>