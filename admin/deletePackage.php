<?php
include 'db.php';

if (isset($_GET['packageID'])) {
    $id = intval($_GET['packageID']);

    $sql = "DELETE FROM packages WHERE packageID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        session_start();
            $_SESSION['alert'] = "Package deleted successfully!";
            header("location: package.php");
            exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "No ID provided";
}

$conn->close();
?>
