<?php
// Start the session to store submitted data
session_start();

// Initialize variables
$fname = '';
$lname = '';

// Check if form data is sent via GET
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['fname']) && isset($_GET['lname'])) {
    // Retrieve the form data
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];

    // Store the data in the session (optional)
    $_SESSION['fname'] = $fname;
    $_SESSION['lname'] = $lname;
}

// Debugging output to see if the form data is being received
echo "Debug: fname = $fname, lname = $lname";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
            font-size: 18px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>
            <?php
            if (!empty($fname) && !empty($lname)) {
                echo "Welcome, " . htmlspecialchars($fname) . " " . htmlspecialchars($lname) . "!";
            } else {
                echo "Welcome, Guest!";
            }
            ?>
        </h1>
        <p>Thank you for submitting your information.</p>
        <a href="action2.php">Click if you wanna see your information.</a>
    </div>
</body>
</html>
