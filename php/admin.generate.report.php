<?php
// Include database connection file
include_once "dbh.inc.php";

class AdminGenerateReport
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function generateReport()
    {
        $query = "SELECT id, username, email, password, date_and_time FROM users";
        $stmt = $this->pdo->query($query);

        $csvFileName = 'users_report.csv';

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $csvFileName . '"');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['ID', 'Username', 'Email', 'Password', 'Registration Date']);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($output, [$row['id'], $row['username'], $row['email'], $row['password'], $row['date_and_time']]);
        }

        fclose($output);
    }
}

$adminGenerateReport = new AdminGenerateReport($pdo);
$adminGenerateReport->generateReport();
?>