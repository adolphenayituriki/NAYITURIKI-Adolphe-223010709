<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['yearOfBirth'] . '-' . $_POST['monthOfBirth'] . '-' . $_POST['dayOfBirth'];
    $emailID = $_POST['emailID'];
    $mobileNumber = $_POST['mobileNumber'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $pinCode = $_POST['pinCode'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $hobbies = isset($_POST['hobbies']) ? implode(", ", $_POST['hobbies']) : "";
    $board1 = $_POST['board1'];
    $percentage1 = $_POST['percentage1'];
    $yearOfPassing1 = $_POST['yearOfPassing1'];
    $board2 = $_POST['board2'];
    $percentage2 = $_POST['percentage2'];
    $yearOfPassing2 = $_POST['yearOfPassing2'];
    $board3 = $_POST['board3'];
    $percentage3 = $_POST['percentage3'];
    $yearOfPassing3 = $_POST['yearOfPassing3'];
    $board4 = $_POST['board4'];
    $percentage4 = $_POST['percentage4'];
    $yearOfPassing4 = $_POST['yearOfPassing4'];
    $coursesAppliedFor = isset($_POST['coursesAppliedFor']) ? implode(", ", $_POST['coursesAppliedFor']) : "";

    $sql = "INSERT INTO students (
        first_name, last_name, date_of_birth, email_id, mobile_number, gender,
        address, city, pin_code, state, country, hobbies,
        board1, percentage1, year_of_passing1,
        board2, percentage2, year_of_passing2,
        board3, percentage3, year_of_passing3,
        board4, percentage4, year_of_passing4,
        courses_applied_for
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssssssssssssssssssss",
        $firstName, $lastName, $dateOfBirth, $emailID, $mobileNumber, $gender,
        $address, $city, $pinCode, $state, $country, $hobbies,
        $board1, $percentage1, $yearOfPassing1,
        $board2, $percentage2, $yearOfPassing2,
        $board3, $percentage3, $yearOfPassing3,
        $board4, $percentage4, $yearOfPassing4,
        $coursesAppliedFor
    );

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>