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
        <link rel="stylesheet" href="../css/places-page-style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
        <link rel="icon" type="image/x-icon" href="../images/sun-umbrella.png">
        <title>Places to go</title>
        <script src="../js/buying-script.js"></script>
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
                        <a class="active" href="places-page.php"><li>Places</li></a>
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
          <div class="season-box">
                <a href="#summer">
                    <div class="season summer">
                        <img src="../images/summer.png" alt="Summer image">
                        <h3>Summer places</h3>
                    </div>
                 </a>
                 <a href="#winter">
                    <div class="season winter">
                        <img src="../images/winter.png" alt="Winter image">
                        <h3>Winter places</h3>
                    </div>
                </a>
          </div>
          <div class="introduction">
            <div class="wrapper">
                <img src="../images/embark.jpg" alt="Ready image">
                <p><highlight>Are you ready</highlight><br>to embark on unforgettable journeys to the world's most captivating destinations? Look no further; you've just found your ultimate vacation guide. Whether you're seeking the warmth and vibrancy of summer or the enchanting allure of winter, we're here to inspire and assist you in planning your dream getaways.</p>
            </div>
          </div>
          <div class="overlay" id="overlay">
                <div class="modal">
                    <span class="close-btn" onclick="closeModal()">&times;</span>
                    <h2>Buy This Vacation Plan</h2>
                    <div class="buying-container">
                        <div class="buying-info">
                            <h2>Place:</h2>
                            <p id="Place">Place name</p>
                            <h2>Price:</h2>
                            <p id="Price">Price</p>
                            <h2>Duration:</h2>
                            <p id="Duration">Duration</p>
                            <h2>Vacation type:</h2>
                            <p id="Type">Vacation type</p>
                            <h2>Season:</h2>
                            <p id="Season">Season</p>
                        </div>
                        <form action="../php/purchase.php" method="post">
                            <input type="text" name="name" placeholder="Name" maxlength="50" required><br><br>
                            <input type="text" name="surname" placeholder="Surname" maxlength="50" required><br><br>
                            <input type="email" name="email" placeholder="Email" maxlength="100" required><br><br>
                            <input type="text" name="card_number" placeholder="Number of Card" maxlength="16" minlength="16" required><br><br>
                            <input type="text" name="cvv" placeholder="CVV" maxlength="3" minlength="3" required><br><br>
                            <input type="text" id="expiry_date" name="expiry_date" placeholder="Expiry date (MM/YY)" maxlength="5" minlength="5" required><br><br>
                            <input type="datetime-local" name="date_time" placeholder="Date and Time" required><br><br>
                            <input type="hidden" name="vacation_id" id="vacation_id" value="1">
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            $isLoggedIn = isset($_SESSION['username']);
            ?>
          <h1 id="summer" >Summer</h1>
          <div class="block-information summer1">
                <div class="first-info-line">
                    <div class="column general-info">
                        <h2>Bali, Indonesia</h2>
                        <p>Renowned for its idyllic beaches, lush landscapes, and rich cultural heritage, Bali beckons travelers with its enchanting blend of relaxation and exploration. Whether you're surfing the waves at Kuta, immersing yourself in the artistic vibrancy of Ubud, or witnessing breathtaking sunsets over the Indian Ocean in Seminyak, Bali is a haven of diverse experiences waiting to be embraced.</p>
                        <button type="button" onclick="<?php echo $isLoggedIn ? 'openModal(1)' : "window.location='register-signin-page.php'"; ?>">Buy vacation plan - 1999$</button>
                    </div>
                    <div class="column additional-info">
                        <div class="plate plate1">
                            <h4>Kuta Beach</h4>
                            <p>Known for its vibrant atmosphere, Kuta Beach is perfect for surf enthusiasts and beach lovers.</p>
                        </div>
                        <div class="plate plate2">
                            <h4>Ubud</h4>
                            <p>The cultural heart of Bali, Ubud is famous for its lush rainforests, terraced rice fields, and a vibrant arts scene.</p>
                        </div>
                        <div class="plate plate3">
                            <h4>Seminyak</h4>
                            <p>This upscale beach resort area offers a more laid-back ambiance, with a variety of high-end resorts and trendy beach clubs.</p>
                        </div>
                        <div class="plate plate4">
                            <h4>Uluwatu Temple</h4>
                            <p>Perched on a dramatic cliff overlooking the Indian Ocean, Uluwatu Temple is a must-visit for its stunning location.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-information summer2">
                <div class="first-info-line">
                    <div class="column general-info">
                        <h2>Kyoto, Japan</h2>
                        <p>Kyoto captivates with its historic Kinkaku-ji (Golden Pavilion), Fushimi Inari Shrine's iconic torii gates, and traditional tea ceremonies, offering a serene blend of ancient beauty and cultural richness.</p>
                        <button type="button" onclick="<?php echo $isLoggedIn ? 'openModal(2)' : "window.location='register-signin-page.php'"; ?>">Buy vacation plan - 2449$</button>
                    </div>
                    <div class="column additional-info">
                        <div class="plate plate1">
                            <h4>Kinkaku-ji</h4>
                            <p>Explore the mesmerizing golden temple and its beautiful gardens.</p>
                        </div>
                        <div class="plate plate2">
                            <h4>Fushimi Inari Shrine</h4>
                            <p>Walk under thousands of vivid torii gates in the forest.</p>
                        </div>
                        <div class="plate plate3">
                            <h4>Arashiyama Bamboo</h4>
                            <p>Stroll through the enchanting bamboo forest.</p>
                        </div>
                        <div class="plate plate4">
                            <h4>Kiyomizu-dera Temple</h4>
                            <p>Enjoy stunning views from the wooden terrace.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-information summer3">
                <div class="first-info-line">
                    <div class="column general-info">
                        <h2>Rio de Janeiro, Brazil</h2>
                        <p>Known for its iconic beaches, including Copacabana and Ipanema, Rio de Janeiro offers a vibrant blend of natural beauty and lively culture, making it a city that never sleeps.</p>
                        <button type="button" onclick="<?php echo $isLoggedIn ? 'openModal(3)' : "window.location='register-signin-page.php'"; ?>">Buy vacation plan - 1449$</button>
                    </div>
                    <div class="column additional-info">
                        <div class="plate plate1">
                            <h4>Christ the Redeemer</h4>
                            <p>Visit the iconic statue for breathtaking city views.</p>
                        </div>
                        <div class="plate plate2">
                            <h4>Copacabana Beach</h4>
                            <p>Relax and enjoy the vibrant beach scene.</p>
                        </div>
                        <div class="plate plate3">
                            <h4>Sugarloaf Mountain</h4>
                            <p>Take a cable car ride for stunning vistas.</p>
                        </div>
                        <div class="plate plate4">
                            <h4>Lapa Arches and Escadaria Selarón</h4>
                            <p>Explore colorful landmarks celebrating Rio's culture.</p>
                        </div>
                    </div>
                </div>
            </div>


            <h1 id="winter" >Winter</h1>
            <div class="block-information winter1">
                <div class="first-info-line">
                    <div class="column general-info">
                        <h2>Whistler, Canada</h2>
                        <p>Whistler, nestled in the Canadian Rockies, offers world-class skiing and snowboarding on its iconic peaks and a vibrant après-ski scene in its charming village, making it a top winter destination for snow enthusiasts and adventurers.</p>
                        <button type="button" onclick="<?php echo $isLoggedIn ? 'openModal(4)' : "window.location='register-signin-page.php'"; ?>">Buy vacation plan - 1749$</button>
                    </div>
                    <div class="column additional-info">
                        <div class="plate plate1">
                            <h4>Whistler Blackcomb Ski Resort</h4>
                            <p>Experience world-renowned skiing and snowboarding on Whistler and Blackcomb mountains.</p>
                        </div>
                        <div class="plate plate2">
                            <h4>Whistler Village</h4>
                            <p>Stroll through the charming alpine village, known for its après-ski scene, shopping and vibrant atmosphere.</p>
                        </div>
                        <div class="plate plate3">
                            <h4>Peak 2 Peak Gondola</h4>
                            <p>Take a breathtaking ride on the Peak 2 Peak Gondola, connecting Whistler and Blackcomb mountains.</p>
                        </div>
                        <div class="plate plate4">
                            <h4>Hotel de Glace</h4>
                            <p>Visit the magnificent ice hotel, Hôtel de Glace, for a unique winter experience.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-information winter2">
                <div class="first-info-line">
                    <div class="column general-info">
                        <h2>Swiss Alps, Switzerland</h2>
                        <p>he Swiss Alps beckon winter enthusiasts with their world-class skiing and snowboarding, while also offering the allure of picturesque alpine villages, cozy chalets, and an abundance of Swiss delicacies.</p>
                        <button type="button" onclick="<?php echo $isLoggedIn ? 'openModal(5)' : "window.location='register-signin-page.php'"; ?>">Buy vacation plan - 2799$</button>
                    </div>
                    <div class="column additional-info">
                        <div class="plate plate1">
                            <h4>Zermatt</h4>
                            <p>Explore the charming car-free village and take in iconic views of the Matterhorn.</p>
                        </div>
                        <div class="plate plate2">
                            <h4>St. Moritz</h4>
                            <p>Experience luxury in a world-famous resort town with excellent winter sports.</p>
                        </div>
                        <div class="plate plate3">
                            <h4>Verbier</h4>
                            <p>Enjoy renowned off-piste skiing and a vibrant après-ski scene.</p>
                        </div>
                        <div class="plate plate4">
                            <h4>Interlaken</h4>
                            <p>Discover adventure sports and outdoor activities in the heart of the Bernese Oberland.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-information winter3">
                <div class="first-info-line">
                    <div class="column general-info">
                        <h2>Reykjavik, Iceland</h2>
                        <p>Reykjavik in winter offers a magical experience, from chasing the Northern Lights to unwinding in geothermal hot springs. Explore the wonders of the Golden Circle and experience the warmth of Icelandic hospitality amidst a snowy wonderland.</p>
                        <button type="button" onclick="<?php echo $isLoggedIn ? 'openModal(6)' : "window.location='register-signin-page.php'"; ?>">Buy vacation plan - 1399$</button>
                    </div>
                    <div class="column additional-info">
                        <div class="plate plate1">
                            <h4>Blue Lagoon</h4>
                            <p>Soak in the rejuvenating Blue Lagoon's geothermal waters.</p>
                        </div>
                        <div class="plate plate2">
                            <h4>Hallgrímskirkja</h4>
                            <p>Marvel at the iconic Hallgrímskirkja's modern design and city views.</p>
                        </div>
                        <div class="plate plate3">
                            <h4>Golden Circle</h4>
                            <p>Discover Iceland's natural wonders on the Golden Circle route.</p>
                        </div>
                        <div class="plate plate4">
                            <h4>Harpa Concert Hall</h4>
                            <p>Enjoy culture and architecture at the waterfront Harpa Concert Hall.</p>
                        </div>
                    </div>
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