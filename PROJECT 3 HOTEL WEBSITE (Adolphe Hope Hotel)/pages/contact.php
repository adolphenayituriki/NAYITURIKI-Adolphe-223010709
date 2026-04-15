<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Adolphe HOPE Hotel</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <a href="../index.html" class="logo">
                <div class="logo-icon">★</div>
                Grand<span>Palace</span>
            </a>
            
            <nav class="nav-wrapper">
                <ul class="nav-links">
                    <li><a href="../index.html">Home</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="menu.html">Menu</a></li>
                    <li><a href="gallery.html">Gallery</a></li>
                    <li><a href="order.php">Order</a></li>
                    <li><a href="contact.php" class="active">Contact Us</a></li>
                </ul>
                
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

    <!-- Hero -->
    <section class="hero" style="min-height: 50vh;">
        <div class="hero-content">
            <h1>Contact <span>Us</span></h1>
            <p>We'd Love to Hear From You</p>
        </div>
    </section>

    <!-- Contact Form -->
    <section class="section">
        <div class="container">
            <div class="contact-grid">
                <!-- Contact Form -->
                <div class="form-container">
                    <?php
                    $message = "";
                    $success = false;

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $full_name = trim($_POST["full_name"]);
                        $email = trim($_POST["email"]);
                        $phone = trim($_POST["phone"]);
                        $location = trim($_POST["location"]);
                        $user_message = trim($_POST["message"]);

                        if (!empty($full_name) && !empty($email) && !empty($phone) && !empty($location) && !empty($user_message)) {
                            require_once "../php/db.php";
                            
                            $stmt = $conn->prepare("INSERT INTO messages (full_name, email, phone, location, message) VALUES (?, ?, ?, ?, ?)");
                            $stmt->bind_param("sssss", $full_name, $email, $phone, $location, $user_message);
                            
                            if ($stmt->execute()) {
                                $message = "Message sent successfully! We will contact you shortly.";
                                $success = true;
                            } else {
                                $message = "Error sending message. Please try again.";
                            }
                            
                            $stmt->close();
                            $conn->close();
                        } else {
                            $message = "All fields are required.";
                        }
                    }
                    
                    if (!empty($message)) {
                        $messageClass = $success ? "success" : "error";
                        echo "<div class='form-message $messageClass'>$message</div>";
                    }
                    ?>
                    
                    <form id="contactForm" method="POST" action="contact.php">
                        <div class="form-group">
                            <label for="full_name">Full Name *</label>
                            <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone *</label>
                            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                        </div>

                        <div class="form-group">
                            <label for="location">Location *</label>
                            <input type="text" id="location" name="location" placeholder="Your city/address" required>
                        </div>

                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" rows="5" placeholder="Your message" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="contact-info">
                    <h3>Get In Touch</h3>
                    <p>Have a question or feedback? We'd love to hear from you. Fill out the form and we'll get back to you as soon as possible.</p>
                    
                    <div class="contact-item">
                        <div class="contact-icon">📍</div>
                        <div>
                            <h4>Address</h4>
                            <p>Kigali, Rwanda</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">📞</div>
                        <div>
                            <h4>Phone</h4>
                            <p>+250 789 123 456</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">✉️</div>
                        <div>
                            <h4>Email</h4>
                            <p>info@adolphehope.rw</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">🕐</div>
                        <div>
                            <h4>Hours</h4>
                            <p>Mon-Fri: 9am - 10pm<br>Sat-Sun: 10am - 11pm</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="../index.html" class="logo">
                        <div class="logo-icon">★</div>
                        Grand<span>Palace</span>
                    </a>
                    <p>Your destination for luxury accommodation and fine dining experiences.</p>
                </div>
                <div class="footer-links">
                    <h4>Quick Links</h4>
                    <a href="../index.html">Home</a>
                    <a href="about.html">About Us</a>
                    <a href="menu.html">Menu</a>
                    <a href="contact.php">Contact</a>
                </div>
                <div class="footer-links">
                    <h4>Services</h4>
                    <a href="order.php">Order Food</a>
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