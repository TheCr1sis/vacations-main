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
        <link rel="stylesheet" href="../css/admin-page-style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
        <link rel="icon" type="image/x-icon" href="../images/sun-umbrella.png">
        <title>Home</title>

        <script>
        // Function to display the create user modal
        function displayCreateUserModal() {
            var modal = document.getElementById("createUserModal");
            modal.style.display = "block";
        }

        // Function to close the create user modal
        function closeCreateUserModal() {
            var modal = document.getElementById("createUserModal");
            modal.style.display = "none";
        }

        // Function to display the update user modal
        function displayUpdateUserModal() {
            var modal = document.getElementById("updateUserModal");
            modal.style.display = "block";
        }

        // Function to close the update user modal
        function closeUpdateUserModal() {
            var modal = document.getElementById("updateUserModal");
            modal.style.display = "none";
        }

        // Function to display the delete user modal
        function displayDeleteUserModal() {
            var modal = document.getElementById("deleteUserModal");
            modal.style.display = "block";
        }

        // Function to close the delete user modal
        function closeDeleteUserModal() {
            var modal = document.getElementById("deleteUserModal");
            modal.style.display = "none";
        }

        // Close the modals if the user clicks outside of them
        window.onclick = function(event) {
            var createModal = document.getElementById("createUserModal");
            var updateModal = document.getElementById("updateUserModal");
            var deleteModal = document.getElementById("deleteUserModal");

            if (event.target === createModal) {
                createModal.style.display = "none";
            }

            if (event.target === updateModal) {
                updateModal.style.display = "none";
            }

            if (event.target === deleteModal) {
                deleteModal.style.display = "none";
            }
        };
    </script>
    </head>

    <body>
        <?php
        session_start();

        // Check if the user is logged in and is an admin
        if (!(isset($_SESSION['username']) && $_SESSION['username'] === 'admin')) {
            header('Location: ../index.php');
            exit();
        }
        ?>
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
                        <a class="active" href="admin-page.php"><li>Admin</li></a>
                        <a href="../index.php"><li>Home</li></a>
                        <a href="site-map-page.php"><li>Map</li></a>
                        <a href="places-page.php"><li>Places</li></a>
                        <a href="travel-tips-page.php"><li>Travel Tips</li></a>
                        <a href="form-page.php"><li>Contact Us</li></a>
                        <!-- Display the login or logout button dynamically based on user login status -->
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
        <h1>Admin Page</h1>
        <?php
            // Include database connection file
            include_once "../php/dbh.inc.php";

            // Fetch table names
            $tableNamesQuery = "SHOW TABLES";
            $result = $pdo->query($tableNamesQuery);

            if ($result) {
                while ($row = $result->fetch(PDO::FETCH_NUM)) {
                    $tableName = $row[0];

                    // Display table name
                    echo "<h2>$tableName</h2>";

                    // Fetch and display table data
                    $tableDataQuery = "SELECT * FROM $tableName";
                    $tableDataResult = $pdo->query($tableDataQuery);

                    if ($tableDataResult) {
                        echo "<table border='1'>";
                        echo "<tr>";

                        // Display table headers
                        for ($i = 0; $i < $tableDataResult->columnCount(); $i++) {
                            $column = $tableDataResult->getColumnMeta($i);
                            echo "<th>{$column['name']}</th>";
                        }

                        echo "</tr>";

                        // Display table rows
                        while ($rowData = $tableDataResult->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";

                            // Display user data
                            foreach ($rowData as $value) {
                                echo "<td>$value</td>";
                            }

                            echo "</tr>";
                        }

                        echo "</table>";

                        // Add buttons for CRUD actions only after the "users" table
                        if ($tableName === 'users') {
                            echo "<div class='action-buttons'>";
                            echo "<button type='button' onclick='displayCreateUserModal()'>Create</button>";
                            echo "<button type='button' onclick='displayUpdateUserModal()'>Update</button>";
                            echo "<button type='button' onclick='displayDeleteUserModal()'>Delete</button>";
                            echo "</div>";
                        }
                    } else {
                        echo "Error fetching data from $tableName";
                    }
                }
            } else {
                echo "Error fetching table names";
            }
        ?>
        </main>

        <div id="createUserModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeCreateUserModal()">&times;</span>
                <h2>Create User</h2>
                <form method='POST' action='../php/admin.create.php'>
                    <input type='hidden' name='tableName' value='$tableName'>

                    <label for='username'>Username:</label>
                    <input type='text' name='username' maxlength="50" required>

                    <label for='email'>Email:</label>
                    <input type='email' name='email' maxlength="50" required>

                    <label for='password'>Password:</label>
                    <input type='password' name='password' required>

                    <button type='submit'>Create</button>
                </form>
            </div>
        </div>

        <div id="updateUserModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeUpdateUserModal()">&times;</span>
                <h2>Update User</h2>
                <form method='POST' action='../php/admin.update.php'>
                    <input type='hidden' name='tableName' value='$tableName'>

                    <label for='id'>Id:</label>
                    <input type='number' name='id' maxlength="11" required>

                    <label for='username'>Username:</label>
                    <input type='text' name='username' maxlength="50">

                    <label for='email'>Email:</label>
                    <input type='email' name='email' maxlength="50">

                    <label for='password'>Password:</label>
                    <input type='password' name='password'>

                    <button type='submit'>Update</button>
                </form>
            </div>
        </div>

        <div id="deleteUserModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeDeleteUserModal()">&times;</span>
                <h2>Delete User</h2>
                <form method='POST' action='../php/admin.delete.php'>
                    <input type='hidden' name='tableName' value='$tableName'>

                    <label for='id'>Id:</label>
                    <input type='number' name='id' maxlength="11" required>

                    <button type='submit'>Delete</button>
                </form>
            </div>
        </div>

        <!-- Composite Search Form -->
        <div class='composite-search-form'>
            <h2>Composite Search for USERS and CONTACT_US tables</h2>
            <h4>Show passwords of users that left certain review</h4>
            <form method='POST' action='../php/admin.composite.search.php'>
                <input type='hidden' name='searchTable' value='users'>

                <label for='searchField'>Select Field:</label>
                <select name='searchField'>
                    <option value='password'>Password</option>
                </select>

                <label for='searchValue'>Select Rating:</label>
                <select name='searchRating'>
                    <option value='good'>Good</option>
                    <option value='bad'>Bad</option>
                    <option value='hard_to_rate'>Hard to Rate</option>
                </select>

                <button type='submit'>Search</button>
            </form>
        </div>

        <!-- Date Range Selection Form -->
        <div class='date-range-form'>
            <h2>Calculate User Registrations</h2>
            <form method='POST' action='../php/admin.calculate.user.registrations.php'>
                <label for='startDate'>Start Date:</label>
                <input type='date' name='startDate' required>

                <label for='endDate'>End Date:</label>
                <input type='date' name='endDate' required>

                <button type='submit'>Calculate</button>
            </form>
        </div>

         <!-- DDownload Report Button -->
        <button id="downloadReport">Download Report</button>
        <script>
            document.getElementById('downloadReport').addEventListener('click', function() {
            window.location.href = '../php/admin.generate.report.php';
            });
        </script>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="footer-column">
                        <h4>Creators</h4>
                        <ul>
                            <li><a href="https://www.instagram.com/matvii_sovhirenko">MatviiSovhirenko</a></li>
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