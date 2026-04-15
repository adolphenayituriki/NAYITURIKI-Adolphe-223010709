<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Adolphe HOPE Hotel</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <a href="../index.html" class="logo">
                <div class="logo-icon">👤</div>
                Grand<span>Palace</span>
            </a>
            
            <nav class="nav-wrapper">
                <ul class="nav-links">
                    <li><a href="../index.html">Home</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="menu.html">Menu</a></li>
                    <li><a href="gallery.html">Gallery</a></li>
                    <li><a href="order.html">Order</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                </ul>
                
                <div class="user-account">
                    <button class="user-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Account</span>
                    </button>
                    <div class="user-dropdown">
                        <a href="login.html" class="active">Login</a>
                        <a href="login.html?tab=signup">Sign Up</a>
                    </div>
                </div>

                <div class="lang-switcher">
                    <button class="lang-btn">
                        <span>🌐</span>
                        <span class="current-lang">EN</span>
                        <span>▼</span>
                    </button>
                    <div class="lang-dropdown">
                        <a href="?lang=en" data-lang="en" class="active">English</a>
                        <a href="?lang=rw" data-lang="rw">Kinyarwanda</a>
                    </div>
                </div>
            </nav>
            
            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>

    <!-- Login/Signup Page -->
    <section class="auth-section">
        <div class="auth-container">
            <div class="auth-tabs">
                <a href="login.html" class="auth-tab <?php echo (!isset($_GET['tab']) || $_GET['tab'] != 'signup') ? 'active' : ''; ?>">Login</a>
                <a href="login.html?tab=signup" class="auth-tab <?php echo (isset($_GET['tab']) && $_GET['tab'] == 'signup') ? 'active' : ''; ?>">Sign Up</a>
            </div>
            
            <?php
            $message = "";
            $messageClass = "";
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['register'])) {
                    // Signup processing
                    $full_name = trim($_POST["full_name"]);
                    $email = trim($_POST["email"]);
                    $phone = trim($_POST["phone"]);
                    $password = $_POST["password"];
                    $confirm_password = $_POST["confirm_password"];
                    
                    if (!empty($full_name) && !empty($email) && !empty($phone) && !empty($password)) {
                        if ($password === $confirm_password) {
                            if (strlen($password) >= 6) {
                                require_once "../php/db.php";
                                
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
                            $message = "Passwords do not match.";
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
                        require_once "../php/db.php";
                        
                        $stmt = $conn->prepare("SELECT id, full_name FROM users WHERE email = ? AND password = ?");
                        $stmt->bind_param("ss", $email, $password);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();
                            $_SESSION["user_id"] = $row["id"];
                            $_SESSION["user_name"] = $row["full_name"];
                            header("Location: ../index.html");
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
            
            <?php if (!isset($_GET['tab']) || $_GET['tab'] != 'signup'): ?>
            <!-- Login Form -->
            <form id="loginForm" method="POST" action="login.html">
                <div class="form-group">
                    <label for="login_email">Email *</label>
                    <input type="email" id="login_email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="login_password">Password *</label>
                    <input type="password" id="login_password" name="password" placeholder="Enter your password" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
                
                <p style="text-align: center; margin-top: 16px;">
                    <a href="login.html?tab=signup" style="color: var(--brand); font-size: 14px;">Don't have an account? Sign Up</a>
                </p>
            </form>
            <?php else: ?>
            <!-- Signup Form -->
            <form id="signupForm" method="POST" action="login.html?tab=signup">
                <input type="hidden" name="register" value="1">
                
                <div class="form-group">
                    <label for="signup_name">Full Name *</label>
                    <input type="text" id="signup_name" name="full_name" placeholder="Enter your full name" required>
                </div>

                <div class="form-group">
                    <label for="signup_email">Email *</label>
                    <input type="email" id="signup_email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="signup_phone">Phone *</label>
                    <input type="tel" id="signup_phone" name="phone" placeholder="Enter your phone number" required>
                </div>

                <div class="form-group">
                    <label for="signup_password">Password *</label>
                    <input type="password" id="signup_password" name="password" placeholder="Create a password (min 6 characters)" required>
                </div>

                <div class="form-group">
                    <label for="signup_confirm">Confirm Password *</label>
                    <input type="password" id="signup_confirm" name="confirm_password" placeholder="Confirm your password" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">Sign Up</button>
                
                <p style="text-align: center; margin-top: 16px;">
                    <a href="login.html" style="color: var(--brand); font-size: 14px;">Already have an account? Login</a>
                </p>
            </form>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="../index.html" class="logo">
                        <div class="logo-icon">👤</div>
                        Grand<span>Palace</span>
                    </a>
                    <p>Your destination for luxury accommodation and fine dining experiences.</p>
                </div>
                <div class="footer-links">
                    <h4>Quick Links</h4>
                    <a href="../index.html">Home</a>
                    <a href="about.html">About Us</a>
                    <a href="menu.html">Menu</a>
                    <a href="contact.html">Contact</a>
                </div>
                <div class="footer-links">
                    <h4>Services</h4>
                    <a href="order.html">Order Food</a>
                    <a href="gallery.html">Gallery</a>
                </div>
                <div class="footer-links">
                    <h4>Contact</h4>
                    <p>Kigali, Rwanda</p>
                    <p>+250 789 123 456</p>
                    <p>info@adolphehope.rw</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Adolphe HOPE Hotel. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="../js/script.js"></script>
</body>
</html>