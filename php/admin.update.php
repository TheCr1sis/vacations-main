<?php
// Include database connection file
include_once "dbh.inc.php";

class AdminUpdate
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function updateUser()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tableName = "users";
            $id = (int)$_POST['id'];
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            if ($this->checkUserExists($tableName, $id)) {
                $updateQuery = "UPDATE $tableName SET ";
                $updateValues = [];

                if (!empty($username)) {
                    $updateQuery .= "username = ?, ";
                    $updateValues[] = $username;
                }

                if (!empty($email)) {
                    $updateQuery .= "email = ?, ";
                    $updateValues[] = $email;
                }

                if (!empty($password)) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $updateQuery .= "password = ?, ";
                    $updateValues[] = $hashedPassword;
                }

                $updateQuery = rtrim($updateQuery, ', ');
                $updateQuery .= " WHERE id = ?";
                $updateValues[] = $id;

                $stmt = $this->pdo->prepare($updateQuery);

                if ($stmt->execute($updateValues)) {
                    echo '<script>alert("User updated successfully!");</script>';
                } else {
                    echo '<script>alert("Error updating user. ' . $stmt->errorInfo()[2] . '");</script>';
                }
            } else {
                echo '<script>
                        alert("User not found. Please enter a valid user ID.");
                        window.location.href = "../pages/admin-page.php";
                    </script>';
            }

            // Redirect back to the admin page
            echo '<script>window.location.href = "../pages/admin-page.php";</script>';
            exit();
        }
    }

    private function checkUserExists($tableName, $id)
    {
        $checkUserQuery = "SELECT * FROM $tableName WHERE id = ?";
        $checkUserStmt = $this->pdo->prepare($checkUserQuery);
        $checkUserStmt->execute([$id]);

        return $checkUserStmt->rowCount() > 0;
    }
}

// Create an instance of AdminUpdate
$adminUpdate = new AdminUpdate($pdo);

// Process user update
$adminUpdate->updateUser();
?>