<?php
session_start();
include_once "../php/dbh.inc.php";

// Existing session check
if (isset($_SESSION['username'])) {
    $loggedIn = true;
    $username = $_SESSION['username'];
    $isAdmin = ($_SESSION['username'] === 'admin'); // Check if the username is 'admin'
} else {
    $loggedIn = false;
    $isAdmin = false;
}

// Process login/logout actions if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {

        // Check if the logged-in user is 'admin'
        $_SESSION['username'] = $_POST['username'];
        $isAdmin = ($_POST['username'] === 'admin');
        $loggedIn = true;
        $username = $_SESSION['username'];
    } elseif (isset($_POST['logout'])) {
        // Perform logout actions
        unset($_SESSION['username']);
        $loggedIn = false;
        $isAdmin = false;
    }
}

$pageTitle = "Login";
if ($loggedIn) {
    $pageTitle = $isAdmin ? "Admin Account" : "User Account";
}

$userId = $_SESSION['user_id']; // Assuming 'user_id' is the ID in the 'users' table
$sql = "SELECT p.*, v.* FROM purchases p
        JOIN vacation_plans v ON p.vacation_id = v.vacation_id
        WHERE p.user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$userPurchases = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="language" content="en">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Matvii Sovhirenko, Illia Bulhar">
    <meta name="creation-date" content="2023-10-14">
    <meta name="expires" content="Thu, 15 Oct 2025 10:00:00 GMT">
    <meta name="keywords" content="Vacations, Chill, Destinations, Travel, Holidays, Beach, Adventure, Resorts, Family, Getaways, Luxury, Deals, Honeymoon, Solo, Inspiration, Itineraries">
    <link rel="stylesheet" href="../css/register-signin-page.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
    <link rel="icon" type="image/x-icon" href="../images/sun-umbrella.png">
    <title><?php echo $pageTitle; ?></title>
