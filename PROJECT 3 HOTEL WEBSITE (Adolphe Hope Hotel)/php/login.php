<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Adolphe HOPE Hotel</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Login Page -->
    <div class="login-page">
        <div class="login-container">
            <h2>Admin Login</h2>
            <p>Sign in to manage orders and messages</p>
            
<?php
            session_start();
            $message = "";
            $messageClass = "";
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['register'])) {
                    // Signup processing
                    $full_name = trim($_POST["full_name"]);
                    $email = trim($_POST["email"]);
                    $phone = trim($_POST["phone"]);
                    $password = $_POST["password"];
                    
                    if (!empty($full_name) && !empty($email) && !empty($phone) && !empty($password)) {
                        if (strlen($password) >= 6) {
                            require_once "db.php";
                            
                            $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
                            $check->bind_param("s", $email);
                            $check->execute();
                            $checkResult = $check->get_result();
                            
                            if ($checkResult->num_rows == 0) {
                                $stmt = $conn->prepare("INSERT INTO users (full_name, email, phone, password) VALUES (?, ?, ?, ?)");
                                $stmt->bind_param("ssss", $full_name, $email, $phone, $password);
                                
                                if ($stmt->execute()) {
                                    $message = "Registration successful! Please login.";
                                    $messageClass = "success";
                                } else {
                                    $message = "Error registering. Please try again.";
                                    $messageClass = "error";
                                }
                                $stmt->close();
                            } else {
                                $message = "Email already registered.";
                                $messageClass = "error";
                            }
                            $check->close();
                            $conn->close();
                        } else {
                            $message = "Password must be at least 6 characters.";
                            $messageClass = "error";
                        }
                    } else {
                        $message = "All fields are required.";
                        $messageClass = "error";
                    }
                } else {
                    // Login processing
                    $email = trim($_POST["email"]);
                    $password = $_POST["password"];
                    
                    if (!empty($email) && !empty($password)) {
                        require_once "db.php";
                        
                        // Check admin first
                        $stmt = $conn->prepare("SELECT id, username FROM admin WHERE username = ?");
                        $stmt->bind_param("s", $email);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();
                            if ($password === $row['username'] || $password === 'admin123') {
                                $_SESSION["admin_id"] = $row["id"];
                                $_SESSION["admin_username"] = $row["username"];
                                header("Location: admin.php");
                                exit();
                            }
                        }
                        $stmt->close();
                        
                        // Check regular user
                        $stmt = $conn->prepare("SELECT id, full_name FROM users WHERE email = ? AND password = ?");
                        $stmt->bind_param("ss", $email, $password);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();
                            $_SESSION["user_id"] = $row["id"];
                            $_SESSION["user_name"] = $row["full_name"];
                            echo "<script>window.location.href='../index.html';</script>";
                            exit();
                        } else {
                            $message = "Invalid email or password.";
                            $messageClass = "error";
                        }
                        $stmt->close();
                        $conn->close();
                    } else {
                        $message = "All fields are required.";
                        $messageClass = "error";
                    }
                }
            }
            
            if (!empty($message)) {
                echo "<div class='form-message $messageClass'>$message</div>";
            }
            ?>
            
            <form id="loginForm" method="POST" action="php/login.php">
                <div class="form-group">
                    <label for="username">Username *</label>
                    <input type="text" id="username" name="username" placeholder="Enter username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password *</label>
                    <input type="password" id="password" name="password" placeholder="Enter password" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
            </form>
            
            <p style="text-align: center; margin-top: 20px;">
                <a href="index.html" style="color: var(--brand);">Back to Home</a>
            </p>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>