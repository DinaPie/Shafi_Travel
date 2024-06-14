<?php
    include 'db.php';

    // Function to get the highest packageID and increment it
    function getNextPackageID($conn) {
        $sql = "SELECT packageID FROM packages ORDER BY CAST(packageID AS UNSIGNED) DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $highestID = intval($row['packageID']);
            return $highestID + 1;
        } else {
            return 1; // Default starting ID if no records exist
        }
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect and sanitize input data
        $name = $conn->real_escape_string($_POST['name']);
        $duration = intval($_POST['duration']);
        $price = doubleval($_POST['price']);

        // Get the next packageID
        $newPackageID = getNextPackageID($conn);

        // Insert data into the database
        $sql = "INSERT INTO packages (packageID, name, duration, price) VALUES ('$newPackageID', '$name', '$duration', '$price')";

        if ($conn->query($sql) === TRUE) {
            session_start();
            $_SESSION['alert'] = "New package added successful!";
            header("Location: package.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close connection
    $conn->close();
?>