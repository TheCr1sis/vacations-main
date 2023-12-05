<?php
// Include database connection file
include_once "dbh.inc.php";

class CompositeSearch {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function performCompositeSearch($searchTable, $searchField, $searchRating) {
        // Ensure the selected field is valid (add additional fields as needed)
        $validFields = ['password'];
        if (!in_array($searchField, $validFields)) {
            echo "Invalid search field";
            exit;
        }

        // Perform the composite search based on the selected field and rating
        $searchQuery = "SELECT u.username, u.password
                        FROM users u
                        JOIN contact_us cu ON u.username = cu.first_name
                        WHERE cu.rating = ?";

        $stmt = $this->pdo->prepare($searchQuery);
        $stmt->execute([$searchRating]);

        echo "<h2>Search Results</h2>";
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Username</th>";
        echo "<th>Password</th>";
        echo "</tr>";

        while ($rowData = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$rowData['username']}</td>";
            echo "<td>{$rowData['password']}</td>";
            echo "</tr>";
        }

        echo "</table>";
        $this->addBackButton();
    }

    private function addBackButton() {
        echo "<br>";
        echo "<button onclick=\"window.location.href='../pages/admin-page.php'\">Leave</button>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTable = $_POST['searchTable'];
    $searchField = $_POST['searchField'];
    $searchRating = $_POST['searchRating'];

    // Create an instance of the CompositeSearch class
    $compositeSearch = new CompositeSearch($pdo);
    $compositeSearch->performCompositeSearch($searchTable, $searchField, $searchRating);
}
?>