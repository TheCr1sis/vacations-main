<?php
// Include database connection file
include_once "dbh.inc.php";

class AdminDelete
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function deleteUser()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tableName = "users";
            $id = (int)$_POST['id'];

            if ($this->checkUserExists($tableName, $id)) {
                $deleteQuery = "DELETE FROM $tableName WHERE id = ?";
                $stmt = $this->pdo->prepare($deleteQuery);

                if ($stmt->execute([$id])) {
                    echo '<script>alert("User deleted successfully!");</script>';
                } else {
                    echo '<script>alert("Error deleting user. ' . $stmt->errorInfo()[2] . '");</script>';
                }
            } else {
                echo '<script>
                        alert("User not found. Please enter a valid user ID.");
                        window.location.href = "../pages/admin-page.php";
                    </script>';
            }

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

$adminDelete = new AdminDelete($pdo);
$adminDelete->deleteUser();
?>
