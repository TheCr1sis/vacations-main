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
        <link rel="stylesheet" href="../css/site-map-page-style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
        <link rel="icon" type="image/x-icon" href="../images/sun-umbrella.png">
        <title>Site map</title>
    </head>
    <body>
        <header>
            <div class="header-text">
                <div class="logo">
                    <a href="../index.php">
                        <img src="../images/sun-umbrella.png" alt="Sun umbrella">
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
                        <a class="active" href="site-map-page.php"><li>Map</li></a>
                        <a href="places-page.php"><li>Places</li></a>
                        <a href="travel-tips-page.php"><li>Travel Tips</li></a>
                        <a href="form-page.php"><li>Contact Us</li></a>
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
            <h1 id="websitemap">Website Map</h1>
            <img src="../images/MapPage.png" alt="Page map">
            <h1 id="navigation">Website Navigation</h1>
            <div class="page-map">
                <ul>
                    <a href="../index.php"><li>Home</li></a>
                    <ol>
                        <a href="../index.php#welcome"><li>Welcome</li></a>
                        <a href="../index.php#mission"><li>Our mission</li></a>
                        <a href="../index.php#offer"><li>What we offer</li></a>
                        <a href="../index.php#uniqueness"><li>What makes us unique</li></a>
                        <a href="../index.php#contact"><li>Contact</li></a>
                        <a href="../index.php#start"><li>Ready to start?</li></a>
                    </ol>
                    <a href="site-map-page.php"><li>Map</li></a>
                    <ol>
                        <a href="#websitemap"><li>Website map</li></a>
                        <a href="#navigation"><li>Website navigation</li></a>
                    </ol>
                    <a href="places-page.php"><li>Places to visit</li></a>
                    <ol>
                        <a href="places-page.php#winter"><li>Winter season</li></a>
                        <a href="places-page.php#summer"><li>Summer season</li></a>
                    </ol>
                    <a href="travel-tips-page.php"><li>Travel tips</li></a>
                    <ol>
                        <a href="travel-tips-page.php#tabletips"><li>Table of travel tips</li></a>
                        <a href="travel-tips-page.php#video-traveltips"><li>Watch travel tips</li></a>
                        <a href="travel-tips-page.php#download-traveltips"><li>Download travel tips</li></a>
                    </ol>
                    <a href="form-page.php"><li>Contact us</li></a>
                    <ol>
                        <a href="form-page.php#form"><li>Contact us form</li></a>
                    </ol>
                    <a href="register-signin-page.php"><li>Log In</li></a>
                    <ol>
                        <a href="register-signin-page.php#forms"><li>Login or Signup form</li></a>
                    </ol>
                </ul> 
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