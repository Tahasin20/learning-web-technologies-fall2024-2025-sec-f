<?php
function getConnection(){
    $con = mysqli_connect('localhost', 'root', 'root', 'ratings');
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $con;
}

function addReview($name, $rating, $message, $datetime) {
    $con = getConnection();
    $sql = "INSERT INTO reviews (name, rating, message, datetime) VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "siss", $name, $rating, $message, $datetime);
    $result = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($con);

    return $result;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $rating = htmlspecialchars($_POST['rating']);
    $message = htmlspecialchars($_POST['message']);
    $datetime = htmlspecialchars($_POST['datetime']);

    if (addReview($name, $rating, $message, $datetime)) {
        echo "<h1>Review Submitted Successfully!</h1>";
        echo "<p>Thank you for your feedback, <strong>$name</strong>.</p>";
        echo "<a href='../view/review.html'>Submit another review</a>";
    } else {
        echo "<h1>Submission Failed</h1>";
        echo "<p>There was an issue submitting your review. Please try again later.</p>";
        echo "<a href='../view/review.html'>Go Back</a>";
    }
}
?>
