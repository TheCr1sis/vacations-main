<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="language" content="en">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="author" content="Matvii Sovhirenko">
        <meta name="creation-date" content="2023-10-14">
        <meta name="expires" content="Thu, 15 Oct 2025 10:00:00 GMT">
        <meta name="keywords" content="Vacations, Chill, Destinations, Travel, Holidays, Beach, Adventure, Resorts, Family, Getaways, Luxury, Deals, Honeymoon, Solo, Inspiration, Itineraries">
        <link rel="stylesheet" href="css/main-page-style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
        <link rel="icon" type="image/x-icon" href="images/sun-umbrella.png">
        <title>Home</title>
    </head>
    <body>
        <header>
            <div class="header-text">
                <div class="logo">
                    <a href="index.php">
                        <img src="images/sun-umbrella.png" alt="Umbrella image">
                        <h1>Vacations</h1>
                    </a>
                </div>
                <nav>
                    <ul>
                        <!-- Display Admin page dynamically based on whether user is logged in as admin or not -->
                        <?php
                        session_start();
                        if ((isset($_SESSION['username']) && $_SESSION['username'] === 'admin')) {
                            echo '<a href="pages/admin-page.php"><li>Admin</li></a>';
                        }
                        ?>
                        <a href="index.php" class="active"><li>Home</li></a>
                        <a href="pages/site-map-page.php"><li>Map</li></a>
                        <a href="pages/places-page.php"><li>Places</li></a>
                        <a href="pages/travel-tips-page.php"><li>Travel Tips</li></a>
                        <a href="pages/form-page.php"><li>Contact Us</li></a>
                        <!-- Display the login or logout button dynamically based on user login status -->
                        <?php
                        if (isset($_SESSION['username'])) {
                                echo '<a href="pages/register-signin-page.php"><li>Profile</li></a>';
                        } else {
                            echo '<a href="pages/register-signin-page.php"><li>Login</li></a>';
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
            <div id="welcome" class="introduction">
                <div class="wrapper">
                    <img src="images/vacation1.jpg" alt="Welcome image">
                    <p><highlight>Welcome</highlight><br>to our vacation paradise! At Vacations, we're a group of passionate travelers who believe that every journey is an opportunity for adventure, relaxation, and discovery. Our love for vacations led us to create this platform, where we aim to share our knowledge and experiences with fellow explorers.</p>
                </div>
            </div>
            <div id="mission" class="introduction">
                <div class="wrapper">
                    <img style="max-width: 280px;" src="images/goal.png" alt="Our mission image">
                    <p><highlight>Our mission</highlight><br>is simple yet profound: to inspire and assist travelers in planning their dream vacations. We envision a world where everyone can embark on memorable journeys with confidence. Whether you're a seasoned globetrotter or a first-time traveler, we're here to provide the information and inspiration you need.</p>
                </div>
            </div>
            <div id="offer" class="introduction">
                <div class="wrapper">
                    <img style="max-width: 280px;" src="images/acordo.png" alt="Offer image">
                    <p><highlight>At Vacations,</highlight><br>we offer a comprehensive collection of resources to enhance your vacation experiences. You'll find a wealth of information about dream destinations, practical travel tips, exciting activities, and a wide range of accommodation options. Explore our site to discover the best vacations and make your travel dreams a reality.</p>
                </div>
            </div>
            <div id="uniqueness" class="introduction">
                <div class="wrapper">
                    <img src="images/unique.png" alt="Uniqueness image">
                    <p><highlight>What makes us unique</highlight><br>is our dedication to providing in-depth, well-researched content that's tailored to your needs. We're committed to delivering reliable, up-to-date information and insights, helping you make informed decisions for your next getaway. Our passion for travel shines through in every article, and we're here to be your trusted travel companion.</p>
                </div>
            </div>
            <div id="contact" class="introduction">
                <div class="wrapper">
                    <img src="images/questions.png" alt="Feedback image">
                    <p><highlight>We love hearing from our readers!</highlight><br>Whether you have questions, suggestions, or just want to share your travel stories, we're eager to connect with you. You can reach out to us through our contact form, send an email to <b>matviigocont@gmail.com</b>, or connect with us on social media. Your feedback is important to us, and we're here to assist you in any way we can.</p>
                </div>
            </div>
            <div id="start" class="introduction">
                <div class="wrapper">
                    <img src="images/start_making.png" alt="Ready to start image">
                    <p><highlight>Ready to start your vacation journey?</highlight><br>Begin by exploring our destination guides, travel tips, and more. If you'd like to stay updated with the latest travel inspiration and advice, consider subscribing to our newsletter. We look forward to helping you plan your next incredible adventure.</p>
                </div>
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