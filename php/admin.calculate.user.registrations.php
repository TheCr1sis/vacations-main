<?php
// Include database connection file
include_once "dbh.inc.php";

class UserRegistrationsCalculator {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function calculateUserRegistrations($startDate, $endDate) {
        $calculationQuery = "SELECT COUNT(*) as userCount
                             FROM users
                             WHERE date_and_time BETWEEN :startDate AND :endDate";

        $stmt = $this->pdo->prepare($calculationQuery);
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "<h2>User Registrations between $startDate and $endDate:</h2>";
        echo "<p>Total Users Registered: {$result['userCount']}</p>";
        $this->addBackButton();
    }

    private function addBackButton() {
        echo "<br>";
        echo "<button onclick=\"window.location.href='../pages/admin-page.php'\">Leave</button>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // Create an instance of the UserRegistrationsCalculator class
    $calculator = new UserRegistrationsCalculator($pdo);
    $calculator->calculateUserRegistrations($startDate, $endDate);
}
?>