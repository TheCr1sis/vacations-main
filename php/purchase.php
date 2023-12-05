<?php
session_start();

class PurchaseHandler
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function handlePurchase($name, $surname, $email, $cardNumber, $cvv, $expiryDate, $dateTime, $vacationId, $userId)
    {
        // Encryption key
        $encryptionKey = '8ac73b06ed9e965e908c359ed6824a6b36896956cce2cadfcf7327fa7703c0e5';

        // Encryption method
        $encryptionMethod = 'aes-256-cbc';
        $ivLength = openssl_cipher_iv_length($encryptionMethod);
        $iv = openssl_random_pseudo_bytes($ivLength);

        // Encrypt sensitive information
        $encryptedCardNumber = openssl_encrypt($cardNumber, $encryptionMethod, $encryptionKey, 0, $iv);
        $encryptedCVV = openssl_encrypt($cvv, $encryptionMethod, $encryptionKey, 0, $iv);
        $encryptedExpiryDate = openssl_encrypt($expiryDate, $encryptionMethod, $encryptionKey, 0, $iv);

        try {
            // Prepare SQL query to insert data
            $sql = "INSERT INTO purchases (user_id, vacation_id, name, surname, email, card_number, cvv, expiry_date, date_time)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $this->pdo->prepare($sql);

            // Bind parameters with encrypted values
            $stmt->execute([$userId, $vacationId, $name, $surname, $email, $encryptedCardNumber, $encryptedCVV, $encryptedExpiryDate, $dateTime]);

            return true;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }

        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $cardNumber = preg_replace('/\s+/', '', filter_input(INPUT_POST, 'card_number', FILTER_SANITIZE_NUMBER_INT));
    $cvv = filter_input(INPUT_POST, 'cvv', FILTER_SANITIZE_NUMBER_INT);
    $expiryDate = filter_input(INPUT_POST, 'expiry_date', FILTER_SANITIZE_STRING);
    $dateTime = filter_input(INPUT_POST, 'date_time', FILTER_SANITIZE_STRING);
    $vacationId = filter_input(INPUT_POST, 'vacation_id', FILTER_VALIDATE_INT);

    $userId = $_SESSION['user_id'];

    require_once "dbh.inc.php";
    $purchaseHandler = new PurchaseHandler($pdo);

    if ($purchaseHandler->handlePurchase($name, $surname, $email, $cardNumber, $cvv, $expiryDate, $dateTime, $vacationId, $userId)) {
        echo '<script>
                alert("Thank you for the purchase!");
                window.location.href = "../pages/places-page.php";
              </script>';
        die();
    } else {
        echo '<script>
                alert("Failed to process the purchase. Please try again later.");
                window.location.href = "../pages/places-page.php";
              </script>';
        die();
    }
}
?>