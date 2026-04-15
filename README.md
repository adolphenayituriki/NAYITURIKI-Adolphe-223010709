# Web Projects Collection
**UNIVERSITY OF RWANDA**

**SCHOOL OF BUSINESS**

**DEPARTMENT: BIT**

**MODULE: WEB PROGRAMING**

**NAYITURIKI Adolphe 223010709**


A collection of four web development projects showcasing different web technologies and functionalities.

---

## Table of Contents

- [Project 1: Basic Website](#project-1-basic-website)
- [Project 2: Student Registration Form](#project-2-student-registration-form)
- [Project 3: Adolphe HOPE Hotel](#project-3-adolphe-hope-hotel)
- [Project 4: Currency Converter](#project-4-currency-converter)

---

## Project Overview

| # | Project Name | Technology | Description |
|---|-------------|------------|-------------|
| 1 | Basic Website | HTML, CSS | Simple informational website |
| 2 | Student Registration Form | HTML, PHP, MySQL | Database-driven student registration system |
| 3 | Adolphe HOPE Hotel | HTML, CSS, PHP, JS, MySQL | Full hotel website with ordering system |
| 4 | Currency Converter | HTML, CSS, JavaScript | Client-side currency conversion tool |

---

## Project 1: Basic Website

A simple informational website with a navigation sidebar, header, and main content area.

### Features

- Top navigation bar with search input
- Left sidebar navigation
- Main content area with featured image
- Article/text display
- Responsive layout
- Basic styling

### File Structure

```
PROJECT 1/
├── index.html      # Main webpage
├── css/
│   └── index.css  # Styles
└── image/
    └── image.png  # Featured image
```

### Usage

Open `index.html` in any web browser.

---

## Project 2: Student Registration Form

A comprehensive student registration system for collecting and managing student information.

### Features

- Full name and date of birth collection
- Email and mobile number fields
- Gender selection (Male/Female)
- Address and location (City, State, Pin Code, Country)
- Country dropdown with comprehensive list
- Hobbies selection with custom option
- Educational qualifications table (Class X, XII, Graduation, Masters)
- Course selection (BCA, B.Com, B.Sc, B.A)
- Form validation
- MySQL database storage

### Database Setup

```sql
-- Import the database schema
mysql -u root -p < database.sql
```

### File Structure

```
PROJECT 2 STUDENT REGISTRATION FORM/
├── index.html         # Main registration form
├── connect.php       # Database connection handler
└── database.sql     # MySQL database schema
```

### Requirements

- PHP 7.0+
- MySQL/MariaDB
- Web server (Apache/Nginx/XAMPP/WAMP)

---

## Project 3: Adolphe HOPE Hotel

A complete hotel website with online ordering, reservation system, and admin management panel.

### Features

- **Responsive Design** - Works on all devices
- **Homepage** - Hero section, about, services
- **About Us** - Hotel information
- **Menu** - Food and beverage listings
- **Gallery** - Photo gallery
- **Online Ordering** - Order food for delivery
- **Contact Form** - Contact with email integration
- **User Authentication** - Login/Signup system
- **Admin Panel** - Manage orders
- **Bilingual** - English and Kinyarwanda

### Pages

| Page | Description |
|------|-------------|
| index.html | Homepage |
| pages/about.html | About the hotel |
| pages/menu.html | Food menu |
| pages/gallery.html | Photo gallery |
| pages/order.html | Online ordering |
| pages/contact.html | Contact form |
| php/admin.php | Admin panel |

### Database Setup

```sql
-- Create database and import schema
mysql -u root -p < database.sql
```

### Configuration

Edit `php/db.php` to configure database connection:

```php
$localhost = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database";
```

### File Structure

```
PROJECT 3 HOTEL WEBSITE (Adolphe Hope Hotel)/
├── index.html              # Homepage
├── database.sql           # Database schema
├── css/
│   ├── style.css          # Main styles
│   └── order.css        # Order page styles
├── images/               # Hotel images
├── js/
│   ├── script.js         # Main JavaScript
│   └── order.js        # Order handling
├── pages/
│   ├── about.html     # About page
│   ├── menu.html      # Menu page
│   ├── gallery.html   # Gallery page
│   ├── order.html     # Order page
│   ├── contact.html   # Contact page
│   └── login.php     # Login page
└── php/
    ├── db.php          # Database connection
    ├── login.php      # Login handler
    ├── admin.php     # Admin panel
    └── logout.php    # Logout handler
```

### Requirements

- PHP 7.0+
- MySQL/MariaDB
- Web server (Apache/Nginx/XAMPP/WAMP)

---

## Project 4: Currency Converter

A simple, clean tool to convert Rwandan Francs (FRW) to various international currencies.

### Features

- Convert FRW to multiple currencies
- Supported currencies:
  - USD - US Dollar
  - EUR - Euro
  - GBP - British Pound
  - KES - Kenyan Shilling
  - UGX - Ugandan Shilling
  - TZS - Tanzanian Shilling
  - ZAR - South African Rand
  - CNY - Chinese Yuan
  - INR - Indian Rupee
  - JPY - Japanese Yen
- Manual exchange rate input
- Clean, responsive UI
- Instant conversion

### Usage

1. Open `index.html` in any web browser
2. Enter amount in FRW
3. Select target currency
4. Enter the exchange rate
5. Click Convert

### File Structure

```
PROJECT 4 CURRENCY CONVERTER/
├── index.html        # Main converter
├── css/
│   └── style.css   # Styles
└── js/
    └── script.js  # Conversion logic
```

### Note

This is a client-side converter. Exchange rates must be manually entered. For live rates, integrate with a currency API like ExchangeRate-API or OpenExchangeRates.

---

## Installation & Running

### For Projects 1 & 4 (Pure HTML/CSS/JS)

Simply open `index.html` in any web browser - no server required.

### For Projects 2 & 3 (PHP + MySQL)

1. Install a web server (XAMPP, WAMP, or manual setup)
2. Place project folder in htdocs/www directory
3. Create MySQL database and import schema
4. Configure database connection files
5. Access via browser: `http://localhost/project-folder`

---

## Technologies Used

| Technology | Purpose |
|------------|---------|
| HTML5 | Page structure |
| CSS3 | Styling and responsiveness |
| JavaScript | Client-side functionality |
| PHP | Server-side processing |
| MySQL | Database storage |
| SQL | Database queries |

---

## License

All projects are provided as-is for educational purposes. NAYITURIKI Adolphe _ BIT HUYE CAMPUS
