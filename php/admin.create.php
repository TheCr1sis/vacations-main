<?php
// Include database connection file
include_once "dbh.inc.php";

class AdminCreate
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createUser()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tableName = "users";
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            if ($this->checkUsernameExists($tableName, $username)) {
                echo '<script>
                        alert("Username already exists. Please choose a different username.");
                        window.location.href = "../pages/admin-page.php";
                    </script>';
                exit();
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insertQuery = "INSERT INTO $tableName (username, email, password) VALUES (?, ?, ?)";
            $stmt = $this->pdo->prepare($insertQuery);

            if ($stmt->execute([$username, $email, $hashedPassword])) {
                echo '<script>alert("User added successfully!");</script>';
            } else {
                echo "Error: " . $stmt->errorInfo()[2];
            }

            echo '<script>window.location.href = "../pages/admin-page.php";</script>';
            exit();
        }
    }

    private function checkUsernameExists($tableName, $username)
    {
        $checkUsernameQuery = "SELECT * FROM $tableName WHERE username = ?";
        $checkUsernameStmt = $this->pdo->prepare($checkUsernameQuery);
        $checkUsernameStmt->execute([$username]);

        return $checkUsernameStmt->rowCount() > 0;
    }
}

$adminCreate = new AdminCreate($pdo);
$adminCreate->createUser();
?>