</head>
<body>
    <header>
        <div class="header-text">
            <div class="logo">
                <a href="../index.php">
                    <img src="../images/sun-umbrella.png" alt="Umbrella image">
                    <h1>Vacations</h1>
                </a>
            </div>
            <nav>
                <ul>
                    <?php
                        if ((isset($_SESSION['username']) && $_SESSION['username'] === 'admin')) {
                            echo '<a href="admin-page.php"><li>Admin</li></a>';
                        }
                    ?>
                    <a href="../index.php"><li>Home</li></a>
                    <a href="site-map-page.php"><li>Map</li></a>
                    <a href="places-page.php"><li>Places</li></a>
                    <a href="travel-tips-page.php"><li>Travel Tips</li></a>
                    <a href="form-page.php"><li>Contact Us</li></a>
                    <?php if (!$loggedIn) { ?><a class="active" href="register-signin-page.php"><li>Login</li></a>
                        <?php } else { ?>
                            <a class="active" href="register-signin-page.php"><li>Profile</li></a>
                        <?php } ?>
                </ul>
            </nav>
        </div>
        <div class="wave wave1"></div>
        <div class="wave wave2"></div>
        <div class="wave wave3"></div>
        <div class="wave wave4"></div>
    </header>
    
    <main>
        <?php if (!$loggedIn) { ?>
        <section id="forms" class="container forms">
        <div class="form login">
                <div class="form-content">
                    <h1>Login</h1>
                    <form action="../php/login.php" method="post">
                        <div class="field input-field">
                            <input type="text" name="username" placeholder="Username" class="input" maxlength="50" required>
                            <?php if (isset($_GET['username_error'])) : ?>
                                <span class="error-message"><?php echo $_GET['username_error']; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="field input-field">
                            <input type="password" name="password" placeholder="Password" class="password" required>
                            <?php if (isset($_GET['password_error'])) : ?>
                                 <span class="error-message"><?php echo $_GET['password_error']; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="field button-field">
                            <button type="submit">Login</button>
                        </div>
                    </form>
                    <div class="form-link">
                        <span>Don't have an account? <a href="#" class="link signup-link">Signup</a></span>
                    </div>
                </div>
            </div>
            <!-- Signup Form -->
            <div class="form signup">
                <div class="form-content">
                    <h1>Signup</h1>
                        <form action="../php/register.php" method="post">
                            <div class="field input-field">
                                <input type="text" name="username" placeholder="Username" class="input <?php if (isset($_GET['registration_username_error'])) echo 'error'; ?>" maxlength="50" required>
                                <?php if (isset($_GET['registration_username_error'])) : ?>
                                    <span class="error-message"><?php echo $_GET['registration_username_error']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="field input-field">
                                <input type="email" name="email" placeholder="Email" class="input" maxlength="50" required>
                            </div>
                            <div class="field input-field">
                                    <input type="password" name="password" placeholder="Create password" class="password <?php if (isset($_GET['registration_password_error'])) echo 'error'; ?>" required>
                                    <?php if (isset($_GET['registration_password_error'])) : ?>
                                        <span class="error-message"><?php echo $_GET['registration_password_error']; ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="field input-field">
                                    <input type="password" name="password_confirm" placeholder="Confirm password" class="password <?php if (isset($_GET['registration_password_error'])) echo 'error'; ?>" required>
                                    <?php if (isset($_GET['registration_password_error'])) : ?>
                                        <span class="error-message"><?php echo $_GET['registration_password_error']; ?></span>
                                    <?php endif; ?>
                            </div>
                            <div class="field button-field">
                                <button type="submit">Signup</button>
                            </div>
                        </form>
                    <div class="form-link">
                        <span>Already have an account? <a href="#" class="link login-link">Login</a></span>
                    </div>
                </div>
            </div>
            <script src="../js/register-signin-page-script.js"></script>
            </section>
            <?php } else { ?>
            <section class="account">
                <!-- Show profile section if user is logged in -->
                <div class="profile-section">
                    <img src="../images/account.png" alt="">
                    <p>Welcome, <?php echo $username; ?>!</p>

                <!-- Logout Form -->
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input class="logout" type="submit" name="logout" value="Logout">
                </form>
                <p>Your purchases</p>
                <?php if (empty($userPurchases)): ?>
                 <h3>No purchases found!</h3>
                 <?php else: ?>
                  <!-- Table of purchases -->
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Email</th>
                                <th>Place</th>
                                <th>Price</th>
                                <th>Duration</th>
                                <th>Type</th>
                                <th>Season</th>
                                <!-- Add other columns here -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($userPurchases as $purchase): ?>
                                <tr>
                                    <td><?php echo $purchase['name']; ?></td>
                                    <td><?php echo $purchase['surname']; ?></td>
                                    <td><?php echo $purchase['email']; ?></td>
                                    <td><?php echo $purchase['place_name']; ?></td>
                                    <td><?php echo $purchase['price']; ?>$</td>
                                    <td><?php echo $purchase['duration']; ?></td>
                                    <td><?php echo $purchase['vacation_type']; ?></td>
                                    <td><?php echo $purchase['season']; ?></td>
                                    <!-- Add other cells for additional columns -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                <p>Edit profile</p>

                <!-- Update User Information Form -->
                <form action="../php/change.profile.data.php" method="post">
                    <div class="changes">
                        <input type="text" name="username" placeholder="New username" class="input" maxlength="50">
                    </div>
                    <div class="changes">
                        <input type="email" name="email" placeholder="New email" class="input" maxlength="50">
                    </div>
                    <div class="changes">
                        <input type="password" name="password" placeholder="Enter new password" class="password">
                    </div>
                    <div class="changes">
                        <input type="password" name="password_confirm" placeholder="Confirm password" class="password">
                    </div>
                    <div>
                        <button class="changes-button" type="submit">Confirm changes</button>
                    </div>
                </form>
            </div>

            </section>
               
            <?php } ?>
    </main>


     
    <footer>
        <div class="container">
            <div class="row">
                <div class="footer-column">
                    <h4>Creators</h4>
                    <ul>
                        <li><a href="https://www.instagram.com/matvii_sovhirenko/">Matvii Sovhirenko</a></li>
                        <li><a>Illia Bulhar</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Emails</h4>
                    <ul>
                        <li><a href="mailto:matviigocont@gmail.com">matviigocont@gmail.com</a></li>
                        <li><a href="mailto:illia.bulhar@knf.stud.vu.lt">illia.bulhar@knf.stud.vu.lt</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Creation year</h4>
                    <ul>
                        <li><a href="https://en.wikipedia.org/wiki/2023">2023</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
