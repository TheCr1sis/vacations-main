<?php
session_start();

class VacationDataHandler
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getVacationData($id)
    {
        try {
            // Prepare and execute a query to fetch vacation data based on the ID
            $getVacationQuery = "SELECT * FROM vacation_plans WHERE vacation_id = ?";
            $stmt = $this->pdo->prepare($getVacationQuery);
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                // Fetch the data as an associative array
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return array(); // Return an empty array if no data found
            }
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        require_once "dbh.inc.php"; // Include your database connection
        $vacationDataHandler = new VacationDataHandler($pdo);

        // Get vacation data
        $data = $vacationDataHandler->getVacationData($id);

        echo json_encode($data); // Return the data as JSON
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
} else {
    // Handle cases where ID is not provided or method is not GET
    echo json_encode(array()); // Return an empty array or handle accordingly
}
?>