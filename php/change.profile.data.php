<?php

session_start();

// Include your database connection file
include_once "dbh.inc.php";

class ChangeProfileData
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function processProfileChange()
    {
        // Check if the user is logged in
        if (!isset($_SESSION['username'])) {
            header('Location: ../index.php');
            exit();
        }

        // Retrieve the current username
        $currentUsername = $_SESSION['username'];

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Sanitize and validate the new values from the form
            $newUsername = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $newEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $newPassword = $_POST['password'];
            $passwordConfirm = $_POST['password_confirm'];

            // Check if the new username already exists
            $usernameExists = $this->checkUsernameExists($newUsername);

            // Check if the passwords match
            if ($newPassword !== $passwordConfirm) {
                $this->redirectWithAlert("Passwords do not match!", "../pages/register-signin-page.php");
            } elseif ($usernameExists) {
                $this->redirectWithAlert("This username is unavailable!", "../pages/register-signin-page.php");
            } else {
                // Build the SQL query dynamically based on the fields that the user wants to update
                $updateUserQuery = "UPDATE users SET";
                $updateParams = [];
                $updateSet = [];

                if (!empty($newUsername)) {
                    $updateSet[] = " username = ?";
                    $updateParams[] = $newUsername;
                }

                if (!empty($newEmail)) {
                    $updateSet[] = " email = ?";
                    $updateParams[] = $newEmail;
                }

                if (!empty($newPassword)) {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $updateSet[] = " password = ?";
                    $updateParams[] = $hashedPassword;
                }

                // Combine the SET clauses
                $updateUserQuery .= implode(', ', $updateSet);

                // Add the WHERE clause
                $updateUserQuery .= " WHERE username = ?";
                $updateParams[] = $currentUsername;

                // Prepare and execute the query
                $stmtUpdateUser = $this->pdo->prepare($updateUserQuery);

                if ($stmtUpdateUser->execute($updateParams)) {
                    // If the username was updated, update the session with the new username
                    if (!empty($newUsername)) {
                        $_SESSION['username'] = $newUsername;
                    }

                    // Redirect to the profile page or another appropriate page
                    $this->redirect("Location: ../pages/register-signin-page.php");
                } else {
                    // Handle the update error
                    echo "Error updating user information: " . implode(", ", $stmtUpdateUser->errorInfo());
                }
            }
        }
    }

    private function checkUsernameExists($username)
    {
        $checkUsernameQuery = "SELECT COUNT(*) FROM users WHERE username = ?";
        $stmtCheckUsername = $this->pdo->prepare($checkUsernameQuery);
        $stmtCheckUsername->execute([$username]);

        return $stmtCheckUsername->fetchColumn() > 0;
    }

    private function redirectWithAlert($message, $location)
    {
        echo '<script>
                alert("' . $message . '");
                window.location.href = "' . $location . '";
              </script>';
        exit();
    }

    private function redirect($location)
    {
        header($location);
        exit();
    }
}

// Create an instance of ChangeProfileData
$changeProfileData = new ChangeProfileData($pdo);

// Process profile change
$changeProfileData->processProfileChange();
?>