<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

class ContactFormSubmit
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function processFormSubmission()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
            $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $agree_to_receive = isset($_POST['agreeToReceive']) ? 1 : 0;
            $agree_to_store = isset($_POST['agreeToStore']) ? 1 : 0;
            $rating = isset($_POST['rating']) ? $_POST['rating'] : null;
            $usefulness_rating = isset($_POST['usefulness']) ? $_POST['usefulness'] : null;
            $fileContent = '';

            if (!empty($_FILES['uploadedFile']['name'])) {
                // Read content from the file
                $fileContent = file_get_contents($_FILES['uploadedFile']['tmp_name']);
                // Sanitize and limit the content to 1000 characters
                $fileContent = substr(filter_var($fileContent, FILTER_SANITIZE_FULL_SPECIAL_CHARS), 0, 1000);
            }

            // Insert data into the database
            $insertUserQuery = "INSERT INTO contact_us (first_name, last_name, email, agree_to_receive, agree_to_store, rating, usefulness_rating, text_input, file_input) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $stmtInsertUser = $this->pdo->prepare($insertUserQuery);

            if ($stmtInsertUser->execute([$first_name, $last_name, $email, $agree_to_receive, $agree_to_store, $rating, $usefulness_rating, $fileContent, $fileContent])) {
                echo '<script>
                        alert("Submission successful!");
                        window.location.href = "../pages/form-page.php";
                    </script>';
            } else {
                echo "Error: " . $stmtInsertUser->errorInfo()[2];
            }
        } else {
            header("Location: ../index.php");
            die();
        }
    }
}

// Include your database connection file
require_once "dbh.inc.php";

// Create an instance of ContactFormSubmit
$contactFormSubmit = new ContactFormSubmit($pdo);

// Process form submission
$contactFormSubmit->processFormSubmission();
?>