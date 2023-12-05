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
        <link rel="stylesheet" href="../css/form-page-style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
        <link rel="icon" type="image/x-icon" href="../images/sun-umbrella.png">
        <title>Contact us</title>
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
                        session_start();
                        if ((isset($_SESSION['username']) && $_SESSION['username'] === 'admin')) {
                            echo '<a href="admin-page.php"><li>Admin</li></a>';
                        }
                        ?>
                        <a href="../index.php"><li>Home</li></a>
                        <a href="site-map-page.php"><li>Map</li></a>
                        <a href="places-page.php"><li>Places</li></a>
                        <a href="travel-tips-page.php"><li>Travel Tips</li></a>
                        <a class="active" href="form-page.php"><li>Contact Us</li></a>
                        <?php
                        if (isset($_SESSION['username'])) {
                                echo '<a href="register-signin-page.php"><li>Profile</li></a>';
                        } else {
                            echo '<a href="register-signin-page.php"><li>Login</li></a>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
            <div class="wave wave1"></div>
            <div class="wave wave2"></div>
            <div class="wave wave3"></div>
            <div class="wave wave4"></div>
        </header>
        
        <main>
            <div id="form" class="form-box">
                <h1>Contact us:</h1>
                <form action="../php/contact.form.submit.php" method="post" enctype="multipart/form-data">
                    <div class="input-row">
                        <div class="input-data">
                            <input type="text" name="first_name" maxlength="50" required>
                            <label for="first_name">First Name</label>
                            <div class="line"></div>
                        </div>
                        <div class="input-data">
                            <input type="text" name="last_name" maxlength="50" required>
                            <label for="last_name">Last Name</label>
                            <div class="line"></div>
                        </div>
                        <div class="input-data">
                            <input type="text" name="email" maxlength="100" required>
                            <label for="email">Email Address</label>
                            <div class="line"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="input-row checkboxes">
                        <input type="checkbox" id="agreeToReceive" name="agreeToReceive">
                        <label for="agreeToReceive">I agree to receive emails with the latest news.</label>
                        <input type="checkbox" id="agreeToStore" name="agreeToStore">
                        <label for="agreeToStore">I agree that my email will be stored.</label>
                    </div>
                    <hr>
                    <h3>How would you rate our site?</h3>
                    <div class="input-row radiobuttons">
                        <input type="radio" id="good" name="rating" value="good">
                        <label for="good">Good</label>
                        <input type="radio" id="bad" name="rating" value="bad">
                        <label for="bad">Bad</label>
                        <input type="radio" id="hard" name="rating" value="hard_to_rate">
                        <label for="hard">Hard to rate</label>
                    </div>
                    <hr>
                    <h3>How useful is our site?</h3>
                    <div class="input-row slider">
                        <label for="usefulness">Rate from 1 to 10:</label>
                        <input type="range" id="usefulness" name="usefulness" min="1" max="10" step="1" value="5">
                    </div>
                    <hr>
                    <h3>Share your opinion, or other information as a TXT file:</h3>
                    <div class="input-row dropfiles">
                        <input type="file" id="fileInput" name="uploadedFile" accept=".txt" multiple>
                    </div>
                    <hr>
                    <div class="input-row">
                        <div class="input-data freetext">
                            <textarea rows="8" cols="80" name="text_input" required></textarea>
                            <br>
                            <label for="text_input">Write your message</label>
                            <div class="line"></div>
                        </div>
                    </div>
                    <div class="submit-input">
                        <input type="submit" name="submit" value="Submit">
                    </div>
                </form>
            </div>
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