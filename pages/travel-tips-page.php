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
      <link rel="stylesheet" href="../css/travel-tips-page-style.css">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
      <link rel="icon" type="image/x-icon" href="../images/sun-umbrella.png">
      <title>Travel tips</title>
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
                        <a class="active" href="travel-tips-page.php"><li>Travel Tips</li></a>
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
            <div class="introduction">
                  <div class="wrapper">
                    <img src="../images/travel-man.png" alt="Travel person image">
                    <p><highlight>Travel</highlight><br>is an adventure waiting to be written. It's a journey where the destination is just the beginning. Whether you're a first-time traveler or a seasoned explorer, our travel tips are designed to elevate your journeys. Discover the art of packing smart, decode cultural nuances, prioritize safety, and savor the flavors of every place you visit. As you embark on your next chapter of discovery, let our insights be your guide, helping you create lasting memories and embrace the beauty of the world with confidence.</p>
                  </div>
            </div>
            <h1 id="tabletips">Travel tips table</h1>
            <table>
                <tr>
                  <th>Travel Tips</th>
                  <th>Description</th>
                </tr>
                <tr>
                  <td>Packing Essentials</td>
                  <td>Don't forget travel adapters, a portable charger, and a universal plug for international trips.</td>
                </tr>
                <tr>
                  <td>Weather Insights</td>
                  <td>Check the weather forecast for your destination to pack appropriate clothing and plan outdoor activities.</td>
                </tr>
                <tr>
                  <td>Currency Exchange</td>
                  <td>Research the local currency and exchange rates, and consider carrying a small amount of cash for emergencies.</td>
                </tr>
                <tr>
                  <td>Language Phrases</td>
                  <td>Learn a few basic phrases in the local language to help with communication and show respect to the locals.</td>
                </tr>
                <tr>
                  <td>Safety Precautions</td>
                  <td>Keep your belongings secure, use reputable transportation, and be aware of common scams in the area.</td>
                </tr>
                <tr>
                  <td>Health & Vaccines</td>
                  <td>Check if any vaccinations or health precautions are required before traveling to your destination.</td>
                </tr>
                <tr>
                  <td>Travel Insurance</td>
                  <td>Invest in travel insurance to cover unexpected emergencies like medical issues, trip cancellations, or delays.</td>
                </tr>
                <tr>
                  <td>Cultural Etiquette</td>
                  <td>Research and respect the cultural norms and customs of the destination, including dress codes and behavior.</td>
                </tr>
                <tr>
                  <td>Local Cuisine</td>
                  <td>Try the local food, but be cautious with street vendors. Opt for reputable restaurants to avoid food-related issues.</td>
                </tr>
                <tr>
                  <td>Emergency Contacts</td>
                  <td>Save local emergency numbers and embassy contacts in your phone in case of unexpected situations.</td>
                </tr>
              </table>
              <h1 id="video-traveltips">Travel tips to watch</h1>
              <div class="video-container">
                <iframe
                  src="https://www.youtube-nocookie.com/embed/J5_5Sh2bl70?si=mM5d8qVbLFycA5rm"
                  title="YouTube video player"
                  frameborder="0"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                  allowfullscreen>
                </iframe>
              </div>              
              <h1 id="download-traveltips">Travel tips to download</h1>
              <div class="download-links" >
                <a href="../source-files/Travel Tips.docx" download>
                  <img src="../images/word.png" alt="Word image">
                  <p>Download travel tips word document</p>
                  <img src="../images/download.png" alt="Download image">
              </a>
              <a href="../source-files/Travel Tips.pdf" download target="_blank">
                  <img src="../images/pdf.png" alt="Pdf image">
                  <p>Download travel tips .pdf document</p>
                  <img src="../images/download.png" alt="Download image">
              </a>
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